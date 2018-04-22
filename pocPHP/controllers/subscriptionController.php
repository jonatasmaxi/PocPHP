<?php

	function createSubscription(){
		require '../vendor/autoload.php';
		$pagarMe = new \PagarMe\Sdk\PagarMe('ak_test_dPHe9boNcLuEi1srYJKAosFoBNUgAK');
		$subscription_info = json_decode($_SESSION['subscription_info']);
		$plan_id = $subscription_info->plan_id;
		$plan = $pagarMe->plan()->get($plan_id);
		$postbackUrl = null;
		$metadata = [];
		//CRIAÇÃO DO CUSTOMER
		$customer = new \PagarMe\Sdk\Customer\Customer([
			'name' => $_SESSION['buyer']['name'],
			'email' => $_SESSION['buyer']['email'],
			'document_number' => $_SESSION['buyer']['document_number'],
			'address' => new \PagarMe\Sdk\Customer\Address([
				'street' => $_SESSION['buyer']['address']['street'],
				'street_number' =>$_SESSION['buyer']['address']['number'],
				'neighborhood' => $_SESSION['buyer']['address']['neighborhood'],
				'zipcode' => $_SESSION['buyer']['address']['zip'],
				'complementary' => $_SESSION['buyer']['address']['complementary'],
				'city' => $_SESSION['buyer']['address']['city'],
				'state' => $_SESSION['buyer']['address']['state'],
				'country' => 'Brasil'
			]),
			'phone' =>new \PagarMe\Sdk\Customer\Phone([
				'ddd' => substr($_SESSION['buyer']['phone'],2,3),
				'number' =>substr($_SESSION['buyer']['phone'],4)
			]),
			'born_at' => $_SESSION['buyer']['birthday']
			]);
			$splitrules = null;
			if($subscription_info->split_rules == true){
				$recipient1 = $pagarMe->recipient()->get('re_cj578r1nt00eljp6dzlbjbs4l');
				$recipient2 = $pagarMe->recipient()->get($subscription_info->sec_recipient);
				$splitRule1 = $pagarMe->splitRule()->percentageRule(
					5,	
					$recipient1,
					true,
					true
				);

				$splitRule2 = $pagarMe->splitRule()->percentageRule(
					95,
					$recipient2,
					true,
					true
				);
				$splitrules = new PagarMe\Sdk\SplitRule\SplitRuleCollection();
				$splitrules[0] = $splitRule1;
				$splitrules[1] = $splitRule2;	
			}
			
			
			//Assinatura DE CARTÃO DE CRÉDITO
			if($subscription_info->payment_method == 'credit_card'){
				$card = $pagarMe->card()->createFromHash($subscription_info->card_hash);
				try{
					$subscription = $pagarMe->subscription()->createCardSubscription(
						$plan,
						$card,
						$customer,
						$postbackUrl,
						$metadata,
						[
							'split_rules'=> $splitrules,
						]
					);
					$_SESSION['errors'] = 'false';
					$_SESSION['pmethod'] = 'credit_card';
				} catch(PagarMeException $ex){
					$_SESSION['errors'] = 'true';
					$_SESSION['msg'] = $ex->getMessage();
				}
				
			} else {
				try{
					$subscription = $pagarMe->subscription()->createBoletoSubscription(
						$plan,
						$customer,
						$postbackUrl,
						$metadata,
						[
							'split_rules'=> $splitrules,
						]
					);
					$_SESSION['errors'] = 'false';
					$_SESSION['boleto_url'] = $subscription->current_transaction_boleto_url;
					$_SESSION['pmethod'] = 'boleto';
				} catch(PagarMeException $ex){
					$_SESSION['errors'] = 'true';
					$_SESSION['msg'] = $ex->getMessage();
				}
				
			}	
	}

?>