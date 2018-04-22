<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://assets.pagar.me/pagarme-js/3.0/pagarme.min.js"></script>
  <title> Checkout </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./styles/styleCheckout.css"/>
  <script language="JavaScript"> 
    $(document).ready(function () {
     $('.person-type').click(function() {
         if($(this).attr('id') == 'individual') {
              $('#CPF').show();  
              $("#CNPJ").hide();      
         }

         else {
              $('#CPF').hide();
              $('#CNPJ').show();   
         }
     });
     $('.payment-method').click(function(){
     	if($(this).attr('id') == 'cartao') {
     		$('#credit_card_div').show();
     	} else{
     		$('#credit_card_div').hide();
     	}
     })
  });
</script>
</head>
<body onload='defineInstallments()'>

<h2>Checkout</h2> 
<?php session_start();?>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/" id="payment_form">
      
        <div class="row">
          <div class="col-50">
            <h3>Endereço</h3>
            <label for="fname"><i class="fa fa-user"></i> Nome Completo</label>
            <input type="text" id="name" name="name" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="phone"> <i class="fa fa-phone"></i> Telefone </label>
            <input type="text" id="fa-phone" name = "phone" placeholder="+5511985457878"/>
            <label for="birthday"> <i class="fa fa-birthday-cake"> </i> Data de nascimento </label>
            <input type="date" id="birthday" name="birthday" placeholder="09/10/1996">
            <label for="adr"><i class="fa fa-address-card-o"></i> Rua</label>
            <input type="text" id="adrStreet" name="address" placeholder="Rua Rio Madeira">
            <label for="adr"><i class="fa fa-address-card-o"></i> Número da rua</label>
            <input type="text" id="adrNumber" name="number" placeholder="7">
            <label for="adr"><i class="fa fa-address-card-o"></i> Complemento</label>
            <input type="text" id="adrComplementary" name="complementary" placeholder="B">
             <label for="adr"><i class="fa fa-address-card-o"></i> Bairro</label>
            <input type="text" id="adrNeighborhood" name="neighborhood" placeholder="Parque Miami">
            <label for="city"><i class="fa fa-institution"></i> Cidade</label>
            <input type="text" id="city" name="city" placeholder="Santo Andre">

            <div class="row">
              <div class="col-50">
                <label for="state">Estado</label>
                <select name="state" id='state'>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
              </div>
              <div class="col-50">
                <label for="zip">CEP</label>
                <input type="text" id="zip" name="zip" placeholder="09133180">
              </div>
            </div>
          </div>
          <div class="col-50">
                <input type="button" value="Autocompletar Dados" onClick="loadData()" class="btn" />
                 <label for="person-type" > <h3> Documento </h3> </label>
                 <input type="radio" class ="person-type" name="person-type"  id ='individual' value="individual" checked> Pessoa Física
                 <input type="radio" class ="person-type" name="person-type"  id='corportate' value="corporate">Pessoa Jurídica<br>
                 <div id ='CPF'> 
                   <label for="CPF"> CPF </label>
                   <input type="text" id="CPFText" name="CPF" placeholder="11111111111">
                 </div>
                 <div id ='CNPJ' style="display:none">
                   <label for="CNPJ"> CNPJ </label>
                   <input type="text" id="CNPJText" name="CNPJ" placeholder="11111111111111">
                 </div>
            <h3>Pagamento</h3>
            <input type="radio"  class = 'payment-method' name="payment-method"  id='cartao' value="cartao" checked/> Cartão de crédito 
           	<input type="radio" class ='payment-method' name="payment-method"  id ='boleto' value="boleto"/> Boleto Bancário <br>
     
            <div id='credit_card_div'>
	            <label for="cname">Nome do portador do cartão</label>
	            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
	            <label for="ccnum">Número do cartão</label>
	            <input type="text" id="ccnum" name="cardnumber" placeholder="1111222233334444">
	           
	    
	            <div class="row">
	              <div class="col-50">
		              <label for="expmonth">Mes de Expiração</label>
		              <input type="text" id="expmonth" name="expmonth" placeholder="09"/>
	              </div>
	              <div class="col-50">
		               <label for="expyear">Ano de expiração</label>
		               <input type="text" id="expyear" name="expyear" placeholder="2018">
	              </div>
	            </div>
	            <label for="cvv">CVV</label>
	            <input type="text" id="cvv" name="cvv" placeholder="352">
              <div id='menu-installments'>
  	            <label for="sinstallments"> Parcelas </label>
  	            <select id ='installments' name='sinstallments'>  	            
	  	            <?php
	  	            	for($i = 1;$i <= count($_SESSION['installments']);$i++){
	  	            
	  	            		echo '<option value =($i+1)>'.$i. 'x de '. $_SESSION['installments'][$i]['installment_amount'].' </option>';
	  	            	}
	  	            ?>
  	            </select>
              </div>
	          </div>
	       	</div>
        </div>

        <input type="submit" value="Pagar" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>1</b></span></h4>
        <?php print_r($_SESSION['product']['name']);?>
      <p> <span class="price"><?php print_r($_SESSION['product']['price']);?></span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b> 
        <?php print_r($_SESSION['product']['price']);?>
      </b></span></p>
    </div>
  </div>
