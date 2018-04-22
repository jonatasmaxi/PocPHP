<!DOCTYPE HTML>
<html>
	<head>
		<title> Minhas transações </title>
		<meta charset = "UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="styles/styleTable.css"/>

	</head>
	<body>
		<?php session_start();?>
		<table class='transactionsTable'> 
			<thead>
				<th> ID Da Transação </th>
				<th> Valor da transação (em centavos) </th>
				<th> Nome do comprador </th>
				<th> E-mail do comprador </th>
			</thead>
			<?php 
				for($i = 0; $i < count($_SESSION['transactions']);$i++){
					echo "<tr>";
					echo "<td>".$_SESSION['transactions'][$i]->id."</td>";
				}
			?>
		</table>
	</body>

</html>