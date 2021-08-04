<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: ../login.php');
  }else{
    include 'connection.php';
    $idlotecontatomailing = $_SESSION['valor'];
    $idcontatomailing = $_SESSION['valor2'];
    $status = $_POST['status'];
    $observacao = $_SESSION['nome'].": ".$_POST['observacao'];
    $salavendas = $_POST['salasemana'];
    $data = null;
    $horario = null;
    $idfuncionario = $_SESSION['idfuncionario'];
    $nomecliente = $_SESSION['nomecliente'];
    //$cpfcliente = $_SESSION['cpfcliente'];
    $dddcliente = $_SESSION['dddcliente'];
    $telefonecliente = $_SESSION['telefonecliente'];
    $idoperador = $_SESSION['idoperadorsistema'];
    $today = date("Y-m-d H:i:s");





    if($status == "STATUSATEND_TLMK_CONTATOEFETIVO"){
      $data = $_POST['data'];
      $horario = $_POST['horario'];
      $data = $data." ".$horario;
      $horario = date("Y-m-d H:i:00");
      $ddd = substr($_POST['telefone'],0,strpos($_POST['telefone'],"-"));
      $telefone = substr($_POST['telefone'],strpos($_POST['telefone'],"-")+1,strlen($_POST['telefone']));


      $sql = "INSERT INTO atendimentocontatomailing (datacadastro, idfuncionario, idcontatomailing, idlotecontatomailing, status, observacao, idrespcadastro, idtenant)
      VALUES ('$today', $idfuncionario, $idcontatomailing, $idlotecontatomailing, '$status', '$observacao', $idoperador, 1);
      INSERT INTO casal (datacadastro, idsalavendas, nome1, idpromotortlmkt, idrespcadastro, idlocalcaptacao, idgerentesalavendas, agendado, datahoraagendamento,idtenant,
			excluido, idorigemcasal, idcontatomailing, dddfonemovel, fonemovel, idlidermarketing)
      VALUES('$horario', $salavendas, '$nomecliente', $idfuncionario, $idoperador, 7, 110, true, '$data', 1, false, 3, $idcontatomailing, '$ddd', '$telefone', 151)";
    }elseif($status == "STATUSATEND_TLMK_LIGARDEPOIS" and $_POST['dataligardepois']<>''){
      $dataligardepois = str_replace("T", " ", $_POST['dataligardepois']).":00";
      $sql = "INSERT INTO atendimentocontatomailing (datacadastro, idfuncionario, idcontatomailing, idlotecontatomailing, status, observacao, idrespcadastro, dataretorno, idtenant)
      VALUES ('$today', $idfuncionario, $idcontatomailing, $idlotecontatomailing, '$status', '$observacao', $idoperador, '$dataligardepois', 1)";
    }
    else{
      $sql = "INSERT INTO atendimentocontatomailing (datacadastro, idfuncionario, idcontatomailing, idlotecontatomailing, status, observacao, idrespcadastro, idtenant)
      VALUES ('$today', $idfuncionario, $idcontatomailing, $idlotecontatomailing, '$status', '$observacao', $idoperador, 1)";
    }
    if(!($result = pg_query($conexao, $sql))) {
      print("Invalid query: " . pg_last_error()."\n");
      print("SQL: $sql\n");
      die();
    }else{
      header('Location: ../contatos.php?cad=ok');
    }
  }

?>
