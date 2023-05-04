<?php
session_start();
//  Verifica se o funcionário está logado
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
<html>
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/transacoes.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js" integrity="sha512-hue5za1+fsxjvA8MhS4ZIYkZ/sDoHBRvK8Q4Wf1RHYAReIrIhPvF74XtWIlSykC3qFN3PH7lzf8KAgWV7sE3Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Transações</title>


   <!-- Seleção dos lucros e exibição de cada mês/anual -->
<?php
 date_default_timezone_set('America/Sao_Paulo');
 $ano_atual = date('Y');

// Janeiro
$sql_janeiro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 1 AND YEAR(data_venda) = :ano";
$stmt_sql_janeiro = $conn->prepare($sql_janeiro);
$stmt_sql_janeiro->bindParam(':ano', $ano_atual);
$stmt_sql_janeiro->execute();
$row = $stmt_sql_janeiro->fetch(PDO::FETCH_ASSOC);
$lucrojaneiro = $row['total_vendas'];

// Fevereiro
$sql_fevereiro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 2 AND YEAR(data_venda) = :ano";
$stmt_sql_fevereiro = $conn->prepare($sql_fevereiro);
$stmt_sql_fevereiro->bindParam(':ano', $ano_atual);
$stmt_sql_fevereiro->execute();
$row = $stmt_sql_fevereiro->fetch(PDO::FETCH_ASSOC);
$lucrofevereiro = $row['total_vendas'];

// Março
$sql_marco = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 3 AND YEAR(data_venda) = :ano";
$stmt_sql_marco = $conn->prepare($sql_marco);
$stmt_sql_marco->bindParam(':ano', $ano_atual);
$stmt_sql_marco->execute();
$row = $stmt_sql_marco->fetch(PDO::FETCH_ASSOC);
$lucromarco = $row['total_vendas'];


// Abril
$sql_abril = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 4 AND YEAR(data_venda) = :ano";
$stmt_sql_abril = $conn->prepare($sql_abril);
$stmt_sql_abril->bindParam(':ano', $ano_atual);
$stmt_sql_abril->execute();
$row = $stmt_sql_abril->fetch(PDO::FETCH_ASSOC);
$lucroabril = $row['total_vendas'];

// Maio
$sql_maio = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 5 AND YEAR(data_venda) = :ano";
$stmt_sql_maio = $conn->prepare($sql_maio);
$stmt_sql_maio->bindParam(':ano', $ano_atual);
$stmt_sql_maio->execute();
$row = $stmt_sql_maio->fetch(PDO::FETCH_ASSOC);
$lucromaio = $row['total_vendas'];

// Junho
$sql_junho = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 6 AND YEAR(data_venda) = :ano";
$stmt_sql_junho = $conn->prepare($sql_junho);
$stmt_sql_junho->bindParam(':ano', $ano_atual);
$stmt_sql_junho->execute();
$row = $stmt_sql_junho->fetch(PDO::FETCH_ASSOC);
$lucrojunho = $row['total_vendas'];

// Julho
$sql_julho = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 7 AND YEAR(data_venda) = :ano";
$stmt_sql_julho = $conn->prepare($sql_julho);
$stmt_sql_julho->bindParam(':ano', $ano_atual);
$stmt_sql_julho->execute();
$row = $stmt_sql_julho->fetch(PDO::FETCH_ASSOC);
$lucrojulho = $row['total_vendas'];

// Agosto
$sql_agosto = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 8 AND YEAR(data_venda) = :ano";
$stmt_sql_agosto = $conn->prepare($sql_agosto);
$stmt_sql_agosto->bindParam(':ano', $ano_atual);
$stmt_sql_agosto->execute();
$row = $stmt_sql_agosto->fetch(PDO::FETCH_ASSOC);
$lucroagosto = $row['total_vendas'];

