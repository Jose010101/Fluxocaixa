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
    <title>Funcionários</title>
</head>
<body>
    <div class="container">
        <center>
        <a href="cadastrofuncionariopage.php">Cadastrar funcionário</a>
        <br>
    <a href="estoque.php"> Estoque </a>
    <br>
    <a href="paginaadm.php">Início</a>
    <br>
    <a href="transacoes.php"> Transações </a>
    <br>
    <a href='../funcoes/loggoutcode.php'>Sair</a>
    </center>
        <h1 class="text-center"> Funcionários registrados </h1>
        <div class="row">
            <div class="col-12">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Função</th>
      <th scope="col">Codigo</th>
      <th scope="col">Senha</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <!-- Exibe todos os funcionários, com exceção do primeiro funcionário criado, já que ele é o primeiro administrador -->
  <?php
  include "../conexao.php";
    $sql_user = "SELECT * FROM usuario WHERE id_user != 1 ORDER BY tipo_user";
    $stmt_sql_user = $conn->prepare($sql_user);
    $stmt_sql_user->execute();
    $i =0;
    while($row=$stmt_sql_user->fetch(PDO::FETCH_ASSOC)){
        $i++;
        $id = $row['id_user'];
        $nome = $row['nome_user'];
        $tipo = $row['tipo_user'];
        $codigo = $row['codigo_acesso'];
        $senha = $row['senha_user'];
        echo "<tr>
        <th scope='row'>".$i."
        <td>".$nome."</td>
        <td>".$tipo."</td>
        <td>".$codigo."</td>
        <td>".$senha."</td>
        <td><a href='editarfuncionario.php?idusuario=$row[id_user]'><input type='Button' value='Editar'> </a>";
        if(isset($_GET['erro'])&& $_GET['erro']==1){
          echo "Você não pode excluir este funcionário!";
        }
        echo "<a href='../funcoes/excluirfuncionario.php?idusuario=$row[id_user]'><input type='Button' value='Excluir'> </a></td>";

        
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