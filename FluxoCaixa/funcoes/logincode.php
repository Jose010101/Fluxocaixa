<?php
include_once("../conexao.php");

$codigo = $_POST['codigo_user'];
$senha = $_POST['senha_user'];

// Verifica se todos os campos foram preenchidos
if(isset($_POST['codigo_user']) && isset($_POST['senha_user'])){
    // Verifica se os campos preenchidos correspondem à algum funcionário na base de dados
    $sql_verificar = "SELECT * from usuario WHERE codigo_acesso = :codigo AND senha_user = :senha";
    $stmt_sql_verificar = $conn->prepare($sql_verificar);
    $stmt_sql_verificar->bindParam(':codigo', $codigo);
    $stmt_sql_verificar->bindParam(':senha', $senha);
    $stmt_sql_verificar->execute();
    $row = $stmt_sql_verificar->fetch(PDO::FETCH_ASSOC);
    // Se corresponder, irá redirecionar para a página que corresponde ao seu tipo de usuário
    if ($stmt_sql_verificar->rowCount()>=1){
        session_start();
        $_SESSION['id'] = $row['id_user'];
        $_SESSION['nome'] = $row['nome_user'];
        $_SESSION['tipousuario'] = $row['tipo_user'];
        $_SESSION['logged'] = true;
    
        if ($_SESSION['tipousuario'] == "Administrador"){
            header("Location:../paginas/paginaadm.php");
        }
        else{
            header("Location:../paginas/paginavendedor.php");
        }
    }
    // Se não corresponder, irá redirecionar para a página de login com uma mensagem de rro
    else{
        $erro = true;
        if($erro == true){
            header("Location:../index.php?erro=1");
        }
    }
}
// Se não atender à todos os requisitos, irá redirecionar para a página de login
else{
    header("Location:../index.php?");
}


?>