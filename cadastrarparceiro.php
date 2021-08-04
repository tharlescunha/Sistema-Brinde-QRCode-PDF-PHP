<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: login.php');
  }else{
    $fun = $_SESSION['idfuncionario'];

    include 'parts/connection.php';

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
            <h4 class="page-title">Cadastrar parceiro</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="index.php">Parceiros</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
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
                    <!-- Aqui ---->
                      <form id="simples-formulario-ajax" class="row g-3">
                            <div class="col-12">
                                <label for="textName" class="form-label">Nome*:</label>
                                <input type="text" id="nome" name="name" class="form-control" required="true">
                            </div>
                            <div class="col-md-6">
                                <label for="txtTelefone" class="form-label">Telefone:</label>
                                <input type="text"id="telefone" name="telefone" placeholder="(11) 9 11111111" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="txtResponsavel" class="form-label">Responsavel:</label>
                                <input type="text" id="responsavel" name="responsavel" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="textEndereco" class="form-label">Endereço:</label>
                                <input type="text" id="endereco" name="endereco" class="form-control">
                            </div>

                            <div class="col-12">
                                <br>
                            </div>
                            <div id="butao" style="display:block" class="col-2">
                                <button type="submit" id="enviar" class="btn btn-success">Cadastrar parceiro</button>
                            </div>
                      </form>

                      <form id="login" style="display:none" class="row">
                          <div class="row">
                              <div class="col-5 align-self-center">
                                        <h4 class="page-title">Cadastrar login</h4>
                                    </div>
                                    <div class="col-12">
                                        <label for="textName" class="form-label">Nome*:</label>
                                        <input type="text" id="nomeusuario" name="nomeusuario" class="form-control" required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="txtTelefone" class="form-label">Usúario*:</label>
                                        <input type="text"id="usuario" name="usuario" placeholder="" class="form-control" required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="txtResponsavel" class="form-label">Senha*:</label>
                                        <input type="password" id="senhausuario" name="senhausuario" class="form-control" required="true">
                                    </div>

                                    <div class="col-12">
                                        <br>
                                    </div>
                                    <div id="butaoenviar" style="display:block" class="col-2">
                                        <button type="submit" id="enviar" class="btn btn-success">Cadastrar usúario</button>
                                    </div>
                              </div>
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
	$('#simples-formulario-ajax').submit(function(e){
      e.preventDefault();
      if($('#enviar').val() == 'Cadastrando...'){
          return(false);
      }
      $.ajax({
          url: 'insertparceiro.php',
          type: 'post',
          dataType: 'html',
          data: {
              'metodo': $('#metodo').val(),
              'nome': $('#nome').val(),
              'telefone': $('#telefone').val(),
              'responsavel': $('#responsavel').val(),
              'endereco': $('#endereco').val()
          }
      }).done(function(data){
          alert('Parceiro Cadastrando com Sucesso!');
          //Aviso de Cadastrando com Sucesso!
          $("#nome").prop("disabled", true);
          $("#telefone").prop("disabled", true);
          $("#responsavel").prop("disabled", true);	
          $("#endereco").prop("disabled", true);
          document.getElementById("butao").style.display = "none";
          document.getElementById("login").style.display = "block";
      });
	}); 

  $('#login').submit(function(e){
      e.preventDefault();
      $.ajax({
          url: 'adduserparceiros.php',
          type: 'post',
          dataType: 'html',
          data: {
              'nome': $('#nome').val(),
              'nomeusuario': $('#nomeusuario').val(),
              'usuario': $('#usuario').val(),
              'senhausuario': $('#senhausuario').val()
          }
      }).done(function(data){
          alert('Usuario Cadastrando com Sucesso!');
          //Aviso de Cadastrando com Sucesso!
          $("#nome").prop("disabled", true);
          $("#nomeusuario").prop("disabled", true);
          $("#usuario").prop("disabled", true);	
          $("#senhausuario").prop("disabled", true);
          document.getElementById("butao").style.display = "none";
          document.getElementById("butaoenviar").style.display = "none";
      });
	}); 

</script>  
</body>

</html>
