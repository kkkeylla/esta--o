<?php
// Função para determinar a estação do ano com base na data
function determinarEstacao($data) {
    $dia = date("d", strtotime($data));
    $mes = date("m", strtotime($data));

    if (($mes == 12 && $dia >= 21) || ($mes <= 2 && $dia <= 20)) {
        return ["Verão", "verão.jpg"];
    } elseif (($mes == 3 && $dia >= 21) || ($mes <= 5 && $dia <= 20)) {
        return ["Outono", "outono.jpg"];
    } elseif (($mes == 6 && $dia >= 21) || ($mes <= 8 && $dia <= 22)) {
        return ["Inverno", "inverno2.jpg"];
    } elseif (($mes == 9 && $dia >= 23) || ($mes <= 11 && $dia <= 20)) {
        return ["Primavera", "primavera.jpg"];
    } else {
        return ["Data inválida", null];
    }
}

// Variáveis para exibir o resultado
$estacao = null;
$imagem = null;

// Processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["data"])) {
    $data = $_POST["data"];
    list($estacao, $imagem) = determinarEstacao($data);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estações do Ano</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        img { max-width: 300px; margin-top: 20px; }
        .form-container { margin-bottom: 30px; }
    </style>
</head>
<body>
    <h1>Sistema de Estações do Ano</h1>
    <div class="form-container">
        <form method="post">
            <label for="data">Selecione uma data:</label><br>
            <input type="date" id="data" name="data" required>
            <button type="submit">Ver Estação</button>
        </form>
    </div>

    <?php if ($estacao): ?>
        <h2>Resultado</h2>
        <p>A estação do ano é: <strong><?= htmlspecialchars($estacao); ?></strong></p>
        <?php if ($imagem): ?>
            <img src="imagens/<?= htmlspecialchars($imagem); ?>" alt="<?= htmlspecialchars($estacao); ?>">
        <?php else: ?>
            <p>Não foi possível determinar a estação.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>