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
    <title>Editar funcionário</title>
</head>
<body>
  <!-- Exibe os dados refentes ao funcionário que será editado -->
<?php
include "../conexao.php";
    $idusuario = $_GET['idusuario'];

    $sql_usuario = "SELECT * FROM usuario WHERE id_user = :id";
    $stmt_sql_usuario = $conn->prepare($sql_usuario);
    $stmt_sql_usuario->bindParam(':id', $idusuario);
    $stmt_sql_usuario->execute();
    $row = $stmt_sql_usuario->fetch(PDO::FETCH_ASSOC);
    $id = $row['id_user'];
        echo "Nome do usuário: ".$row['nome_user']."";
        echo "<br>";
        echo "Tipo do usuário: ".$row['tipo_user']."";
        echo "<br>";
        echo "Código do usuário: ".$row['codigo_acesso']."";
        echo "<br>";
        echo "Senha do usuário: ".$row['senha_user']."";
        echo "<hr>";
    
    ?>
    <!-- ----- -->

    <!-- Formulário para atualização de dados do funcionário -->
    <form action="../funcoes/editarfuncionariocode.php" method="POST">
      <input type="text" placeholder="Nome do funcionário" name="nomeusuario">
      <br>
      <input type="text" placeholder="Nova senha" name="novasenha">
      <?php
        echo "<input type='text' name='iduser' hidden value = '$id'>"
         ?>
      <br>
      <input type="text" placeholder= "Confirme a nova senha" name="confirmsenha">
      <br>
      <?php
      // Exibição de erro para senhas difentes
      if(isset($_GET['erro']) && $_GET['erro']==1){
        echo "<p>Por favor, insira senhas iguais </p>";
      }
      ?>
      <input type="submit" name="submit" value="Atualizar">

    </form>
    <!-- ----- -->
</body>
</html>