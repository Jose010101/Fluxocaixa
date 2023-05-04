<?php
session_start();
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
// Verifica se exista um carrinho
if (isset($_SESSION['carrinho'])) {
    // Caso exista, a variável $carrinho irá puxar todos os itens que estão presentes no carrinho
    $carrinho = $_SESSION['carrinho'];
    // A variável $total_itens irá contar a quantia de itens presentes no carrinho
    $total_itens = count($_SESSION['carrinho']);
} else {
    // Caso não exista itens no carrinho, irá iniciar uma nova lista
    $carrinho = array();
}
// Calcular as compras;
$total_item = 0;
$total_compra = 0;
foreach($carrinho as $codigo => $item){
    //Para cada código presente no carrinho eu tenho um item diferente
    
    $total_item = (isset($item['valor']) ? $item['valor'] : 0)
    * (isset($item['qtd_prod']) ? $item['qtd_prod'] : 1);
    $total_compra += $total_item;
}
$total_itens = 0;
foreach ($carrinho as $produto) {
    $total_itens += $produto['qtd_prod'];
}
$_SESSION['Valor_total'] = $total_compra;
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
    <link rel="stylesheet" href="../css/compra.css">
    <title>Tela de Compra</title>

</head>


<body>
    <form action="../funcoes/adicionar_carrinho.php" method="POST">
    <input type="text" name="codigo_produto" placeholder="Código de barras">
    <!-- Mensagem de erro -->
    <?php 
        if(isset($_GET['erro']) && $_GET['erro']==1){
            echo "Produto não encontrado no estoque";
        }
    ?>
    <input type="submit">
    </form>
    <h1 class="text-center">Carrinho de compras</h1>
   <div class="container">
    <div class="row">
        <div class="col-12 col-lg-6 dados_compra">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item</th>
      <th scope="col">Qtd</th>
      <th scope="col">Unitário</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <!-- Exibe todos os produtos que foram adicionados ao carrinho -->
  <?php 
  $i = 0;
  foreach($carrinho as $codigo=> $item){
        $i++;
            if($item['qtd_prod']>0){
                $img = $item['img'];
                echo "<tr>
                <td>".$i."</td>
                <td>".$item['nome']."</td>
                <td>".$item['qtd_prod']."</td>
                <td>R$".number_format($item['valor'],2,',','.')."</td>
                <td><a href='../funcoes/remover_carrinho.php?codigoitem=$item[codigo]' class='btn btn-dark'>-</a></td>";
                
               
        

            }
        }?>
    <!-- ----- -->
  </tbody>
</table>
<!-- Exibe o valor total da compra -->
<?php
    echo "<h5 class='text-center'>Total de itens: $total_itens</h5>
    <h5 class='text-center'>Valor total R$: ".number_format($total_compra,2,',','.')."</h5>";
    ?>
<!-- ----- -->
    <form action="../funcoes/finalizarcompra.php" method="POST">
    <h1 class="text-center finalizarcompra"><input type="submit" value="Finalizar compra" class="btn btn-dark "></h1>
    </form>
        </div>
    </div>
   </div> 
</body>
</html>