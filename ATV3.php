<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contador de Números</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <h1>Contador de Números</h1>

    <form method="post">
        <?php for ($j = 1; $j <= 10; $j++): ?>
            <label for="numero<?= $j ?>">Digite o número <?= $j ?>:</label>
            <input type="number" id="numero<?= $j ?>" name="numeros[]" required>
        <?php endfor; ?>

        <input type="submit" value="Contar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function contarValores($valores) {
            $contagem = [
                'negativos' => 0,
                'positivos' => 0,
                'pares' => 0,
                'impares' => 0
            ];

            foreach ($valores as $valor) {
                if ($valor < 0) {
                    $contagem['negativos']++;
                } elseif ($valor > 0) {
                    $contagem['positivos']++;
                }

                if ($valor % 2 === 0) {
                    $contagem['pares']++;
                } else {
                    $contagem['impares']++;
                }
            }

            return $contagem;
        }

        $numeros = array_map('floatval', $_POST['numeros']);
        $resultadoContagem = contarValores($numeros);

        echo "<h2>Resultados:</h2>";
        echo "<p>Total de números negativos: {$resultadoContagem['negativos']}</p>";
        echo "<p>Total de números positivos: {$resultadoContagem['positivos']}</p>";
        echo "<p>Total de números pares: {$resultadoContagem['pares']}</p>";
        echo "<p>Total de números ímpares: {$resultadoContagem['impares']}</p>";
    }
    ?>
</body>
</html>
