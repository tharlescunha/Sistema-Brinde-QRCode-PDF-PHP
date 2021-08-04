<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: login.php');
  }else{
    $fun = $_SESSION['idfuncionario'];
    $idcasalbrinde = $_GET['id'];

    include 'parts/connection.php';

    $sql = "SELECT * FROM casalbrinde where codigobrinde = '{$idcasalbrinde}'";

    if(!($result = pg_query($conexao, $sql))) {
      print("Invalid query: " . pg_last_error()."\n");
      print("SQL: $sql\n");
      die();
    }
    $row = pg_fetch_array($result);

    $idCasalBrinde = $row['idcasalbrinde'];
    $data = "SELECT datausuoi FROM dadosbrinde where idcasalbrinde = $idCasalBrinde";
    $dataResult = pg_query($conexao, $data);
    $rowDataResult = pg_fetch_array($dataResult);

    $consumo = 'display:none';
    $data = date("d-m-Y - H:i:s");

    $datavalidade = date('d/m/Y', strtotime($row['datavalidade']));
    $dataatual = date("d/m/Y");
    
    if($row['statusbrinde'] == 'LIBERADO'){
      if(strtotime($datavalidade) >= strtotime($dataatual)){
        $_SESSION['msg'] = "<div class='alert alert-success'>Brinde libarado para uso!</div>";
        $butao = 'display:block';
      }else{
        $butao = 'display:none';
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Atenção! Brinde expirado.<br>Data de validade: $datavalidade.</div>";
      }
    }else if($row['statusbrinde'] == 'CONSUMIDO'){
      $butao = 'display:none';
      $consumo = 'display:block';
      $data = date('d/m/Y - h:m:s', strtotime($rowDataResult['datausuoi']));
      $_SESSION['msg'] = "<div class='alert alert-danger'>Atenção! <br>Este brinde já foi utilizado!</div>";

    }else{
      $butao = 'display:none';
      $_SESSION['msg'] = "<div class='alert alert-danger'>Atenção! Este brinde não está disponvel para comsumo.<br>Entre em contato com a equipe FiveSenses!</div>";
    }
  }
 ?>

 <!DOCTYPE html>
<html dir="ltr" lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="media/images/favicon.png">
  <title>Five Senses Resorts</title>
  <link href="css/style.min.css" rel="stylesheet">
  <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css'>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> -->
</head>

<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">

    <?php @include  'parts/menu.php';?>

    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Comsumir Brinde</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="index.php">Binde</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">consumir Binde</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

                <?php
                    if(isset($_SESSION['msg'])){
                      echo $_SESSION['msg'];
                      unset($_SESSION['msg']);
                    }
                ?>

                <p id="diverro" class="alert alert-danger" style="display:none">
                    Erro ao liberar brinde.
                </p>

                <p id="divsucesso" name="divsucesso" class="alert alert-success" style="display:none">
                    Brinde consumido com sucesso!
                </p>

                    <!-- Aqui ---->
                <form class="row g-3">

                    <div class="col-12">
                        <label for="textName" class="form-label">Nome Casal:</label>
                        <input type="text" id="disabledInput" value="<?php echo $row['nomecasal']; ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textDescricaoBrinde" class="form-label">Descrição do Brinde:</label>
                        <input type="text" value="<?php echo $row['descricaotipobrinde']; ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textValorBrinde" class="form-label">Valor do Brinde:</label>
                        <input type="text" value="R$ <?php echo $row['valornegociado']; ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textDataCadastro" class="form-label">Data Cadastro:</label>
                        <input type="text" value="<?php echo date('d/m/Y', strtotime($row['datacadastro'])); ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textDataValidade" class="form-label">Data Validade:</label>
                        <input type="text" value="<?php echo date('d/m/Y', strtotime($row['datavalidade'])); ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textCodigoBrinde" class="form-label">Codigo brinde:</label>
                        <input type="text" value="<?php echo $row['codigobrinde']; ?>" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="textStatusBrinde" class="form-label">Status brinde:</label>
                        <input type="text" name="status" id="status" value="<?php echo $row['statusbrinde']; ?>" class="form-control" disabled>
                    </div>

                    <div id="consumo" style="<?php echo $consumo;?>" class="col-md-6">
                        <label for="textStatusBrinde" class="form-label">Data e hora de consumo:</label>
                        <input type="text" name="status" id="status" value="<?php echo $data; ?>" class="form-control" disabled>
                    </div>

                    <div class="col-12">
                        <br>
                    </div>

                    <div id="butao" style="display:block" class="col-12">
                        <button id="<?=$idcasalbrinde?>" name="butao" class="btn btn-primary atualiza" style="<?php echo $butao;?>" type="button">Sinopse</button>
                    </div>
                </form>
                    <!-- Fim aqui ---->

          </div>
        </div>
      </div>
      <footer class="footer text-center">
        Todos os direitos reservados por
        <a href="http://www.fivesensesresorts.com">Five Senses Resorts</a>.
      </footer>
    </div>
  </div>
  <script src="vendor/jquery/dist/jquery.min.js"></script>
  <script src="vendor/popper.js/dist/umd/popper.min.js"></script>
  <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vendor/sparkline/sparkline.js"></script>
  <script src="vendor/waves.js"></script>
  <script src="vendor/sidebarmenu.js"></script>
  <script src="vendor/custom.min.js"></script>

<script src="vendor/jquery/dist/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $('button.atualiza').click(function() {
            botao = $(this);
            botao.text("Atualizando");
            var dados = botao.attr('id');
            $.ajax({
                url: 'usarbrinde.php?id='+dados,
                method: 'GET',
                dataType: 'html',
                data: '',
                success: function(data){
                    if(data == 'Deu certo!'){  
                      document.getElementById('status').value = 'CONSUMIDO';
                      document.getElementById("divsucesso").style.display = "block";
                      document.getElementById(dados).style.display = "none";  
                      document.getElementById("consumo").style.display = "block";
                      
                    }else{
                        alert('Erro, entre em contato com o suporte! '.data);
                        document.getElementById("diverro").style.display = "block";
                    }
                }
            }).fail(function (jqXHR, textStatus, error) {
                alert('Erro, entre em contato com o suporte! '.data);
                document.getElementById("diverro").style.display = "block";
            });

        });
    }); 
</script>  

</body>

</html>