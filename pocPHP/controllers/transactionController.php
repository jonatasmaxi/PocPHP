<?php
	function createTransaction(){
		require '../vendor/autoload.php';
		$pagarMe = new \PagarMe\Sdk\PagarMe('ak_test_dPHe9boNcLuEi1srYJKAosFoBNUgAK');
		$transaction_info = json_decode($_SESSION['transaction_info']);
		
		$amount = $transaction_info->amount;
		$installments = $transaction_info->installments;
		$capture = true;
		$postbackUrl = null;
		$metadata = [];
		//CRIAÇÃO DO CUSTOMER
		$customer = new \PagarMe\Sdk\Customer\Customer([
			'name' => $_SESSION['buyer']['name'],
			'email' => $_SESSION['buyer']['email'],
			'document_number' => $_SESSION['buyer']['document_number'],
			'address' => [
				'street' => $_SESSION['buyer']['address']['street'],
				'street_number' =>$_SESSION['buyer']['address']['number'],
				'neighborhood' => $_SESSION['buyer']['address']['neighborhood'],
				'zipcode' => $_SESSION['buyer']['address']['zip'],
				'complementary' => $_SESSION['buyer']['address']['complementary'],
				'city' => $_SESSION['buyer']['address']['city'],
				'state' => $_SESSION['buyer']['address']['state'],
				'country' => 'Brasil'
			],
			'phone' => [
				'ddd' => substr($_SESSION['buyer']['phone'],2,3),
				'number' =>substr($_SESSION['buyer']['phone'],4)
			],
			'born_at' => $_SESSION['buyer']['birthday']
			]);
			$splitrules = null;
			if($transaction_info->split_rules == true){
				$recipient1 = $pagarMe->recipient()->get('re_cj578r1nt00eljp6dzlbjbs4l');
				$recipient2 = $pagarMe->recipient()->get($transaction_info->sec_recipient);
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
			
			
			//TRANSAÇÃO DE CARTÃO DE CRÉDITO
			if($transaction_info->payment_method == 'credit_card'){
				$card = $pagarMe->card()->createFromHash($transaction_info->card_hash);
				try{
					$transaction = $pagarMe->transaction()->creditCardTransaction(
					$amount,
					$card,
					$customer,
					$installments,
					$capture,
					$postbackUrl,
					$metadata,
					[ 'async' => false,
					  'split_rules'=> $splitrules
					]
				);
					$_SESSION['pmethod'] = 'credit_card';
					$_SESSION['errors'] = 'false';
				} catch(PagarMeException $ex){
					$_SESSION['errors'] = 'true';
					$_SESSION['msg'] = $ex->getMessage();
				}
		
			} else {
				try{
					$transaction2 = $pagarMe->transaction()->boletoTransaction(
						$amount,
						$customer,
						$postbackUrl,
						$metadata,
						[
							'async' => false,
							'split_rules'=> $splitrules,
							'boleto_instructions' => 'Não pagar após vencimento'
						]

					);
					$_SESSION['errors'] = 'false';
					$_SESSION['boleto_url'] = $transaction2->getBoletoUrl(); 
					$_SESSION['pmethod'] = 'boleto';
				} catch(PagarMeException $ex){
					$_SESSION['errors'] = 'true';
					$_SESSION['msg'] = $ex->getMessage();
				}
				
			}	
	}
?>