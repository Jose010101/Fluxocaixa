<?php
session_start();
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
if (isset($_SESSION['carrinho'])){
  $_SESSION['carrinho'] = array();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/visualizarprodutos.css">
    <title>Visualizar Produtos</title>
</head>
<body>
    <h1 class='text-center'>Produtos da venda </h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Código</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor unitário</th>
    </tr>

  </thead>
  <tbody>
    <!-- Exibe todos os produtos referentes à compra -->
  <?php
$id = $_GET['idvenda'];
include "../conexao.php";
$sql_produtos_vendas_antigas = "SELECT * FROM itens_venda WHERE id_venda = :id";
$stmt_sql_produtos_vendas_antigas = $conn->prepare($sql_produtos_vendas_antigas);
$stmt_sql_produtos_vendas_antigas->bindParam(':id', $id);
$stmt_sql_produtos_vendas_antigas->execute();
$i = 1;
while ($row = $stmt_sql_produtos_vendas_antigas->fetch(PDO::FETCH_ASSOC)){
    echo"
    <tr>
    <th scope='row'>".$i++."</th>
    <td>".$row['nome_item']."</td>
    <td>".$row['codigo_item']."</td>
    <td>".$row['qtd_item']."</td>
    <td>R$".number_format($row['valor_item'],2,',','.')."</td>
  </tr>";

}
  ?>
  <!-- ----- -->
  </tbody>
</table>


            </div>
        </div>
    </div>

</body>
</html>