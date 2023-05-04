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



include_once("../conexao.php");
$id = $_GET['produtoid'];


// Exclui o produto do banco de dados e redireciona para a página de estoque
$sql_excluir = "DELETE FROM estoque WHERE id_prod = :id";
$stmt_sql_excluir = $conn->prepare($sql_excluir);
$stmt_sql_excluir->bindParam(':id', $id);
$stmt_sql_excluir->execute();
header("Location:../paginas/estoque.php");

?>