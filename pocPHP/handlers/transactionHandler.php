<?php
	function putsTransactionInfoToSession(){
		$transaction_info->installments = $_POST['transactionInformation']['installments'];
		$transaction_info->payment_method = $_POST['transactionInformation']['payment_method'];
		$transaction_info->amount = $_SESSION['product']['price'];
		if($_SESSION['product']['split_rules'] == 'yes'){
			$transaction_info->split_rules = true;
			$transaction_info->sec_recipient = $_SESSION['product']['rid'];
		} else {
			$transaction_info->split_rules = false;
		}
		if($transaction_info->payment_method == 'credit_card'){
			$transaction_info->card_hash = $_POST['transactionInformation']['hash'];
		}
		$transaction_info = json_encode($transaction_info);
		$_SESSION['transaction_info'] = $transaction_info;
	}
?>