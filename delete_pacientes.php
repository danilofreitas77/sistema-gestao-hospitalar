<?php
include 'conexao.php';

$id_paciente = $_GET['id_paciente'];

// Excluir os exames relacionados ao paciente
$sql_exames = "DELETE FROM exames WHERE id_paciente = $id_paciente";
$conn->query($sql_exames);

// Excluir o paciente
$sql_paciente = "DELETE FROM pacientes WHERE id_paciente = $id_paciente";
$mensagem = "";
if ($conn->query($sql_paciente) === TRUE) {
    $mensagem = "<div class='alert alert-success' role='alert'>Paciente e exames deletados com sucesso.</div>";
} else {
    $mensagem = "<div class='alert alert-danger' role='alert'>Erro ao deletar o paciente: " . $conn->error . "</div>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Excluir Paciente</title>
</head>
<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Gestão Hospitalar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="form.html">Cadastrar Paciente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="exames.html">Registrar Exames</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listar_pacientes.php">Pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listar_situacao.php">Exames</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <div class="text-center">
            <?= $mensagem; ?>
            <a href="index.php" class="btn btn-primary mt-4">&larr; Voltar à Página Inicial</a>
        </div>
    </main>

    <footer class="text-center py-4 bg-primary text-light">
        DBCEL Softwares © 2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OTcA5IwnQ32QeGfwpWzWzMJoKtbnZT/zUQJFLp3gEVI8Gj9ZsvcrBLon7DZ5J+Nj" crossorigin="anonymous"></script>
</body>
</html>
