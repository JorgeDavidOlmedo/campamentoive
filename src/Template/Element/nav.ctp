    <?php
    $id_empresa = $this->request->session()->read('id_empresa');
    $empresa = $this->request->session()->read('empresa');
    $rol_usuario= $this->request->session()->read('Auth.User.rol');

    ?>
   <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  
                </div>
                
                <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-left">
                        <li>
                            <!--a href="../pages/home" class="dropdown-toggle">
								<p>Empresa: <strong></strong></p>
                            </a-->
                          
                        </li>
                 </ul>       
              

                    <ul class="nav navbar-nav navbar-right">
                        
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Hola <?= $this->request->session()->read('Auth.User')['nombre']?>
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                              <?php $id_usuario = $this->request->session()->read('Auth.User.id');?>

                                  <li><?php echo $this->Html->link($this->Html->tag('span','').'Datos del Usuario',array('controller'=>'Usuarios', 'action'=>'setIdEmpresa') ,['escape' => false]);?></li>


                              </ul>
                        </li>
                        <li>
                       </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

       