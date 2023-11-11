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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
</head>
<body>

<table border="1">
    <tr>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Marca</th>
        <th>Quantidade</th>
        <th>Categoria</th>
    </tr>

    <?php
    include("conn.php");

    // Realize uma consulta para obter os dados da tabela
    $exib = $conn->prepare('SELECT * FROM `produtos`');
    $exib->execute();

    if ($exib->rowCount() == 0) {
        echo "<tr><td colspan='6'>Não há registros!</td></tr>";
    } else {
        while ($row = $exib->fetch()) {
            echo "<tr>";
            // Coluna da Imagem
            echo "<td><img src='" . $row['img_prod'] . "' width='100px' ></td>";
            // Colunas restantes
            echo "<td>" . $row['nome_prod'] . "</td>";
            echo "<td>" . $row['marca_prod'] . "</td>";
            echo "<td>" . $row['quantidade_prod'] . "</td>";
            echo "<td>" . $row['categoria_prod'] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

</body>
</html>