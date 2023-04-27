<?php
session_start();
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
// Se o funcionário for diferente de Administrador e ele estive logado, levará para a página inicial de vendedor  
elseif($_SESSION['tipousuario']!= "Administrador"){
    header("Location:paginavendedor.php");
}
// Remove os itens do carrinho
if (isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}
include "../conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
</head>
<body>
<form action="../funcoes/cadastrofuncionariocode.php" method="POST">
    <input type="text" name="nome_user" placeholder="Nome do funcionário">
    <br>
    <select name="tipo_user">
        <option value="Vendedor">Vendedor</option>
        <option value="Administrador">Administrador</option>
    </select>
    <br>
    <input type="password" name="senha_user" placeholder="Senha do funcionário">
    <br>
    <!-- Mensagens de erro -->
    <?php 
    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo "<div class='a'>Este funcionário já está cadastrado!</div>";
    }
    elseif(isset($_GET['erro']) && $_GET['erro'] == 2){
        echo "<div class='a'>Comprimento da senha inválido<br>Insira uma senha de 5 caracteres</div>";
    }
    ?>
    <input type="submit" name="submit">
    <!-- ----- -->
    </form>
</body>
</html>