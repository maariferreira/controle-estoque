<?php
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'produto');
if (!$conexao) { die("Erro: " . mysqli_connect_error()); }

// Busca e ordem
$busca = $_GET['busca'] ?? '';
$ordem = $_GET['ordem'] ?? 'id';

$sql = "SELECT * FROM produto 
        WHERE nome LIKE '%$busca%' 
        ORDER BY $ordem ASC";
$result = mysqli_query($conexao, $sql);

// Total em estoque
$total_query = mysqli_query($conexao, "SELECT SUM(total) as total_estoque FROM produto");
$total_estoque = mysqli_fetch_assoc($total_query)['total_estoque'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>📦 Estoque</title>
    <style>
        body { 
            font-family: "Comic Sans MS", cursive; 
            background:#fff0f6; 
            color:#d63384; 
            text-align:center; 
            padding:20px;
        }
        table { 
            margin:auto; 
            border-collapse: collapse; 
            width: 80%; 
            background:#ffe6f2; 
            border-radius:12px; 
            overflow:hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td { 
            border: 1px solid #ff99cc; 
            padding: 10px; 
        }
        th { 
            background:#ffb3d9; 
        }
        tr:hover { 
            background:#ffd9ec; 
        }
        .baixo-estoque { 
            background-color: #ffccd5 !important; 
            color:#b30000; 
            font-weight:bold; 
        }
        a { 
            color:#e60073; 
            font-weight:bold; 
            text-decoration:none; 
        }
        a:hover { text-decoration:underline; }
        .total { 
            margin-top:20px; 
            font-size:18px; 
            color:#e60073; 
            font-weight:bold;
        }
        .search-box {
            margin-bottom: 15px;
        }
        input[type=text] {
            border:1px solid #ff99cc;
            border-radius:8px;
            padding:5px;
        }
        input[type=submit] {
            background:#ff80bf;
            color:white;
            border:none;
            border-radius:8px;
            padding:5px 10px;
            cursor:pointer;
        }
        input[type=submit]:hover {
            background:#ff4da6;
        }
    </style>
</head>
<body>
    <h1>📦 Estoque Atual</h1>

    <form method="GET" class="search-box">
        🔍 Buscar: 
        <input type="text" name="busca" value="<?= $busca ?>">
        <input type="submit" value="Pesquisar">
    </form>

    <table>
        <tr>
            <th><a href="?ordem=nome">Nome</a></th>
            <th><a href="?ordem=preco">Preço</a></th>
            <th><a href="?ordem=quantidade">Quantidade</a></th>
            <th>Total</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $classe = ($row['quantidade'] < 5) ? "baixo-estoque" : "";
        ?>
        <tr class="<?= $classe ?>">
            <td><?= $row['nome'] ?></td>
            <td>R$ <?= number_format($row['preco'],2,",",".") ?></td>
            <td><?= $row['quantidade'] ?></td>
            <td>R$ <?= number_format($row['total'],2,",",".") ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">✏️ Editar</a> | 
                <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza?')">🗑️ Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <p class="total">💰 Valor total em estoque: <b>R$ <?= number_format($total_estoque,2,",",".") ?></b></p>

    <a href="index.html">➕ Cadastrar novo produto</a>
</body>
</html>
