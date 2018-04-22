<!DOCTYPE HTML>
<html>
	<head>
		<title> Status do Pedido </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <link rel="stylesheet" href="styles/stylePostOrder.css"/>
		<meta charset = "UTF-8">
	</head>
	<body>
		<?php session_start(); ?>
		<nav id ='menu'>
			<ul>
				<li>  <a href='/getSubscriptions'> Minhas assinaturas </a> </li>
				<li>  <a href='/getTransactions'>  Minhas transações  </a> </li>
			</ul>
		</nav>
		<p> <h3> Status do Pedido </h3> </p>
		<div id ='divBoleto'>
			<p> <b> Sua Transação foi criada com sucesso </b></p>
			<p> <b> Nome do produto: </b>  <?php print_r($_SESSION['product']['name']);?>   </p>
			<p> </b> Valor do produto </b> (em centavos):<?php print_r($_SESSION['product']['price']);?>  </p> <br>
			<form id ='boletoForm' target ='_blank'>
				<input type = 'submit' value ='Imprimir Boleto' class ='btn'/>
			</form>
		</div>
		<div id = 'divTransaction'>
			<p>	<b>Sua Transação foi criada com sucesso </b> </p>  
			<h4> <?php print_r($_SESSION['product']['name']);?> </h4>
			<p> Valor do produto (em centavos): <?php print_r($_SESSION['product']['price']);?> </p>
		</div>
		<div id = 'divSubscription'>
	
			<h4> <?php print_r($_SESSION['product']['name']);?>  </h4>
			<p> Valor do produto (em centavos): <?php print_r($_SESSION['product']['price']);?>  </p>
			<p> ID do plano:  <?php print_r($_SESSION['product']['plan_id']);?> </p>
			<?php if($_SESSION['pmethod'] == 'boleto'){
				echo '<a href='.$_SESSION['boleto_url'].'<input type=submit value=Imprimir Boleto class=btn/></a>';
			} ?>
		
		</div>

		<div id ='div_errors'>
			<h4> Houve um erro na criação da sua transação </h4>
			<p> <?php print_r($_SESSION['msg']);?> </p>
		</div>
	</body>
	<script>
		  var status = '<?php echo $_SESSION['errors'];?>';
		  console.log(status);
	 	  var product_type = '<?php echo $_SESSION['product']['type'];?>';
	 	  console.log(product_type);
	 	  var payment_method = '<?php echo $_SESSION['pmethod']?>';
	 	  console.log(payment_method);
		  if( product_type === 'product' && status === 'false' && payment_method === 'credit_card'){
		  	$('#divTransaction').show();
		  	$('#divSubscription').hide();
		  	$('#divBoleto').hide();
		  	$('#div_errors').hide();
		  } else if(product_type === 'product' && payment_method === 'boleto'){
		  	$('#divTransaction').hide();
		  	$('#divSubscription').hide();
		  	$('#divBoleto').show();
		  	$('#div_errors').hide();
		  	var boleto_url = '<?php echo $_SESSION['boleto_url'];?>';
		  	console.log(boleto_url);
		  	$('#boletoForm').attr("action",'<?php echo $_SESSION['boleto_url'];?>');
		  } else if (status === 'true'){
		  	$('#divTransaction').hide();
		  	$('#divSubscription').hide();
		  	$('#divBoleto').hide();
		  	$('#div_errors').show();
		  } else if(product_type=== 'subscription' && (status === 'false')) {
		  	$('#divTransaction').hide();
		  	$('#divSubscription').show();
		  	$('#divBoleto').hide();
		  	$('#div_errors').hide();
		  }
	</script>
</html>


