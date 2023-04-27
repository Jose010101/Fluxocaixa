<?php
include_once('../conexao.php');
session_start();
// Verifica se o funcionário está logado e destrói a sessão
if($_SESSION['logged']== true){
    session_destroy();
    header("Location:../index.php");
  }
// Se o funcionário não estiver logado, irá redirecionar para a página de login
else{
  header("Location:../index.php");
}
?>