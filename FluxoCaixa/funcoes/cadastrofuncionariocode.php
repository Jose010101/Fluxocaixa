<?php
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
// Se o funcionário for diferente de Administrador e ele estive logado, levará para a página inicial de vendedor  
elseif($_SESSION['tipousuario']!= "Administrador"){
    header("Location:paginavendedor.php");
}
// Verifica se todos os campos foram preenchidos
if(isset($_POST['submit']) && isset($_POST['nome_user']) && isset($_POST['tipo_user']) && isset($_POST['senha_user'])){
    $nome = $_POST['nome_user'];
    $random_bytes = random_bytes(8); // gera 8 bytes aleatórios
    $random_string = base64_encode($random_bytes); // converte para base64
    $codigo = substr($random_string, 0, 5); // pega os primeiros 10 caracteres
    $tipo = $_POST['tipo_user'];
    $senha = $_POST['senha_user'];
    include_once("../conexao.php");
    $sql_verificar_usuario = "SELECT * FROM usuario WHERE codigo_acesso = :codigo";
    $stmt_verificar_usuario = $conn->prepare($sql_verificar_usuario);
    $stmt_verificar_usuario->bindParam(':codigo', $codigo);
    $stmt_verificar_usuario->execute();
    $row = $stmt_verificar_usuario->fetch(PDO::FETCH_ASSOC);
    $comprimentosenha = strlen($senha);
    if ($stmt_verificar_usuario->rowCount()>=1){
        $erro = true;
        if($erro == true){
            header("Location:../paginas/cadastrofuncionariopage.php?erro=1");
        }
    }
    // Verifica se o comprimento da senha está de acordo com o requisitado
    elseif($comprimentosenha!=5){
        $erro = true;
        if($erro == true){
            header("Location:../paginas/cadastrofuncionariopage.php?erro=2");
        }
    }
    // Se não houver erro, irá cadastrar o funcionário
    else{
        $sql_cadastrar_usuario = "INSERT INTO usuario(nome_user, tipo_user,senha_user, codigo_acesso) VALUES (:nome, :tipo, :senha, :codigo)";
        $stmt_sql_cadastrar_usuario = $conn->prepare($sql_cadastrar_usuario);
        $stmt_sql_cadastrar_usuario->bindParam(':nome', $nome);
        $stmt_sql_cadastrar_usuario->bindParam(':tipo', $tipo);
        $stmt_sql_cadastrar_usuario->bindParam(':senha', $senha);
        $stmt_sql_cadastrar_usuario->bindParam(':codigo', $codigo);
        $stmt_sql_cadastrar_usuario->execute();
        header("Location:../paginas/funcionarios.php");
    
}

}
// Se não atender à todos os requisitos, irá redirecionar para a página de cadastro de funcionário
else{
    header("Location:../paginas/cadastrofuncionariopage.php");
}


?>
