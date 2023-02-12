<?php
  //include auth_session.php file on all user panel pages
  include("auth_session.php");
  include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <?php include('./components/head.php') ?>
  <link rel="stylesheet" href="conta.style.css">
<body>
  <?php include('./components/header.php'); 

  $permissions = $_SESSION['permissions'];
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

  ?>

  <div class="home-body">
    <h1>Minha conta</h1>
    
    <div class="account-data">

        <div class="account-user-section">
            <span class="account-username">Bem vindo, <b><?php echo $_SESSION['username']; ?></b>!</span>
        </div>

        <div class="account-data-section">
            <span class="account-text">Seu cargo: <b><?php echo $cargo; ?></b></span>
            <span class="account-email">Seu email: <b><?php echo $_SESSION['email']; ?></b></span>
        </div>

        <?php if ($permissions == '000') { ?>
          <div class="account-admin-section">
            <h3 class='account-admin-title'>Administração</h3>
            <a class='account-admin-button' href='usuarios.php'>Usuários</a>
            <a class='account-admin-button' href='_produtos.php'>Produtos</a>
          </div>
        <?php } ?>

        <div class="logout">
            <a class="sair" href="logout.php">Sair</a>
        </div>
    </div>
  </div>
</body>
</html>