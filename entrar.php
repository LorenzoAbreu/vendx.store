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
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";

        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        
        if ($rows == 1) {
            
            $query1    = "SELECT * FROM `users` WHERE username='$username'
            AND password='" . md5($password) . "'";

            $result1 = mysqli_query($con, $query1);
            if (!$result) {
                die("Error in query: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = md5($row['password']);
                    $_SESSION['permissions'] = $row['permissions'];

                    // Redirect to user dashboard page
                    header("Location: produtos.php");
                }
            } else {
                header("Location: logout.php");
            }


            
        } else {
            // echo "<div class='form'>
            //       <h3>Usuário ou senha inválidos.</h3><br/>
            //       <p class='link'>Clique <a href='entrar.php'>aqui</a> para voltar.</p>
            //       </div>";
            modal("Usuário ou senha inválidos", "Seu usuário, ou sua senha, estão inválidos. Por favor tente entrar novamente.", "Tentar novamente", "entrar.php", false, "error");
        }
    } else {
?>
  <div class="wrapper">
        <h1>Entrar</h1>
        <form action="" method="post" name="login">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="username" class="form-input">
            </div>    
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" class="form-input">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
            <p>Não tem uma conta? <a href="registrar.php">Criar nova conta</a>.</p>
        </form>
    </div>

    <?php
    }
?>
</body>
</html>