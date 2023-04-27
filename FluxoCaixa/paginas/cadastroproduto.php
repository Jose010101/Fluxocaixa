<?php
Session_start();
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
<html lang="p-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CadastroProduto</title>
</head>
<body>
    <!-- Formulário para cadastro de produtos -->
    <form action="../funcoes/cadastroprodutocode.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nomeProduto" placeholder="Nome do produto" required>
        <br>
        <input type="number" name="qtdProduto" placeholder="Quantidade do produto" required >
        <br>
        <input type="number" name="valorProduto" placeholder="Valor do produto" required step="0.01">
        <br>
        <input type="text" name="codigoProduto" placeholder="Código do produto"required>
        <br>
        <input type="file" name="imgProduto">
        <br>
        <input type="submit" name="submit">
    </form>
    <!-- ----- -->
</body>
</html>