<?php
session_start();
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
include_once("../conexao.php");
if(isset($_SESSION['carrinho'])){
    $carrinho = $_SESSION['carrinho'];
    //Se já existir um carrinho, pegará todos os itens já existentes
} else {
    $carrinho = array();
    //Se não existir um carrinho, iniciará uma lista para pegar os itens futuros
}
$codigo = $_GET['codigoitem'];
// Se existir um produto que corresponde ao código, irá remover 1 unidade deste item e redirecionar para a página de compras
if(array_key_exists($codigo, $carrinho)){
    $carrinho[$codigo]['qtd_prod']--;
    if($carrinho[$codigo]['qtd_prod']<1){
     unset($carrinho[$codigo]);
    }
    
}
$_SESSION['carrinho'] = $carrinho;
header("Location:../paginas/compra.php");
?>