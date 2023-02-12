<?php
  require('config.php');
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('./components/head.php') ?>
  <link rel="stylesheet" href="produtos.style.css">
<body>
  <?php include('./components/header.php') ?>

  <div class="home-body">
    <h1 class="produtos-title">Produtos</h1>
    
    <?php

        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
        $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));

        function returnMessage($message) {
            echo "<span class='produtos-message'>" . $message . "</span>";
        }


        if ($isMob) {
          returnMessage('Clique nos produtos para saber mais.');
        } else if ($isTab) {
          returnMessage('Clique nos produtos para saber mais.');
        } else {
          returnMessage('Passe o cursor do mouse por cima dos produtos para saber mais.');
        }
    ?>

    <div class="produtos">
    <?php
          $query_products    = "SELECT * FROM products";

          $result_products = mysqli_query($con, $query_products);
          
          if (!$result_products) {
              die("Error in query: " . mysqli_error($con));
          }
          
          if (mysqli_num_rows($result_products) > 0) {
              while ($row = mysqli_fetch_assoc($result_products)) {
                    echo "<div class='produto'>
                    <div class='front'>
                      <img class='produto-image' src='" . $row['image'] . "' />
                      <div class='produto-info'>
                        <span class='produto-title'>" . $row['title'] ." | <b>R$ " . $row['price'] ."</b></span>
                      </div>
                    </div>
                    <div class='back'>
                      <div class='back_top'>
                        <span>Descrição</span>
                        <p>" . $row['description'] . "</p>
                      </div>
                      <div class='back_bottom'>
                      <a class='produto-comprar' href='https://discord.gg/hDzTzmvJ6h'>Comprar</a>
                      </div>
                    </div>
                  </div>";

              }
          } else {
            $_SESSION['produtos'] = [
              [
                "image"=>"./assets/b.png",
                "title"=>"Baimless",
                "price"=>23.00,
                "description"=>"teste"
              ]
            ];
          }
    ?>
    </div>
    
  </div>
</body>
</html>