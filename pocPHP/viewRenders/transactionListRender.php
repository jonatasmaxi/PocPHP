<?php
	require '../vendor/autoload.php';
	session_start();
	$pagarMe = new \PagarMe\Sdk\PagarMe('ak_test_dPHe9boNcLuEi1srYJKAosFoBNUgAK');
	$page = 1;
	$count = 10;
	$transactionList = $pagarMe->transaction()->getList($page, $count);
//	$transactionList= json_encode($transactionList);
	$_SESSION['transactions'] = $transactionList;
	header("Location: ../views/listTransactions.php");
?>