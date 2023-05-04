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
$id = $_POST['idproduto'];
// Verifica se todos os campos foram preenchidos
if (isset($_POST['submit']) && isset($_POST['novoNome']) && isset($_POST['novoQtd']) && isset($_POST['novoValor'])){
    include_once("../conexao.php");
    $novoNome = $_POST['novoNome'];
    $novoQtd = $_POST['novoQtd'];
    $novoValor = $_POST['novoValor'];
        $sql_update = "UPDATE estoque SET nome_prod = :nome ,qtd_prod =:qtd ,valor_prod = :valor WHERE id_prod = :id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':id', $id);
        $stmt_update->bindParam(':nome', $novoNome);
        $stmt_update->bindParam(':qtd', $novoQtd);
        $stmt_update->bindParam(':valor', $novoValor);
        $stmt_update->execute();
        
        header("Location:../paginas/estoque.php");
}
// Se não atender à todos os requisitos, irá redirecionar para a página de edição do produto
else{
    header("Location:../paginas/editarpage.php?produtoid=$id");
}

?>