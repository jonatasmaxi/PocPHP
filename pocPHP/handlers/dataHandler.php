<?php
	$controllersPath = '../controllers';
	require_once'customerHandler.php';
	require_once'transactionHandler.php';
	require_once $controllersPath.'/transactionController.php';
	require_once $controllersPath.'/subscriptionController.php';
	session_start();
	putCustomerToSection();
	if($_SESSION['product']['type'] == 'product'){
			putsTransactionInfoToSession();
			createTransaction();
	}
?>