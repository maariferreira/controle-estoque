<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'produto');
$id = $_GET['id'];
mysqli_query($conexao, "DELETE FROM produto WHERE id=$id");
header("Location: listar.php");
?>
