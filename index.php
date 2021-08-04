<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: login.php');
  }else{
    $fun = $_SESSION['idfuncionario'];
    include 'parts/connection.php';
    $sql = "SELECT * FROM casalbrinde INNER JOIN tipobrinde ON casalbrinde.idtipobrinde = tipobrinde.idtipobrinde where tipobrinde.idtipobrinde = 28 ORDER BY idcasalbrinde ASC";

    if(!($result = pg_query($conexao, $sql))) {
      print("Invalid query: " . pg_last_error()."\n");
      print("SQL: $sql\n");
      die();
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
            <h4 class="page-title">Inicio</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Brindes</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Principal</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Brindes</h4>
              </div>
              <div class="table-responsive">
                <table id="dtBasicExample" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="border-top-0">CASAL</th>
                      <th class="border-top-0">BRINDE</th>
                      <th class="border-top-0">STATUS</th>
                      <th class="border-top-0">VALIDADE</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                          while ($row = pg_fetch_array($result)) {
                            
                              echo("
                                <tr>
                                  <td class='txt-oflo'><a href='cotauh.php?id=".$row['idcasalbrinde']."'>".$row['nomecasal']."</a></td>
                                  <td class='txt-oflo'>".$row['descricaotipobrinde']."</td>
                                  <td class='txt-oflo'>".$row['statusbrinde']."</td>
                                  <td class='txt-oflo'>".date('d/m/y', strtotime($row['datavalidade']))."</td>
                                </tr>
                              ");
                          }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
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
    $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });
  </script>
</body>

</html>
