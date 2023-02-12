<?php
  include('config.php');
  include('auth_session.php');
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('./components/head.php') ?>
  <link rel="stylesheet" href="usuarios.style.css">
<body>
  <?php include('./components/header.php') ?>

  <?php

  
    if (isset($_POST['username'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $cargo = $_POST['cargo'];

      echo $cargo[0];
    }
    else if ($_GET['edit']) {
      $id = $_GET['edit'];


      $query_user    = "SELECT * FROM users where id='" . $id . "'";

      $result_user = mysqli_query($con, $query_user);
      
      if (!$result_user) {
          die("Error in query: " . mysqli_error($con));
      }

      
      if (mysqli_num_rows($result_user) > 0) {
        while ($row = mysqli_fetch_assoc($result_user)) {
          
          if ($id) {
            echo "
              <div class='modal-container' id='modal-edit'>
                <form class='modal' action='usuarios.php' method='POST'>
                  <div class='modal-title-section'>
                    <h3 class='modal-title'>Editar " . $row['username'] . "</h3>
                  </div>
        
                  <div class='modal-content'>
                      <div class='modal-form-group'>
                          <label>Usuário</label>
                          <input type='text' name='username' class='modal-form-input' value='" . $row['username'] . "'>
                      </div>    
                      <div class='modal-form-group'>
                          <label>Email</label>
                          <input type='email' name='email' class='modal-form-input' value='" . $row['email'] . "'>
                      </div>
                      <div class='modal-form-group'>
                          <label style='margin-bottom:15px;'>Cargo</label>
                          <div class='cargo-group'>
                            <span>Administrador</span>
                            <input type='radio' id='cargo-administrador' value='administrador' name='cargo' class='modal-cargo-input'>
                          </div>
                          <div class='cargo-group'>
                            <span>Usuário</span>
                            <input type='radio' id='cargo-usuario' value='usuario' name='cargo' class='modal-cargo-input'>
                          </div>
                          <div class='cargo-group'>
                            <span>Cliente</span>
                            <input type='radio' id='cargo-cliente' value='cliente' name='cargo' class='modal-cargo-input'>
                          </div>
                      </div>
                          
                      <div class='modal-buttons-section'>
                        <a class='modal-button-action modal-button-close' href='usuarios.php'>Cancelar</a>
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

      $query_user    = "DELETE FROM users WHERE id='" . $id . "'";

      $result_user = mysqli_query($con, $query_user);
      
      if (!$result_user) {
          die("Error in query: " . mysqli_error($con));
      }
      
      header('Location: usuarios.php');
      
    } else if ($_GET['delete']) {
        $id = $_GET['delete'];

        echo "

          <div class='modal-container' id='modal-edit'>
            <div class='modal'>
              <div class='modal-title-section'>
                <h3 class='modal-title'>Deletar " . $row['username'] . "</h3>
              </div>
    
              <div class='modal-content'>
                  
                  </div>
                      
                  <div class='modal-buttons-section'>
                    <a class='modal-button-action modal-button-close' href='usuarios.php'>Cancelar</a>
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
      <h1>Usuários</h1>
      <div class="users">
        <?php
            $query_users    = "SELECT * FROM users";

            $result_users = mysqli_query($con, $query_users);
            
            if (!$result_users) {
                die("Error in query: " . mysqli_error($con));
            }
            
            if (mysqli_num_rows($result_users) > 0) {
                while ($row = mysqli_fetch_assoc($result_users)) {
                  $permissions = $row['permissions'];
                  $cargo = "";

                  if ($permissions == '1') {
                    $cargo = "Usuário";
                  } else if ($permissions == '000') {
                    $cargo = "Administrador";
                  } else if ($permissions == '777') {
                    $cargo = "Cliente";
                  } else {
                    $cargo = "Usuário";
                  }
                    echo "
                      <div class='user'>
                        <div class='user-data'>
                          <span>(" . $row['id'] . ") " . $row['username'] . " | <b>" . $cargo . "</b></span>
                        </div>
                        <div class='user-actions'>
                          <a href='usuarios.php?edit=" . $row['id'] . "' class='user-button edit'>
                            Editar
                          </a>
                          <a href='usuarios.php?delete=" . $row['id'] . "' class='user-button delete'>
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