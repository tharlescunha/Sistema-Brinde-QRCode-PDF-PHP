<?php
  include 'connection.php';
  $login = $_POST['login'];
  $senha = strtoupper(md5(strtoupper($_POST['senha'])));
  $sql = "SELECT nome, tipo, login ,senha, idpessoa,idfuncionario, idoperadorsistema, idfornecedor, habilitado FROM operadorsistema
          WHERE login = '$login' and senha = '$senha' and habilitado = true";
  if(!($result = pg_query($conexao, $sql))) {
    print("Invalid query: " . pg_last_error()."\n");
    print("SQL: $sql\n");
    die();
  }else
  if(pg_num_rows($result)<1){
    header("Location: ../login.php");
  }else{
    session_start();
    $row = pg_fetch_array($result);
    $_SESSION['nome'] = $row['nome'];
    $_SESSION['idfuncionario'] = $row['idfuncionario'];
    $_SESSION['idpessoa'] = $row['idpessoa'];
    $_SESSION['idfornecedor'] = $row['idfornecedor'];
    $_SESSION['idoperadorsistema'] = $row['idoperadorsistema'];
    $_SESSION['habilitado'] = $row['habilitado'];
    $_SESSION['tipo'] = $row['tipo'];
    // echo ($_SESSION['nome']);
    //echo ($_SESSION['idfornecedor']);
    if($row['tipo'] == 3){
      header("Location: ../restaurante.php");
    }else{
      header("Location: ../index.php");
    }
  }
?>
