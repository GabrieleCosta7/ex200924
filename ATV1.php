<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Preços de Produtos</title>
</head>
<body>
    <h1>Calculadora de Preços de Produtos</h1>

    <form action="" method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="nome<?= $i ?>">Nome do Produto <?= $i ?>:</label>
            <input type="text" id="nome<?= $i ?>" name="nome[]" required><br><br>
            
            <label for="preco<?= $i ?>">Preço:</label>
            <input type="number" id="preco<?= $i ?>" name="preco[]" step="0.01" min="0" required><br><br>
        <?php endfor; ?>
        
        <input type="submit" value="Calcular">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
    function contarProdutosAbaixo50($produtos) {
            $contagem = 0;
            foreach ($produtos as $preco) {
                if ($preco < 50) {
                    $contagem++;
                }
            }
            return $contagem;
        }

        function listarProdutos50a100($produtos) {
            $nomes = [];
            foreach ($produtos as $nome => $preco) {
                if ($preco >= 50 && $preco <= 100) {
                    $nomes[] = $nome;
                }
            }
            return $nomes;
        }

        function calcularMediaAcima100($produtos) {
            $soma = 0;
            $quantidade = 0;
            foreach ($produtos as $preco) {
                if ($preco > 100) {
                    $soma += $preco;
                    $quantidade++;
                }
            }
            return $quantidade > 0 ? $soma / $quantidade : 0;
        }

        $produtos = [];
        foreach ($_POST['nome'] as $key => $nome) {
            if (!empty($nome) && is_numeric($_POST['preco'][$key])) {
                $produtos[$nome] = (float) $_POST['preco'][$key];
            }
        }

        $quantidadeAbaixo50 = contarProdutosAbaixo50($produtos);
        $nomesEntre50a100 = listarProdutos50a100($produtos);
        $mediaAcima100 = calcularMediaAcima100($produtos);

        echo "<h2>Resultados:</h2>";
        echo "<p>Quantidade de produtos abaixo de R$50,00: $quantidadeAbaixo50</p>";
        echo "<p>Produtos entre R$50,00 e R$100,00: ";
        echo !empty($nomesEntre50a100) ? implode(', ', $nomesEntre50a100) : "Nenhum produto encontrado.";
        echo "</p>";
        echo "<p>Média dos preços dos produtos acima de R$100,00: R$" . number_format($mediaAcima100, 2, ',', '.') . "</p>";
    }
    ?>
</body>
</html>
