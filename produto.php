<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'produto');
if (!$conexao) { die("Erro: " . mysqli_connect_error()); }

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$quantidade = $_POST['quantidade'];
$total = $preco * $quantidade;

$query = "INSERT INTO produto (nome, preco, quantidade, total) 
          VALUES ('$nome', '$preco', '$quantidade', '$total')";
$result = mysqli_query($conexao, $query);

if ($result) {
    echo "✅ Produto cadastrado! <br>";
    echo "<a href='listar.php'>📦 Ver Estoque</a>";
} else {
    echo "Erro: " . mysqli_error($conexao);
}
?>
