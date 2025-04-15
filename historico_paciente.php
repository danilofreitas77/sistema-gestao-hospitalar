<?php 

include 'conexao.php';

$id = $_GET['id_paciente'];
$nome = $_GET['nome'];

$sql = "SELECT * FROM exames WHERE id_paciente = '$id'";
$sql2 = "SELECT * FROM pacientes WHERE id_paciente = '$id'";

$result2 = $conn->query($sql2);
$result = $conn->query($sql);

function verificarSituacao($valor, $tipo) {
    switch($tipo) {
        case 'hemoglobina':
            if ($valor < 12) {
                return ["Hemoglobina Baixa", "table-danger"];  
            } elseif ($valor >= 12 && $valor <= 16) {
                return ["Normal", "table-success"];  
            } else {
                return ["Hemoglobina Alta", "table-danger"];  
            }
        case 'hematocrito':
            if ($valor < 36) {
                return ["Hematócrito Baixo", "table-danger"];  
            } elseif ($valor >= 36 && $valor <= 50) {
                return ["Normal", "table-success"];  
            } else {
                return ["Hematócrito Alto", "table-danger"];  
            }
        case 'leucocitos':
            if ($valor < 4500) {
                return ["Leucócitos Baixos", "table-danger"];  
            } elseif ($valor >= 4500 && $valor <= 11000) {
                return ["Normal", "table-success"];  
            } else {
                return ["Leucócitos Altos (Possível Infecção)", "table-danger"];  
            }
        case 'glicose':
            if ($valor < 70) {
                return ["Glicose Baixa", "table-danger"];  
            } elseif ($valor >= 70 && $valor <= 99) {
                return ["Normal", "table-success"];  
            } else {
                return ["Glicose Alta", "table-danger"];  
            }
        case 'colesterol':
            if ($valor < 150) {
                return ["Colesterol Baixo", "table-danger"];  
            } elseif ($valor >= 150 && $valor <= 200) {
                return ["Normal", "table-success"];  
            } else {
                return ["Colesterol Alto", "table-danger"];  
            }
        default:
            return ["Inválido", "table-warning"]; 
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listagem de Pacientes</title>
</head>
<body class="bg-light">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Gestão Hospitalar</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="form.html">Cadastrar Paciente</a></li>
                    <li class="nav-item"><a class="nav-link" href="exames.html">Registrar Exames</a></li>
                    <li class="nav-item"><a class="nav-link" href="listar_pacientes.php">Pacientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="listar_situacao.php">Exames</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container my-5">
    <h1 class="text-center mb-4">Exames de Paciente</h1>
    <h3 class="text-center text-primary"><?= $nome ?></h3>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Hemoglobina</th>
                <th>Situação</th>
                <th>Hematócrito</th>
                <th>Situação</th>
                <th>Leucócitos</th>
                <th>Situação</th>
                <th>Glicose</th>
                <th>Situação</th>
                <th>Colesterol</th>
                <th>Situação</th>
                <th>Data do Exame</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($result->num_rows > 0){
                while($paciente = $result->fetch_object()){
                    list($situacaoHemoglobina, $classeHemoglobina) = verificarSituacao($paciente->hemoglobina, 'hemoglobina');
                    list($situacaoHematocrito, $classeHematocrito) = verificarSituacao($paciente->hematocrito, 'hematocrito');
                    list($situacaoLeucocitos, $classeLeucocitos) = verificarSituacao($paciente->leucocitos, 'leucocitos');
                    list($situacaoGlicose, $classeGlicose) = verificarSituacao($paciente->glicose, 'glicose');
                    list($situacaoColesterol, $classeColesterol) = verificarSituacao($paciente->colesterol, 'colesterol');

                    echo "<tr>";
                    echo "<td>".$paciente->hemoglobina."</td>";
                    echo "<td class='$classeHemoglobina'>".$situacaoHemoglobina."</td>";
                    echo "<td>".$paciente->hematocrito."</td>";
                    echo "<td class='$classeHematocrito'>".$situacaoHematocrito."</td>";
                    echo "<td>".$paciente->leucocitos."</td>";
                    echo "<td class='$classeLeucocitos'>".$situacaoLeucocitos."</td>";
                    echo "<td>".$paciente->glicose."</td>";
                    echo "<td class='$classeGlicose'>".$situacaoGlicose."</td>";
                    echo "<td>".$paciente->colesterol."</td>";
                    echo "<td class='$classeColesterol'>".$situacaoColesterol."</td>";
                    echo "<td>".$paciente->data_exame."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11' class='text-center'>Nenhum exame encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="text-center">
        <a href="index.php" class="btn btn-primary mt-3">&larr; Voltar à Página Inicial</a>
    </div>
</main>

<footer class="bg-primary text-center text-light py-3">
    DBCEL Softwares © 2024
</footer>

</body>
</html>
