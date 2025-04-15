<?php

    include "conexao.php";

    $id = $_GET['id'];
    $hemoglobina = $_GET['hemoglobina'];
    $hematocrito = $_GET['hematocrito'];
    $leucocitos = $_GET['leucocitos'];
    $glicose = $_GET['glicose'];
    $colesterol = $_GET['colesterol'];
    $data = $_GET['data'];


    floatval($hemoglobina);
    floatval($hematocrito);
    floatval($leucocitos);
    floatval($glicose);
    floatval($colesterol);

    $sql = "INSERT INTO exames (id_paciente, hemoglobina, hematocrito, leucocitos, glicose, colesterol, data_exame) VALUES ('$id', '$hemoglobina', '$hematocrito', '$leucocitos', '$glicose', '$colesterol', '$data')";

    

    $resultado = $conn->query($sql);

    if($resultado){
        echo "Exame cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar!";
    }
?>

<a href="index.php">< Voltar</a>