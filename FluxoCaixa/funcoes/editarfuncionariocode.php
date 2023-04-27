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

// Verificar se todos os dados foram preenchidos
if (isset($_POST['submit']) && isset($_POST['nomeusuario']) && isset($_POST['novasenha']) && isset($_POST['confirmsenha'])){
    $nome = $_POST['nomeusuario'];
    $senha = $_POST['novasenha'];
    $confirmsenha = $_POST['confirmsenha'];
    $id = $_POST['iduser'];
    // Caso as senhas não coincidam, irá redirecionar para a página de edição do funcionário
    if($confirmsenha != $senha){
        $erro = true;
        if($erro){
            header("Location:../paginas/editarfuncionario.php?idusuario=$id&erro=1");
        }
    //  Caso esteja tudo certo, irá atualizar os dados do funcionário e redirecionar para a página de exibição dos funcionários
    }else{
        include_once("../conexao.php");
        $sql_atualizar_funcionario = "UPDATE usuario SET nome_user = :nome, senha_user = :senha WHERE id_user= :id";
        $stmt_sql_atualizar_funcionario = $conn->prepare($sql_atualizar_funcionario);
        $stmt_sql_atualizar_funcionario->bindParam(':nome', $nome);
        $stmt_sql_atualizar_funcionario->bindParam(':senha', $senha);
        $stmt_sql_atualizar_funcionario->bindParam(':id', $id);
        $stmt_sql_atualizar_funcionario->execute();
        header("Location:../paginas/funcionarios.php");
    }
}
// Se não atender à todos os requisitos, irá redirecionar para a página de edição do funcionário
else{
  header("Location:../paginas/editarfuncionario.php?idusuario=$id");
}
?>