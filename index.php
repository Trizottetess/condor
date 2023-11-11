<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <form class="cadastro_produto" action="processar_prod.php" enctype="multipart/form-data" method="post">

    <input name="nome" type="text" placeholder="Nome do Produto">

    <input name="marca" type="text" placeholder="Marca do Produto">

    <label for="categoria"></label>
    <input list="categorias" name="categoria" placeholder="Escolha a categoria">
    <datalist id="categorias">
        <option value="Comidas">
        <option value="Higiene">
        <option value="Limpeza">
        <option value="Bebidas">
    </datalist>

    <input type="text" placeholder="Em estoque" name="estoque">
    
    <input name="quantidade" type="number" placeholder="Quantidade de Produto">

    <input type="file" name="arquivo">

    <input type="submit" name="grava">

    </form>
    
</body>
</html>

<?php

include ("conn.php")

?>