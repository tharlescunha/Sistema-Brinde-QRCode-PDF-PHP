<?php

session_start();
if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
  session_destroy();
  header('Location: login.php');
}else{
  $fun = $_SESSION['idfuncionario'];
  $idcasalbrinde = $_GET['gerar_pdf'];

  include 'parts/connection.php';
  $data = date("Y-m-d H:i:s");
  $data2 = date("d/m/Y");

  $dadosbrinde = "INSERT INTO dadosbrinde(idusuarioemissao, dataemissao, idcasalbrinde) VALUES ('$fun','$data', '$idcasalbrinde')";
  pg_query($conexao, $dadosbrinde);


  $sql = "SELECT * FROM casalbrinde INNER JOIN tipobrinde ON 
	casalbrinde.idtipobrinde = tipobrinde.idtipobrinde 
	where casalbrinde.idcasalbrinde = $idcasalbrinde";

  if(!($result = pg_query($conexao, $sql))) {
	print("Invalid query: " . pg_last_error()."\n");
	print("SQL: $sql\n");
	die();
  }
  $row = pg_fetch_array($result);
}

$id = $_REQUEST['gerar_pdf'];

$nome = $row['nomecasal'];
$codigo = $row['codigobrinde'];
$profissao = $row['nomecasal'];
$descricao = $row['descricaotipobrinde'];
$datavalidade = date('d/m/Y', strtotime($row['datavalidade']));

$update = "UPDATE casalbrinde SET statusbrinde='EMITIDO' WHERE idcasalbrinde=$idcasalbrinde";
pg_query($conexao, $update);

require 'fpdf.php';

			$aux = 'qr_img0.50j/php/qr_img.php?';
			$aux .= 'd=Teste&';
			$aux .= 'e=H&';
			$aux .= 's=4&';
			$aux .= 't=J';
			
			$url = 'http://localhost/adm/qr_img0.50j/php/qr_img.php?d='.$codigo.'&e=H&s=4&t=J';
      //$url = 'https://www.fivesensesresorts.com.br/brinde/qr_img0.50j/php/qr_img.php?d='.$codigo.'&e=H&s=4&t=J';

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetXY(80, 20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0,0, 60);
$pdf->Cell(0, 10, "Perfil do Usuário", 1, 1, "Right text", 0, 0, 'C');
$pdf->GetX(100);

$pdf->Image("imagem/fundo.png", 0, 0, 210, 297);

$pdf->SetXY(80, 35);
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(11, 80, 145);

$pdf->Image($url,80, 215, 50, 50, 'JPEG');

$pdf->SetXY(13, 69);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "Sr(s)/Sra.(s) $nome estão recebendo neste ato nosso voucher de consumo no parceiro RESTAURANTE ARARA – Tocantins válido conforme as especificações de uso descritas abaixo, o qual faz parte da divulgação do PROGRAMA DE FÉRIAS FIVE SENSES RESORTS BY REDE PLAZA.
Descrição: $descricao

ESPECIFICAÇÃO DE USO:
 ",'FJ', "J");

$pdf->SetXY(13, 100);
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
°	O beneficiário poderá utilizar o mesmo para o consumo de qualquer produto no RESTAURANTE ARARA, neste caso o voucher terá o valor de R$ 80,00 (Oitenta reais);
°	Este certificado é pessoal, intransferível e sem valor comercial, não podendo ser trocado por dinheiro ou por outro benefício, e não poderá ser utilizado em combinação com outro certificado ou promoção;
°	Este voucher somente terá validade estando carimbado e assinado pela pessoa responsável;
",'FJ', "C");

$pdf->SetXY(13, 136);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
**ESTE VOUCHER NÃO TEM VALIDADE APÓS A DATA DE VALIDADE **
",'FJ', "C");

$pdf->SetXY(13, 145);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
EMISSÃO: $data2. 
VALIDADE: $datavalidade.
",'FJ', "L");

$pdf->SetXY(13, 160);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
____________________________________________________
FIVE SENSES RESORTS SPE LTDA
",'FJ', "C");

$pdf->SetXY(13, 175);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
Declaro que li e entendi, compreendi e estou de acordo com as cláusulas do PROGRAMA DE FÉRIAS FIVE SENSES RESORTS BY REDE PLAZA assinado por mim nessa data de $data2.
 ",'FJ', "J");

$pdf->SetXY(13, 195);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
Assinatura _______________________________________
Sr(s)/Sra.(s):  $nome
",'FJ', "L");

$pdf->SetXY(13, 265);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(185, 5, "
$codigo
",'FJ', "C");

 


$pdf->Output();
