<?php

    include "conexao.php";

    $nome = $_GET['nome'];

    $sql = "INSERT INTO pacientes (nome) VALUES ('$nome')";

    $resultado = $conn->query($sql);


    header('location: index.php');
?>