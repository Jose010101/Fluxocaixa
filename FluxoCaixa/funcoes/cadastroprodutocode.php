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
// Verifica se todos os campos foram preenchidos
if(isset($_POST['submit']) && isset($_POST['nomeProduto']) && isset($_POST['qtdProduto']) && isset($_POST['valorProduto']) && isset($_POST['codigoProduto'])){
    include_once("../conexao.php");
    $nome = $_POST['nomeProduto'];
    $qtd = $_POST['qtdProduto'];
    $valor= $_POST['valorProduto'];
    $codigo = $_POST['codigoProduto'];
    // Seleciona todos os produtos do banco de dados para verificar se o código já existe
    $sql_verificar = "SELECT * FROM estoque WHERE codigo_prod = :codigo";
    $stmt_verificar = $conn->prepare($sql_verificar);
    $stmt_verificar->bindParam(':codigo', $codigo);
    $stmt_verificar->execute();
    $row = $stmt_verificar->fetch(PDO::FETCH_ASSOC); 
    // Se o código já existir, levará para a página de edição do produto referente ao código
    if($stmt_verificar->rowCount()>=1){
        header("Location:../paginas/Editarpage.php?produtoid=$row[id_prod]");
    }
    // Se o código não existir, irá cadastrar o produto
    else{
        $ext = strtolower(substr($_FILES['imgProduto']['name'], -4));
        $crip = md5(time()).$ext;
        $direcionar = "../DisplayProduto/";
        move_uploaded_file($_FILES['imgProduto']['tmp_name'], $direcionar.$crip);
        $cadastro = "INSERT INTO estoque(nome_prod,qtd_prod,valor_prod, codigo_prod, img_prod) VALUES (:nome, :qtd, :valor, :codigo, :img)";
        $stmt_cadastro = $conn->prepare($cadastro);
        $stmt_cadastro->bindParam(':nome', $nome);
        $stmt_cadastro->bindParam(':qtd', $qtd);
        $stmt_cadastro->bindParam(':valor', $valor);
        $stmt_cadastro->bindParam(':codigo', $codigo);
        $stmt_cadastro->bindParam(':img', $crip);
        $stmt_cadastro->execute();
        header("Location:../paginas/estoque.php");
    }

}
// Se não atender à todos os requisitos, irá redirecionar para a página de cadastro de produto 
else{
    header("Location:../paginas/cadastroproduto.php")
}

?>