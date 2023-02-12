<?php include('userData.php') ?>

<header>
  <a class="logo" href="/">
    <img src="../assets/logo.png" />
  </a>

  <div class="links">
    <a href="/index.php" class="link">Home</a>
    <a href="/produtos.php" class="link">Produtos</a>
    <a href="/sobre.php" class="link">Sobre nós</a>
  </div>

  <?php
      session_start();
      if(isset($_SESSION["username"])) {
  ?>
  <div class="login">
    <a href="./conta.php">Minha conta</a>
  </div>

<?php } else { ?>

  <div class="login">
    <a href="./entrar.php">Entrar</a>
  </div>

<?php } ?>
</header>