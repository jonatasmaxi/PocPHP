<?php
	function putsSubscriptionInfoToSession(){
		$subscription_info->payment_method = $_POST['transactionInformation']['payment_method'];
		$subscription_info->plan_id = $_SESSION['product']['plan_id'];
		if($_SESSION['product']['split_rules'] == 'yes'){
			$subscription_info->split_rules = true;
			$subscription_info->sec_recipient = $_SESSION['product']['rid'];
		} else {
			$subscription_info->split_rules = false;
		}
		if($subscription_info->payment_method == 'credit_card'){
			$subscription_info->card_hash = $_POST['transactionInformation']['hash'];
		}
		$subscription_info = json_encode($subscription_info);
		$_SESSION['subscription_info'] = $subscription_info;
	}

?>