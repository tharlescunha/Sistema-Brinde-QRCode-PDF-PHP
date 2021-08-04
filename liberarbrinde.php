<?php

session_start();

if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
  session_destroy();
  header('Location: login.php');
}else{

$data = date("Y-m-d H:i:s");
  
$fun = $_SESSION['idfuncionario']; // usuario logado, para armazenar quem liberou o brinde.
include 'parts/connection.php';
$idcasalbrinde = $_GET['id'];
$update = "UPDATE casalbrinde SET statusbrinde='LIBERADO' WHERE codigobrinde='$idcasalbrinde'";
pg_query($conexao, $update);

$sql = "SELECT idcasalbrinde FROM casalbrinde where codigobrinde = '$idcasalbrinde'";
$result = pg_query($conexao, $sql);
$row = pg_fetch_array($result);

$codigo = $row['idcasalbrinde'];

$update1 = "UPDATE dadosbrinde SET idusuariovalidor='$fun', datavalido='$data' WHERE idcasalbrinde='$codigo'";
pg_query($conexao, $update1);

echo "Deu certo!";

}
?>