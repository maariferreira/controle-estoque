<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'produto');

$id = $_POST['id'];
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];
$total = $preco * $quantidade;

$query = "UPDATE produto SET nome='$nome', preco='$preco', quantidade='$quantidade', total='$total' WHERE id=$id";
mysqli_query($conexao, $query);

header("Location: listar.php");
?>
