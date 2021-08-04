<?php
  session_start();
  if (isset($_SESSION['nome'])){
    header('Location: contatos.php');
  }
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="media/images/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Login</title>
  </head>
  <body>
    <div class="limiter">
  		<div class="container-login100">
  			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
  				<form action="parts/logar.php" method="post" class="login100-form validate-form flex-sb flex-w">
  					<span class="login100-form-title p-b-32">
  						FIVE SENSES BRINDES
  					</span>
  					<span class="txt1 p-b-11">
  						Usuário
  					</span>
  					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
  						<input class="input100" type="text" name="login" >
  						<span class="focus-input100"></span>
  					</div>
  					<span class="txt1 p-b-11">
  						Senha
  					</span>
  					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
  						<input class="input100" type="password" name="senha" >
  						<span class="focus-input100"></span>
  					</div>
  					<div class="flex-sb-m w-full p-b-48">
  						<div class="contact100-form-checkbox">
  							<!-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
  							<label class="label-checkbox100" for="ckb1">
  								Remember me
  							</label> -->
  						</div>
  						<div>
  						</div>
  					</div>
  					<div class="container-login100-form-btn">
  						<button class="login100-form-btn">
  							Entrar
  						</button>
  					</div>
  				</form>
  			</div>
  		</div>
  	</div>
  	<div id="dropDownSelect1"></div>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
