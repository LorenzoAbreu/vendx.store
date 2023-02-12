<!DOCTYPE html>
<html lang="pt-br">
<?php include('./components/head.php') ?>
<link rel="stylesheet" href="./auth.style.css">
<body>
  <?php include('./components/header.php') ?>
  <?php include('./components/modal.php') ?>
  <?php
    require('config.php');
    session_start();
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $created_at = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, permissions, created_at)
                     VALUES ('$username', '" . md5($password) . "', '$email', '1', '$created_at')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            modal("Conta criada com sucesso!", "Parabéns! Você acabou de criar uma nova conta, clique no botão abaixo para acessar-la.", "Entrar", "entrar.php", false, "success");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registrar.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>

<div class="wrapper">
        <h1>Criar conta</h1>
        <form action="" method="post">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="username" class="form-input">
            </div>    
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-input">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" class="form-input">
            </div>
            <div class="form-group">
                <label>Confirme a senha</label>
                <input type="password" name="confirm_password" class="form-input">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Criar conta">
            </div>
            <p>Já tem uma conta? <a href="entrar.php">Entre aqui</a>.</p>
        </form>
    </div>

<?php
    }
?>
  
</body>
</html>