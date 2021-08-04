<?php
  session_start();
  if (!isset($_SESSION['nome']) and !isset($_SESSION['idfuncionario'])){
    session_destroy();
    header('Location: login.php');
  }else{
    $fun = $_SESSION['idfuncionario'];
    $for = $_SESSION['idfornecedor'];
    $tipo = $_SESSION['tipo'];
    include 'parts/connection.php';
  }
 ?>

<header class="topbar" data-navbarbg="skin6">
  <nav class="navbar top-navbar navbar-expand-md navbar-light">
    <div class="navbar-header" data-logobg="skin5">
      <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
        <i class="ti-menu ti-close"></i>
      </a>
      <div class="navbar-brand">
        <a href="index.php" class="logo">
          <b class="logo-icon">
            <img src="media/images/logo-icon.png" alt="homepage" class="dark-logo" />
            <img src="media/images/logo-light-icon.png" alt="homepage" class="light-logo" />
          </b>
          <span class="logo-text">
            <img src="media/images/logo-text.png" alt="homepage" class="dark-logo" />
            <img src="media/images/logo-light-text.png" class="light-logo" alt="homepage" />
          </span>
        </a>
      </div>
      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="ti-more"></i>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
      <ul class="navbar-nav float-left mr-auto">
      </ul>
      <ul class="navbar-nav float-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="media/images/1.jpg" alt="user" class="rounded-circle" width="31">
            <span><?php echo $_SESSION['nome']?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right user-dd animated">
            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> Meu Perfil</a>
            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-help-alt m-r-5 m-l-5"></i> Ajuda</a>
            <a class="dropdown-item" href="parts/logout.php"><i class="ti-share-alt m-r-5 m-l-5"></i> Sair</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>

<aside class="left-sidebar" data-sidebarbg="skin5">
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <ul id="sidebarnav">

      <?php

            if($tipo == 3){
              echo "   <li class='sidebar-item'>
                        <a class='sidebar-link waves-effect waves-dark sidebar-link' href='restaurante.php' aria-expanded='false'>
                          <i class='mdi mdi-checkbox-multiple-marked-outline'></i>
                          <span class='hide-menu'>Parceiro</span>
                        </a>
                      </li>";
            }
            else{
              echo "   <li class='sidebar-item'>
                        <a class='sidebar-link waves-effect waves-dark sidebar-link' href='index.php' aria-expanded='false'>
                          <i class='mdi mdi-gift'></i>
                          <span class='hide-menu'>Consular brinde</span>
                        </a>
                      </li>";
              echo "   <li class='sidebar-item'>
                        <a class='sidebar-link waves-effect waves-dark sidebar-link' href='liberar.php' aria-expanded='false'>
                          <i class='mdi-file-presentation-box'></i>
                          <span class='hide-menu'>Validar Brinde</span>
                        </a>
                      </li>";
            echo "   <li class='sidebar-item'>
                      <a class='sidebar-link waves-effect waves-dark sidebar-link' href='restaurante.php' aria-expanded='false'>
                        <i class='mdi mdi-checkbox-multiple-marked-outline'></i>
                        <span class='hide-menu'>Parceiro</span>
                      </a>
                    </li>";
            echo "   <li class='sidebar-item'>
                    <a class='sidebar-link waves-effect waves-dark sidebar-link' href='parceiros.php' aria-expanded='false'>
                      <i class='mdi mdi-checkbox-multiple-marked-outline'></i>
                      <span class='hide-menu'>Cadastros</span>
                    </a>
                  </li>";
            }
        ?>
<!-----
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
            <i class="mdi mdi-gift"></i>
            <span class="hide-menu">Consular brinde</span>
          </a>
        </li>
        
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="liberar.php" aria-expanded="false">
              <i class="mdi-file-presentation-box"></i>
              <span class="hide-menu">Validar Brinde</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="restaurante.php" aria-expanded="false">
              <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
              <span class="hide-menu">Parceiro</span>
            </a>
            
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="parceiros.php" aria-expanded="false">
              <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
              <span class="hide-menu">Cadastros</span>
            </a>
          </li>


          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
              <i class="mdi mdi-chart-bar"></i>
              <span class="hide-menu">Relatório</span>
            </a>
          </li>          

          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="boasvindas.php" aria-expanded="false">
              <i class="mdi mdi-email-outline"></i>
              <span class="hide-menu">Boas Vindas</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="addgerencia.php" aria-expanded="false">
              <i class="mdi mdi-tie"></i>
              <span class="hide-menu">Adicionar Gerência</span>
            </a>
          </li>
----->
        <?php
            if($for == 1){
              echo "   <li class='sidebar-item'>
                        <a class='sidebar-link waves-effect waves-dark sidebar-link' href='graficos.php' aria-expanded='false'>
                          <i class='mdi mdi-chart-line'></i>
                          <span class='hide-menu'>Gráficos</span>
                        </a>
                      </li>";
              echo "   <li class='sidebar-item'>
                        <a class='sidebar-link waves-effect waves-dark sidebar-link' href='configuracoes.php' aria-expanded='false'>
                          <i class='mdi mdi-settings'></i>
                          <span class='hide-menu'>Configurações</span>
                        </a>
                      </li>";
            }
        ?>
      </ul>
    </nav>
  </div>
</aside>
