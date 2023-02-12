<?php
  include('config.php');
  include('auth_session.php');
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('./components/head.php') ?>
  <link rel="stylesheet" href="_produtos.style.css">
<body>
  <?php include('./components/header.php') ?>

  <?php
    if ($_POST['productsname'] && $_GET['novo_produto']=='create') {
        $productname = $_POST['productname'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $tipo = $_POST['tipo'];


      

        $result_product = mysqli_query($con, $query_product);
        
        if (!$result_product) {
            die("Error in query: " . mysqli_error($con));
        }
        
        header('Location: _produtos.php');
    }
    else if ($_GET['novo_produto']=='true') {
            echo "
            <div class='modal-container' id='modal-edit'>
            <form class='modal' action='_produtos.php?novo_produto=create' method='POST'>
                  <div class='modal-title-section'>
                    <h3 class='modal-title'>Adicionar novo produto</h3>
                  </div>
        
                  <div class='modal-content'>
                      <div class='modal-form-group'>
                          <label>Título do produto</label>
                          <input type='text' name='productname' class='modal-form-input'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Imagem do produto (link)</label>
                          <input type='text' name='image' class='modal-form-input'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Valor do produto</label>
                          <input type='text' name='price' class='modal-form-input'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Descrição do produto</label>
                          <textarea type='text' name='description' class='modal-form-input txtarea'></textarea>
                      </div>
                      <div class='modal-form-group'>
                          <label style='margin-bottom:15px;'>Tipo do produto</label>
                          <div class='cargo-group'>
                            <span>Lifetime</span>
                            <input type='radio' value='1' name='tipo' class='modal-cargo-input'>
                          </div>
                          <div class='cargo-group'>
                            <span>Mensalidade</span>
                            <input type='radio' value='30' name='tipo' class='modal-cargo-input'>
                          </div>
                      </div>
                          
                      <div class='modal-buttons-section'>
                        <a class='modal-button-action modal-button-close' href='_produtos.php'>Cancelar</a>
                        <button type='submit' class='modal-button-action modal-button-save' href='#'>Criar produto</button>
                      </div>
                  </div>
                </form>
              </div>
            
            ";
    }
    else if (isset($_POST['productname']) && $_GET['id']){
      $id = $_GET['id'];
      $productname = $_POST['productname'];
      $image = $_POST['image'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $tipo = $_POST['tipo'];


      $query_product = "UPDATE products SET title='" . $productname . "', description='" . $description . "', tipo='" . $tipo . "', image='" . $image . "', price='" . $price . "' WHERE id='" . $id . "'";

      $result_product = mysqli_query($con, $query_product);
      
      if (!$result_product) {
          die("Error in query: " . mysqli_error($con));
      }
      
      header('Location: _produtos.php');
    }
    else if ($_GET['edit'] && $_GET['name']) {
      $id = $_GET['edit'];
      $name = $_GET['name'];


      $query_product    = "SELECT * FROM products where id='" . $id . "'";

      $result_product = mysqli_query($con, $query_product);
      
      if (!$result_product) {
          die("Error in query: " . mysqli_error($con));
      }

      
      if (mysqli_num_rows($result_product) > 0) {
        while ($row = mysqli_fetch_assoc($result_product)) {
          $isLifetime = $row['tipo'] == '1' ? 'checked' : '';
          $isSsubscription = $row['tipo'] == '30' ? 'checked' : '';

          if ($id) {
            echo "
            <div class='modal-container' id='modal-edit'>
            <form class='modal' action='_produtos.php?id=" . $id . "' method='POST'>
                  <div class='modal-title-section'>
                    <h3 class='modal-title'>Editar " . $name . "</h3>
                  </div>
        
                  <div class='modal-content'>
                      <div class='modal-form-group'>
                          <label>Título do produto</label>
                          <input type='text' name='productname' class='modal-form-input' value='" . $row['title'] . "'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Imagem do produto (link)</label>
                          <input type='text' name='image' class='modal-form-input' value='" . $row['image'] . "'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Valor do produto</label>
                          <input type='text' name='price' class='modal-form-input' value='" . $row['price'] . "'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Descrição do produto</label>
                          <textarea type='text' name='description' class='modal-form-input txtarea'>" . $row['description'] . "</textarea>
                      </div>
                      <div class='modal-form-group'>
                          <label style='margin-bottom:15px;'>Tipo do produto</label>
                          <div class='cargo-group'>
                            <span>Lifetime</span>
                            <input type='radio' value='1' name='tipo' class='modal-cargo-input' " . $isLifetime . ">
                          </div>
                          <div class='cargo-group'>
                            <span>Mensalidade</span>
                            <input type='radio' value='30' name='tipo' class='modal-cargo-input' " . $isSsubscription . ">
                          </div>
                      </div>
                          
                      <div class='modal-buttons-section'>
                        <a class='modal-button-action modal-button-close' href='_produtos.php'>Cancelar</a>
                        <button type='submit' class='modal-button-action modal-button-save' href='#'>Salvar</button>
                      </div>
                  </div>
                </form>
              </div>
            
            ";
          }
        }
      }
      
    } else if ($_GET['delete'] and $_GET['n'] == 'true') {
      $id = $_GET['delete'];

      $query_product    = "DELETE FROM products WHERE id='" . $id . "'";

      $result_product = mysqli_query($con, $query_product);
      
      if (!$result_product) {
          die("Error in query: " . mysqli_error($con));
      }
      
      header('Location: _produtos.php');
      
    } else if ($_GET['delete'] && $_GET['name']) {
        $id = $_GET['delete'];
        $name = $_GET['name'];

        echo "

          <div class='modal-container' id='modal-edit'>
            <div class='modal'>
              <div class='modal-title-section'>
                <h3 class='modal-title'>Deletar " . $name . "?</h3>
              </div>
    
              <div class='modal-content'>
                  
                  </div>
                      
                  <div class='modal-buttons-section'>
                    <a class='modal-button-action modal-button-close' href='_produtos.php'>Cancelar</a>
                    <a class='modal-button-action modal-button-close' href='?delete=" . $id . "&n=true'>Deletar</a>
                  </div>
              </div>
            </div>
          </div>
        
        ";
      } 
  
  ?>

  <?php if ($_SESSION['permissions'] == '000') { ?>
    <div class="home-body">
      <h1>Produtos</h1>
      <div class="products">
        <a class='new-product' href='_produtos.php?novo_produto=true'>Adicionar novo produto</a>
        <?php
            $query_products    = "SELECT * FROM products";

            $result_products = mysqli_query($con, $query_products);
            
            if (!$result_products) {
                die("Error in query: " . mysqli_error($con));
            }
            
            if (mysqli_num_rows($result_products) > 0) {
                while ($row = mysqli_fetch_assoc($result_products)) {
                  $tipo = "";
                  if ($row['tipo'] == '1') {
                    $tipo = 'Lifetime';
                  } else if ($row['tipo'] == '30') {
                    $tipo = 'Mensalidade';
                  } else {
                    $tipo = '???';
                  }
                    echo "
                      <div class='product'>
                        <div class='product-data'>
                          <span>(" . $row['id'] . ") " . $row['title'] . " | " . $tipo . " | <b>" . $row['price'] . "</b></span>
                        </div>
                        <div class='product-actions'>
                          <a href='_produtos.php?edit=" . $row['id'] . "&name=" . $row['title'] . "' class='product-button edit'>
                            Editar
                          </a>
                          <a href='_produtos.php?delete=" . $row['id'] . "&name=" . $row['title'] . "' class='product-button delete'>
                            Deletar
                          </a>
                        </div>
                      </div>
                    ";
                }
            }
      ?>
      </div>
    </div>
  <?php } else {
    header('Location: index.php');
    exit();
  } ?>


</body>
</html>