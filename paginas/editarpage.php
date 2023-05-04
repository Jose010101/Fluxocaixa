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
    <title>Document</title>
</head>
<body>
    <center>
        <!-- Exibe os dados referentes ao produto que vai ser editado -->
    <?php
    $idprod = $_GET['produtoid'];

    $sql_estoque = "SELECT * FROM estoque WHERE id_prod = '$idprod'";
    $stmt_estoque = $conn->prepare($sql_estoque);
    $stmt_estoque->execute();
    $row = $stmt_estoque->fetch(PDO::FETCH_ASSOC);
    $id = $row['id_prod'];
        echo  "<img class='imgShow' src=../DisplayProduto/".$row['img_prod']." height= '100' width = 'auto'>";
        echo "<br>";
        echo "Nome do produto: ".$row['nome_prod']."";
        echo "<br>";
        echo "Código do produto: ".$row['codigo_prod']."";
        echo "<br>";
        echo "Valor do produto: R$".number_format($row['valor_prod'],2,',','.')."";
        echo "<br>";
        echo "Quantidade do produto: ".$row['qtd_prod']."";
        echo "<hr>";
    
    ?>
        <!-- ----- -->

        <!-- Formulário para atualização dos dadosdo produto -->
    <form action="../funcoes/editarcode.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="novoNome" placeholder="Novo nome" required>
        <br>
        <input type="text" name = "idproduto" hidden value = "<?php $id ?>">
        <?php
        echo "<input type='text' name='idproduto' hidden value = '$id'>"
         ?>
        <input type="number" name="novoQtd" placeholder="Quantidade do produto" required>
        <br>
        <input type="number" name="novoValor" placeholder="Valor do produto" required step="0.01">
        <br>
        <input type="submit" name="submit">

    </form>
        <!-- ----- -->
    </center>
</body>
</html>
