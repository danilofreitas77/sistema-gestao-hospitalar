<?php
include 'conexao.php';

$sql = "
SELECT pacientes.id_paciente, pacientes.nome, exames.hemoglobina, exames.hematocrito, exames.leucocitos, exames.glicose, exames.colesterol, exames.data_exame
FROM pacientes
JOIN exames ON pacientes.id_paciente = exames.id_paciente
";
$result = $conn->query($sql);

function verificarSituacao($valor, $tipo) {
    $situacoes = [
        'hemoglobina' => [12, 16],
        'hematocrito' => [36, 50],
        'leucocitos' => [4500, 11000],
        'glicose' => [70, 99],
        'colesterol' => [150, 200],
    ];

    if (!array_key_exists($tipo, $situacoes)) {
        return ["Inválido", "neutro"];
    }

    list($min, $max) = $situacoes[$tipo];
    if ($valor < $min) {
        return ["Baixo", "vermelho"];
    } elseif ($valor > $max) {
        return ["Alto", "vermelho"];
    } else {
        return ["Normal", "normal"];
    }
}

function diagnosticoPreliminar($dados) {
    $alertas = [];

    if ($dados['glicose'] > 140) {
        $alertas[] = "Alto risco de diabetes. Recomenda-se consulta com um endocrinologista.";
    }

    if ($dados['colesterol'] > 240) {
        $alertas[] = "Colesterol muito alto. Pode ser necessário iniciar tratamento com estatinas.";
    }

    if ($dados['leucocitos'] > 15000) {
        $alertas[] = "Alerta de possível infecção. Investigue sintomas adicionais.";
    }

    if ($dados['hemoglobina'] < 10 && $dados['hematocrito'] < 30) {
        $alertas[] = "Possível anemia severa. Consulte um hematologista.";
    }

    return $alertas;
}

function calcularPrioridade($dados) {
    $prioridade = 0;

    if ($dados['glicose'] > 140) $prioridade += 3;
    if ($dados['colesterol'] > 240) $prioridade += 3;
    if ($dados['leucocitos'] > 15000) $prioridade += 2;
    if ($dados['hemoglobina'] < 10) $prioridade += 2;
    if ($dados['hematocrito'] < 30) $prioridade += 1;

    return $prioridade;
}

$pacientes = [];
while ($paciente = $result->fetch_object()) {
    $dadosPaciente = [
        'hemoglobina' => $paciente->hemoglobina,
        'hematocrito' => $paciente->hematocrito,
        'leucocitos' => $paciente->leucocitos,
        'glicose' => $paciente->glicose,
        'colesterol' => $paciente->colesterol,
    ];
    $paciente->prioridade = calcularPrioridade($dadosPaciente);
    $pacientes[] = $paciente;
}

usort($pacientes, function($a, $b) {
    return $b->prioridade - $a->prioridade;
});
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listagem de Pacientes</title>
</head>
<body>
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <h1 class="text-center">Listagem de Pacientes e Taxas</h1>
        </div>
    </header>

    <main class="container">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nome do Paciente</th>
                    <th>Hemoglobina</th>
                    <th>Situação Hemoglobina</th>
                    <th>Hematócrito</th>
                    <th>Situação Hematócrito</th>
                    <th>Leucócitos</th>
                    <th>Situação Leucócitos</th>
                    <th>Glicose</th>
                    <th>Situação Glicose</th>
                    <th>Colesterol</th>
                    <th>Situação Colesterol</th>
                    <th>Data do Exame</th>
                </tr>
            </thead>
            <tbody>
    <?php if (!empty($pacientes)): ?>
        <?php foreach ($pacientes as $paciente): ?>
            <?php
                list($situacaoHemoglobina, $classeHemoglobina) = verificarSituacao($paciente->hemoglobina, 'hemoglobina');
                list($situacaoHematocrito, $classeHematocrito) = verificarSituacao($paciente->hematocrito, 'hematocrito');
                list($situacaoLeucocitos, $classeLeucocitos) = verificarSituacao($paciente->leucocitos, 'leucocitos');
                list($situacaoGlicose, $classeGlicose) = verificarSituacao($paciente->glicose, 'glicose');
                list($situacaoColesterol, $classeColesterol) = verificarSituacao($paciente->colesterol, 'colesterol');
                $alertas = diagnosticoPreliminar([
                    'glicose' => $paciente->glicose,
                    'colesterol' => $paciente->colesterol,
                    'leucocitos' => $paciente->leucocitos,
                    'hemoglobina' => $paciente->hemoglobina,
                    'hematocrito' => $paciente->hematocrito,
                ]);
            ?>
            <tr class="<?= $paciente->prioridade > 5 ? 'table-danger' : '' ?>">
                <td><?= $paciente->id_paciente ?></td>
                <td><?= $paciente->nome ?></td>
                <td><?= $paciente->hemoglobina ?></td>
                <td class="<?= $classeHemoglobina ?>"><?= $situacaoHemoglobina ?></td>
                <td><?= $paciente->hematocrito ?></td>
                <td class="<?= $classeHematocrito ?>"><?= $situacaoHematocrito ?></td>
                <td><?= $paciente->leucocitos ?></td>
                <td class="<?= $classeLeucocitos ?>"><?= $situacaoLeucocitos ?></td>
                <td><?= $paciente->glicose ?></td>
                <td class="<?= $classeGlicose ?>"><?= $situacaoGlicose ?></td>
                <td><?= $paciente->colesterol ?></td>
                <td class="<?= $classeColesterol ?>"><?= $situacaoColesterol ?></td>
                <td><?= $paciente->data_exame ?></td>
            </tr>
            <?php if (!empty($alertas)): ?>
                <tr>
                    <td colspan="13" class="text-start text-danger">
                        <strong>Alertas e Recomendações:</strong>
                        <ul>
                            <?php foreach ($alertas as $alerta): ?>
                                <li><?= $alerta ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="13" class="text-center">Nenhum paciente encontrado</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </main>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
        </div>

    <footer class="text-center py-3 mt-4 border-top">
        <p class="m-0">DBCEL Softwares &copy; 2024</p>
    </footer>

    <style>
        .normal { color: green !important; }
        .vermelho { color: red !important; }
        .neutro { color: black !important; }
        .table-danger { background-color: #f8d7da !important; color: #721c24 !important; }
    </style>
</body>
</html>
