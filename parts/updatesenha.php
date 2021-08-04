<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: ../login.php');
  }else{
    include 'connection.php';


    if(isset($_POST['novasenha']) and isset($_POST['confirmacao'])){
      $novasenha = $_POST['novasenha'];
      $confirmacao = $_POST['confirmacao'];
      $idoperadorsistema = $_SESSION['idoperadorsistema'];
      if(($novasenha != $confirmacao) || ($novasenha == "" || $confirmacao == "")){
        echo("
          <script>
              alert('As senhas digitadas não conferem!');
              window.location='../perfil.php';
          </script>
        ");
      }else{
        $novasenha = strtoupper(md5(strtoupper($novasenha)));
        $sql = "UPDATE operadorsistema SET senha = '$novasenha' WHERE idoperadorsistema = $idoperadorsistema";
           if(!($result = pg_query($conexao, $sql))) {
             print("Invalid query: " . pg_last_error()."\n");
             print("SQL: $sql\n");
             die();
           }else{
             header('Location: ../perfil.php?cad=ok');
           }
        }
      }
      else{
        echo("
          <script>
              alert('As senhas digitadas não conferem!');
              window.location='../perfil.php';
          </script>
        ");
      }
    }


?>
