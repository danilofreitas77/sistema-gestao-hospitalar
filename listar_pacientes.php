<?php
    include "conexao.php";

    $sql = "SELECT * FROM pacientes";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar Pacientes</title>
</head>
<body>
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="m-0">S.G.H</h2>
            <nav>
                <a href="form.html" class="btn btn-light btn-sm mx-1">Cadastrar Paciente</a>
                <a href="exames.html" class="btn btn-light btn-sm mx-1">Cadastrar Exames</a>
                <a href="listar_pacientes.php" class="btn btn-light btn-sm mx-1">Listar Pacientes</a>
                <a href="listar_situacao.php" class="btn btn-light btn-sm mx-1">Tela de Gestão</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1 class="text-center mb-4">Listar Pacientes</h1>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nome do Paciente</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($paciente = $result->fetch_object()): ?>
                        <tr>
                            <td><?= $paciente->id_paciente ?></td>
                            <td>
                                <a href="historico_paciente.php?id_paciente=<?= $paciente->id_paciente ?>" class="text-decoration-none text-primary">
                                    <?= $paciente->nome ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="delete_pacientes.php?id_paciente=<?= $paciente->id_paciente ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Tem certeza que deseja excluir este paciente?')">
                                   🗑️ Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum paciente encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Voltar à Página Inicial</a>
        </div>
    </main>

    <footer class="text-center py-3 mt-4 border-top">
        <p class="m-0">Sistema de Gestão Hospitalar &copy; 2024</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-zcqdV9CXmcq5M2HRI9+UCz9U52QrmG2fXZcOmJsm+T38IYLUuQlbKKOUA4f0Xa02" crossorigin="anonymous"></script>
</body>
</html>
