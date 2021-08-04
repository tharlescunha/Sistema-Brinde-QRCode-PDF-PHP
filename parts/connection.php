<?php
    $servidor = ""; // endereço do servidor.
    $porta = ; // porta do servidor
    $bancoDeDados = ""; // banco de dados

    $usuario = ""; // usuario
    $senha = "; // senha

     $conexao = pg_connect("host=$servidor port=$porta dbname=$bancoDeDados user=$usuario password=$senha");

     if(!$conexao) {
         die("Não foi possível se conectar ao banco de dados.");
     }
?>
