<?php 
  session_start();
    if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
            session_destroy();
            header('Location: login.php');
    }else{
            $idfuncionario = $_SESSION['idfuncionario'];

            include 'parts/connection.php';
            
            $nomeParceiro = $_POST['nome'];
            $nomeusuario = $_POST['nomeusuario'];
            $usuario = $_POST['usuario'];
            $senhausuario = strtoupper(md5(strtoupper($_POST['senhausuario'])));
            $status = TRUE;
            $data = date("Y-m-d H:m:s");

            $sql = "INSERT INTO operadorsistema (nome, login, senha, habilitado, datacadastro, idrespcadastro, tipo, parceiro) 
                    VALUES ('$nomeusuario', '$usuario', '$senhausuario', '$status', '$data', $idfuncionario, 3, '$nomeParceiro')";
                    
            if(!($result = pg_query($conexao, $sql))) {
                print("Invalid query: " . pg_last_error()."\n");
                print("SQL: $sql\n");
                echo("Invalid query: " . pg_last_error()."\n");
                die();
            }else{
                echo("Nome: $nomeusuario \nuSUARIO: $usuario \nSenha: $senhausuario \nParceiro: $nomeParceiro \nData: $data"); 
            } 
               
    }
?>