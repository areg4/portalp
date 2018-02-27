<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; height:51px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand titulo" href="<?=base_url()?>"><h1>Portal Informática</h1></a>
            </div>
            <!-- /.navbar-header -->
            <div class=" menta" id="app-titulo">
              <h1 class="">
                <?=$app_title?>
              </h1>
            </div>
             <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <div class="perfil-image"><img src="<?=base_url()?>static/img/avatar-1.png" class="ajustar-img"></div>
                      
                    </a>
                    <ul class="dropdown-menu dropdown-user col-md-6 col-xs-6">
                      <li><h5 style=""><i class="fa fa-user"></i> <?=ucfirst(strtolower($user->nombre)).' '.ucfirst(strtolower($user->apellidoPaterno)).' '.ucfirst(strtolower($user->apellidoMaterno))?></h5></li>
                      <li class="divider"></li>
                      <li><a href="<?=base_url()?>portal-informatica-mi-cuenta"><i class="fa fa-gear"></i> Mi cuenta</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=base_url()?>portal-informatica-cerrar-sesion"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse" style="height: 0;">
                    <ul class="nav" id="side-menu">
                      <?=$menu_app?>
                      <li id="creditos">
                        <h4>
                          Facultad de Informática
                        </h4>
                        <h4>
                          Centro de Desarrollo <?=date('Y')?> &#9400;
                        </h4>
                      </li>
                    </ul>

                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
          
            <!-- /.navbar-static-side -->
        </nav>


