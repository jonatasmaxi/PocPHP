<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Página do Produto</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="./styles/styleProduct.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />
   

  </head>

  <body>
    <?php session_start(); ?>
    <main class="container">

      <!-- Left Column / Headphones Image -->
      <div class="left-column">
    
        <?php 
          $imgPath = "./images/".$_SESSION['product']['img'];
        ?>
        <img src="<?php echo $imgPath ?>"

      </div>


      <!-- Right Column -->
      <div class="right-column">

        <!-- Product Description -->
        <div class="product-description">
          <span> <?php print_r($_SESSION['product']['sub_description']);?> </span>
          <h1>   <?php print_r($_SESSION['product']['name']);?> </h1>
          <p> <?php print_r($_SESSION['product']['description']);?> .</p>
        </div>
        <!-- Product Pricing -->
        <div class="product-price">
          <span> R$ <?php print_r($_SESSION['product']['price']);?> </span>
          <a href="./checkoutForm.php" id="button-netflix" class="cart-btn"> Comprar</a>
        </div>
      </div>
    </main>
  </body>
</html>
