<?php 
  session_start();
    if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
            session_destroy();
            header('Location: login.php');
    }else{
            $idfuncionario = $_SESSION['idfuncionario'];
            include 'parts/connection.php';
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $responsavel = $_POST['responsavel'];
            $status = 'ATIVO';
            $endereco = $_POST['endereco'];
            $data = date("Y-m-d H:m:s");

            $sql = "INSERT INTO parceiros (nome, telefone, responsavel, status, endereco, idrespcadastro, datapcadastro) 
                    VALUES ('$nome', '$telefone', '$responsavel', '$status', '$endereco', $idfuncionario, '$data')";                    
           if(!($result = pg_query($conexao, $sql))) {
                print("Invalid query: " . pg_last_error()."\n");
                print("SQL: $sql\n");
                echo("Invalid query: " . pg_last_error()."\n");
                die();
            }else{
                echo("Nome: $nome \nTelefone: $telefone \nResponsavel: $responsavel \nEndereco: $endereco \nData: $data"); 
            }
    }
?>