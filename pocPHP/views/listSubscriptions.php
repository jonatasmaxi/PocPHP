<!DOCTYPE HTML>
<html>
	<head>
		<title> Minhas Assinaturas </title>
		<meta charset = "UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="/styleTable.css"/>

	</head>
	<body>
		<table class='transactionsTable'> 
			<thead>
				<th> ID Da Assinatura </th>
				<th> ID do Plano </th>
				<th> Nome do comprador </th>
				<th> E-mail do comprador </th>
			</thead>
		</table>
	</body>
	<script>
			var subscriptions = <%- JSON.stringify(subscriptions) %>
			var table = $('.transactionsTable');
			console.log(subscriptions)
			for(var i = 0;i < subscriptions.length;i++){
				table.append("<tr><td>"+subscriptions[i].id+"</td>"+
					"<td>"+subscriptions[i].plan.id+"</td>"+
					"<td>"+subscriptions[i].customer.name+"</td>"+
					"<td>"+subscriptions[i].customer.email+"</td></tr>"
				)
			}
	</script>
</html>