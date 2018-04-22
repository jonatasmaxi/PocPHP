<?php
	require '../vendor/autoload.php';
	session_start();
	$pagarMe = new \PagarMe\Sdk\PagarMe('ak_test_dPHe9boNcLuEi1srYJKAosFoBNUgAK');
	$amount = $_SESSION['product']['price'];
	$rate = 2;
	$rateFreeInstallments = 1;
	$maxInstallments = 12;
	$installments = $pagarMe->calculation()->calculateInstallmentsAmount(
		$amount,
		$rate,
		$rateFreeInstallments,
		$maxInstallments
	);
	$_SESSION["installments"] = $installments;
	$str = file_get_contents('../storage/customer.json');
	$json = json_decode($str, true);
	$_SESSION["customer"] = $json[0];
	header("Location: ../views/checkoutForm.php");
	exit();
?>