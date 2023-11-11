<?php
include("conn.php");

if (isset($_POST['grava'])) {
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];

    $diretorio = 'arquivos/';
    $nome_arquivo = $_FILES['arquivo']['name'];
    $caminho_arquivo = $diretorio . $nome_arquivo;

    // Move o arquivo para o diretório 'arquivos'
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
        // Insere os dados no banco de dados
        $gravar = $conn->prepare("INSERT INTO produtos (nome_prod, marca_prod, quantidade_prod, categoria_prod, img_prod) VALUES (:pnome, :pmarca, :pquantidade, :pcategoria, :pcaminho)");

        $gravar->bindValue(":pnome", $nome);
        $gravar->bindValue(":pmarca", $marca);
        $gravar->bindValue(":pquantidade", $quantidade);
        $gravar->bindValue(":pcategoria", $categoria);
        $gravar->bindValue(":pcaminho", $caminho_arquivo);

        if ($gravar->execute()) {
            echo "Registro inserido com sucesso!";
            header('Location: produtos.php'); // Redireciona para a página de produtos
            exit();
        } else {
            echo "Erro ao gravar registro: " . $gravar->error;
            exit();
        }
    } else {
        echo "Falha no upload do arquivo.";
        exit();
    }
}
?>
<?php
        $nome_final = (time()) . ".$extensao_arquivo";
        


    // Insere os dados no banco de dados
    $img = $diretorio . $nome_final;

    $gravar = $conn->prepare("INSERT INTO produtos (nome_prod, marca_prod, quantidade_prod, estoque_prod, categoria_prod, img_prod) VALUES (:pnome, :pmarca, :pquantidade, :pestoque, :pcategoria, :pimg)");

    $gravar->bindValue(":pnome", $nome);
    $gravar->bindValue(":pmarca", $marca); 
    $gravar->bindValue(":pquantidade", $quantidade);
    $gravar->bindValue(":pestoque", $estoque);
    $gravar->bindValue(":pimg", $img);
    $gravar->bindValue(":pcategoria", $categoria);

    if ($gravar->execute()) {
        header('Location: produtos.php');
        exit();
    } else {
        echo "Erro ao gravar registro: " . $gravar->error;
        var_dump($gravar->execute()); // Adicione esta linha para verificar o resultado da execução
        exit();
    }

?>