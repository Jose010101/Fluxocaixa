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
$id = $_GET['idusuario'];
// Se o id do funcionário for 1, não irá excluir e irá apresentar uma mensagem de erro
if($id ==1){
    $erro = true;
    if($erro){
        header("Location:../paginas/funcionarios.php?erro=1");
    }
}
// Exclui o funcionário do banco de dados e redireciona para a página de exibição dos funcionários
else{
    $sql_excluir_user = "DELETE FROM usuario WHERE id_user = :id";
    $stmt_sql_excluir_user = $conn->prepare($sql_excluir_user);
    $stmt_sql_excluir_user->bindParam(':id', $id);
    $stmt_sql_excluir_user->execute();
    header("Location:../paginas/funcionarios.php");
}


?>