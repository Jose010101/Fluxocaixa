<?php
session_start();
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}
// Verifica se já existe um carrinho
if(isset($_SESSION['carrinho'])){
    $carrinho = $_SESSION['carrinho'];
    //Se já existir um carrinho, pegará todos os itens já existentes
} else {
    $carrinho = array();
    //Se não existir um carrinho, iniciará uma lista para pegar os itens futuros
}
// Verifica se a pessoa está adicionado via código do produto
if (isset($_POST['codigo_produto'])){
    $codigo = $_POST['codigo_produto'];
    require_once("../conexao.php");
    // Consulta o banco de dados para ver se o código inserido existe
    $verificar_codigo = "SELECT * FROM estoque WHERE codigo_prod = :codigo";
    $stmt_verificar_codigo = $conn->prepare($verificar_codigo);
    $stmt_verificar_codigo->bindParam(':codigo', $codigo);
    if($stmt_verificar_codigo->execute()){
        $produto = $stmt_verificar_codigo->fetch(PDO::FETCH_ASSOC);
        if($produto){
            //Adição de produtos
            if(array_key_exists($codigo, $carrinho)){
                $carrinho[$codigo]['qtd_prod']++;
            } else {
                $carrinho[$codigo] = array(
                    'codigo' => $produto['codigo_prod'],
                    'nome' => $produto['nome_prod'],
                    'valor' => $produto['valor_prod'],
                    'img' => $produto['img_prod'],
                    'qtd_prod' => 1
                );
            }
        } else {
            //Produto não encontrado
            $erro = true;
            if($erro){
                header("Location:../paginas/compra.php?erro=1");
            }
        }
    }
    //Atualiza o carrinho
    $_SESSION['carrinho'] = $carrinho;
    header("Location:../paginas/compra.php");
}
