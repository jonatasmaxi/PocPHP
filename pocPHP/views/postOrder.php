<?php
	session_start();
	print_r($_SESSION['buyer']['address']['street']);
	print_r($_SESSION['transaction_info']);
?>