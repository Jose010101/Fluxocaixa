<?php
if (isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
  }
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Página de Login</title>
</head>
<body>
    <form action="Funcoes/logincode.php" method="POST">
    <input type="text" name="codigo_user" placeholder="Código do usuário">
    <br>
    <input type="password" name="senha_user" placeholder = "Senha do usuário">
    <br>
    <!-- Exibição de erro -->
    <?php 
    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo "<div class='a'>Usuário ou senha incorretos!</div>";
    }
    ?>
    <!-- ----- -->
    <input type="submit" name="submit">

    </form>
</body>
</html>
