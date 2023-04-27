<?php
session_start();
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
  header("Location:../index.php");
}
$nome = $_SESSION['nome'];

// Remove os itens do carrinho
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
    <link rel="stylesheet" href="../css/todasvendas.css">
    <title>Todas as vendas</title>
</head>
    <div class="container">
        <h1 class="text-center">Todas as vendas</h1>
        <div class="row">
            <div class="col-12">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Data</th>
      <th scope="col">Hora</th>
      <th scope="col">Produtos</th>
      <th scope="col">Valor da venda</th>
    </tr>
  </thead>
  <tbody>
    <!-- Exibe todas as vendas registradas -->
  <?php
  include "../conexao.php";
    $sql_vendas_antigas = "SELECT * FROM venda  ORDER BY id_venda DESC";
    $stmt_sql_vendas_antigas = $conn->prepare($sql_vendas_antigas);
    $stmt_sql_vendas_antigas->execute();
    while($row=$stmt_sql_vendas_antigas->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id_venda'];
        $total = $row['valor_venda'];
        $data = $row['data_venda'];
        $data_local = DateTime::createFromFormat('Y-m-d', $data);
        $data_formatada = $data_local->format('d-m-Y');
        $hora = $row['hora_venda'];
        echo "<tr>
        <th scope='row'>".$id."
        <td>".$data_formatada."</td>
        <td>".$hora."</td>
        <td><a href='Visualizarprodutoscompra.php?idvenda=$row[id_venda]' class='btn btn-dark'>Visualizar</a></td>
        <td>R$".number_format($total,2,',','.')."</td></tr>";

        
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
