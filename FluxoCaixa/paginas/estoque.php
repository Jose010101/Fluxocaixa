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
echo $_SESSION['nome'];
echo "<br>
<a href='Loggoutcode.php'>Sair</a>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <center>
    <a href="cadastroproduto.php">
    <input type="Button" value="Cadastrar produto" >
    </a>
    <a href="paginaadm.php">
    <input type="Button" value="Início" >
    </a>
</center>
    </input>
    <br>
    <!-- Exibe todos os produtos que estão cadastrados, dando a possibilidade de editar e excluir estes produtos  -->
    <?php
       $sql_estoque = "SELECT * FROM estoque";
       $stmt_estoque = $conn->prepare($sql_estoque);
       $stmt_estoque->execute();
       while ($row = $stmt_estoque->fetch(PDO::FETCH_ASSOC)){
    echo  "<img class='imgShow' src=../DisplayProduto/".$row['img_prod']." height= '100' width = 'auto'>";
    echo "<br>";
    echo "Nome do produto: ".$row['nome_prod']."";
    echo "<br>";
    echo "Código do produto: ".$row['codigo_prod']."";
    echo "<br>";
    echo "Valor do produto: R$".number_format($row['valor_prod'],2,',','.')."";
    echo "<br>";
    echo "Quantidade do produto: ".$row['qtd_prod']."";
    echo"<br>";
    echo"<br>";
    echo "<a href='editarpage.php?produtoid=$row[id_prod]'><input type='Button' value='Editar'> </a>";
    echo "<a href='../funcoes/excluircode.php?produtoid=$row[id_prod]'><input type='Button' value='Excluir'> </a>";
    echo"<hr>";
       }
    ?>
    <!-- ----- -->
</body>
</html>