</div>
<script>
/*	function sendData(transactionInformation,customer,url){
          	$.ajax({
                  type: "POST",
                  url: url,
                  data: {
                    'customer': customer,
                    'transactionInformation': transactionInformation,
                },
                success: function(res) {
                  window.location = '/postOrder?data='+res
                }
                
              }); 

                        
	} */

    function defineInstallments(){
    	var type = '<?php echo $_SESSION['product']['type'];?>';
    	if(!(type === 'product')){
    		$('#menu-installments').hide(); 
    	} 
 
    }; 
    function loadData(){
      $("#payment_form #name").val('<?php echo $_SESSION['customer']['name'];?>');
      $("#payment_form #email").val('<?php echo $_SESSION['customer']['email'];?>');
      $("#payment_form #fa-phone").val('<?php echo $_SESSION['customer']['phone'];?>');
      $("#payment_form #birthday").val('<?php echo $_SESSION['customer']['birthday'];?>');
      $("#payment_form #adrStreet").val('<?php echo $_SESSION['customer']['street'];?>');
      $("#payment_form #adrNumber").val('<?php echo $_SESSION['customer']['street_number'];?>');
      $("#payment_form #adrComplementary").val('<?php echo $_SESSION['customer']['complementary'];?>');
      $("#payment_form #adrNeighborhood").val('<?php echo $_SESSION['customer']['neighborhood'];?>');
      $("#payment_form #city").val('<?php echo $_SESSION['customer']['city'];?>');
      $("#payment_form #state").val('<?php echo $_SESSION['customer']['state'];?>');
      $("#payment_form #zip").val('<?php echo $_SESSION['customer']['zipcode'];?>');
      $("#payment_form #CPFText").val('<?php echo $_SESSION['customer']['document_number'];?>'); 
    }; 
 	/*
    $(document).ready(function() { 
      var form = $("#payment_form")
      form.submit(function(event) {
          event.preventDefault();   
          var person_type = '';
          var document_number = '';
          if($('input[name=person-type]:checked').val() == 'individual'){
            person_type = "individual";
            document_number = $("#payment_form #CPFText").val();
          } else{
            person_type = "corporation";
            document_number = $("#payment_form #CNPJText").val();
          }
         
          var sec_recipient = '';
          var splitRules =  <%- JSON.stringify(product.split_rules) %>;
          var installments = $("#payment_form #installments").val();

          if(splitRules === 'yes'){
            sec_recipient =  <%- JSON.stringify(product.rid) %>;
          } 
          var payment_method = '';
          if($('input[name=payment-method]:checked').val() === 'cartao'){
           		payment_method = 'cartao';
           } else{
           		payment_method = 'boleto';
           		installments = '1';
           }
          var customer = {
          	'name': $("#payment_form #name").val(),
          	'email': $("#payment_form #email").val(),
          	'document_number': document_number,
          	'person_type': person_type,
          	'phone': $("#payment_form #fa-phone").val(),
          	'birthday': $("#payment_form #birthday").val(),
          	'address': {
          		'street':$("#payment_form #adrStreet").val(),
          		'number':  $("#payment_form #adrNumber").val(),
          		'complementary':  $("#payment_form #adrComplementary").val(),
          		'neighborhood': $("#payment_form #adrNeighborhood").val(),
          		'city':  $("#payment_form #city").val(),
          		'state': $("#payment_form #state").val(),
          		'zip': $("#payment_form #zip").val()
          	}
         }
         var transactionInformation = {
          	'amount': <%- JSON.stringify(product.price) %>,
          	'split_rules': splitRules,
          	'sec_recipient': sec_recipient,
          	'plan_id': <%- JSON.stringify(product.plan_id) %>,
          	'item_name': <%- JSON.stringify(product.name) %>,
          	'installments': installments,
          	'payment_method': payment_method
          }
          var url = '';
          if( <%- JSON.stringify(product.type) %> === 'product' ){
                  url  = '/createTransaction';
          } else{
                  url = '/createSubscription';
          }

          var hash = ''
          if(payment_method == 'cartao'){
	          	var card = {} 
		        card.card_holder_name = $("#payment_form #cname").val()
		        card.card_expiration_date = $("#payment_form #expmonth").val() + '/' + $("#payment_form #expyear").val()
		        card.card_number = $("#payment_form #ccnum").val()
		        card.card_cvv = $("#payment_form #cvv").val()
		        var cardValidations = pagarme.validate({card: card})
	          	pagarme.client.connect({ encryption_key: 'ek_test_doAgNCp6z9m7W3Mszn6x5HKy0oq8dK' })
	            .then(client => client.security.encrypt(card))
	            .then(card_hash => {
	                hash = card_hash
	             	transactionInformation.hash = hash;
	             	sendData(transactionInformation,customer,url);
	             })  
          }else{
          	sendData(transactionInformation,customer,url);
          }
          return false
    });
}); */
</script>

</body>
</html>