// Setembro
$sql_setembro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 9 AND YEAR(data_venda) = :ano";
$stmt_sql_setembro = $conn->prepare($sql_setembro);
$stmt_sql_setembro->bindParam(':ano', $ano_atual);
$stmt_sql_setembro->execute();
$row = $stmt_sql_setembro->fetch(PDO::FETCH_ASSOC);
$lucrosetembro = $row['total_vendas'];

// Outubro
$sql_outubro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 10 AND YEAR(data_venda) = :ano";
$stmt_sql_outubro = $conn->prepare($sql_outubro);
$stmt_sql_outubro->bindParam(':ano', $ano_atual);
$stmt_sql_outubro->execute();
$row = $stmt_sql_outubro->fetch(PDO::FETCH_ASSOC);
$lucrooutubro = $row['total_vendas'];

// Novembro
$sql_novembro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 11 AND YEAR(data_venda) = :ano";
$stmt_sql_novembro = $conn->prepare($sql_novembro);
$stmt_sql_novembro->bindParam(':ano', $ano_atual);
$stmt_sql_novembro->execute();
$row = $stmt_sql_novembro->fetch(PDO::FETCH_ASSOC);
$lucronovembro = $row['total_vendas'];

// Dezembro
$sql_dezembro = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE MONTH(data_venda) = 12 AND YEAR(data_venda) = :ano";
$stmt_sql_dezembro = $conn->prepare($sql_dezembro);
$stmt_sql_dezembro->bindParam(':ano', $ano_atual);
$stmt_sql_dezembro->execute();
$row = $stmt_sql_dezembro->fetch(PDO::FETCH_ASSOC);
$lucrodezembro = $row['total_vendas'];

//Anual
$sql_anual = "SELECT SUM(valor_venda) AS total_vendas FROM venda WHERE YEAR(data_venda) = :ano";
$stmt_sql_anual = $conn->prepare($sql_anual);
$stmt_sql_anual->bindParam(':ano', $ano_atual);
$stmt_sql_anual->execute();
$row = $stmt_sql_anual->fetch(PDO::FETCH_ASSOC);
$lucroanual = $row['total_vendas'];
?>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar'], 'language': 'pt'});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['Lucro anual (<?php echo $ano_atual ?>)', 'Lucro(R$)'],
          ['Jan', <?php if($lucrojaneiro!=0){
            echo (float)$lucrojaneiro;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Fev', <?php if($lucrofevereiro!=0){
            echo (float)$lucrofevereiro;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Mar', <?php if($lucromarco!=0){
            echo (float)$lucromarco;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Abr', <?php if($lucroabril!=0){
            echo (float)$lucroabril;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Mai', <?php if($lucromaio!=0){
            echo (float)$lucromaio;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Jun', <?php if($lucrojunho!=0){
            echo (float)$lucrojunho;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Jul', <?php if($lucrojulho!=0){
            echo (float)$lucrojulho;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Ago', <?php if($lucroagosto!=0){
            echo (float)$lucroagosto;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Set', <?php if($lucrosetembro!=0){
            echo (float)$lucrosetembro;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Out', <?php if($lucrooutubro!=0){
            echo (float)$lucrooutubro;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Nov', <?php if($lucronovembro!=0){
            echo (float)$lucronovembro;
          }
            else{
              echo 0; 
            }
            ?>, ],
          ['Dez', <?php if($lucrodezembro!=0){
            echo (float)$lucrodezembro;
          }
            else{
              echo 0; 
            }
            ?>, ],
            ['Ano', <?php if($lucroanual!=0){
            echo (float)$lucroanual;
          }
            else{
              echo 0; 
            }
            ?>, ]
        ]);
        var options = {
  chart: {
    title: '',
    subtitle: '',
  },
  vAxis: {
  format: 'R$ #,##0.00',
  decimalSymbol: ',',
  groupSeparator: '.'
}
};

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<!-- ----- -->
  </head>
  <body>

  <div class="container " id="graficodiario">
      <div class="row">
        <h1 class="text-center">Gráfico de lucros</h1>
        <div class="col-12">
        <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
        </div>
      </div>
</div>

  </body>
</html>
