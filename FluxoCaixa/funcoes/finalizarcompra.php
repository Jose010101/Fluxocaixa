<?php
session_start();
// Verifica se o funcionário está logado
if($_SESSION['logged']!= true){
    header("Location:../index.php");
}

// Se o carrinho estiver vazio, irá redirecionar o funcionário para a página que corresponde ao seu tipo de usuário
if(empty($_SESSION['carrinho'])){
    if($_SESSION['tipousuario'] != "Administrador"){
        header("Location:../paginas/paginavendedor.php");
    }
    else{
        header("Location:../paginas/paginaadm.php");
    }
}
// Se houver produtos no carrinho, irá cadastrar a venda no banco de dados
else{
    include_once("../conexao.php");
    $total = $_SESSION['Valor_total'];
    $carrinho = $_SESSION['carrinho'];
    date_default_timezone_set('America/Sao_Paulo');
    $data_local = date('Y-m-d');
    $hora_local = date('H:i:s');
    $sql_venda = "INSERT INTO venda(valor_venda, data_venda, hora_venda) VALUES (:total, :datatual, :hora)";
    $stmt_sql_venda = $conn->prepare($sql_venda);
    $stmt_sql_venda->bindParam(':total', $total);
    $stmt_sql_venda->bindParam(':datatual', $data_local);
    $stmt_sql_venda->bindParam(':hora', $hora_local);
    $stmt_sql_venda->execute();
    $id = $conn->lastInsertId();
    
    
    
    // Para cada produto no carrinho, irá inserir na tabela de itens_venda com os dados referentes à venda
    foreach($carrinho as $codigo=>$item){
        $codigo_produto = $item['codigo'];
        $nome_produto = $item['nome'];
        $valor_produto = $item['valor'];
        $qtd_produto = $item['qtd_prod'];
        $sql_inseriritem= "INSERT INTO itens_venda(codigo_item, nome_item, valor_item, qtd_item, id_venda) VALUES (:codigo, :nome_produto, :valor_produto, :qtd_produto, :id_venda)";
        $stmt_sql_inseriritem = $conn->prepare($sql_inseriritem);
        $stmt_sql_inseriritem->bindParam(':codigo', $codigo_produto);
        $stmt_sql_inseriritem->bindParam(':nome_produto', $nome_produto);
        $stmt_sql_inseriritem->bindParam(':valor_produto', $valor_produto);
        $stmt_sql_inseriritem->bindParam(':qtd_produto', $qtd_produto);
        $stmt_sql_inseriritem->bindParam(':id_venda', $id);
        $stmt_sql_inseriritem->execute();
    
    
        $qtd_produto_int = intval($qtd_produto);
        $sql_atualizarEstoque = "UPDATE estoque SET qtd_prod = qtd_prod-:qtd_produto WHERE codigo_prod = :codigo";
        $stmt_sql_atualizarEstoque= $conn->prepare($sql_atualizarEstoque);
        $stmt_sql_atualizarEstoque->bindParam(':codigo', $codigo_produto);
        $stmt_sql_atualizarEstoque->bindParam(':qtd_produto', $qtd_produto_int);
        $stmt_sql_atualizarEstoque->execute();
        
    }
    
    
    $_SESSION['carrinho'] = array();
    // Irá redirecionar o funcionário para a página que corresponde ao seu tipo de usuário
    if($_SESSION['tipousuario'] == "Administrador"){
        header("Location:../paginas/paginaadm.php");
    }else{
        header("Location:../paginas/paginavendedor.php");
    }
    
}

?>


