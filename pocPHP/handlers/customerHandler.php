<?php
	function putCustomerToSection(){
		session_start();
		$_SESSION['buyer'] = $_POST['customer'];
	}
?>