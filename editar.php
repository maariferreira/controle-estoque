<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'produto');
$id = $_GET['id'];
$result = mysqli_query($conexao, "SELECT * FROM produto WHERE id=$id");
$produto = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>✏️ Editar</title></head>
<body>
    <h1>✏️ Editar Produto</h1>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
        Nome: <input type="text" name="nome" value="<?= $produto['nome'] ?>"><br><br>
        Preço: <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>"><br><br>
        Quantidade: <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>"><br><br>
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
