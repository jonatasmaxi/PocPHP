<?php
	session_start();
	$idProduto = $_GET['id'];
	$str = file_get_contents('../storage/products.json');
	$json = json_decode($str, true);
	//echo '<pre' .print_r($json,true) . '</pre>';
	for($i = 0;$i < count($json);$i++){
		if($idProduto == $json[$i]['id']){
			$_SESSION["product"] = $json[$i];
			break;
		}
	}
	print_r($_SESSION["product"]);
	header("Location: ../views/producPage.php");
	exit();
?>