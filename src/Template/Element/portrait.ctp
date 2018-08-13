
    	<div class="sidebar-wrapper">
              <div class="logo">

			  <a href="../pages/home" class="simple-text">
                           Campamento IVE
                        </a>
		
             </div>

            <ul class="nav">
				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-monitor']).$this->Html->tag('p','Inicio',['class' => '']).'', 
					['controller' => 'Pages', 'action' => 'home'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-car']).$this->Html->tag('p','Colectivos',['class' => '']).'',
					['controller' => 'Colectivos', 'action' => 'index/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-users']).$this->Html->tag('p','Participantes',['class' => '']).'',
					['controller' => 'Personas', 'action' => 'index/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-ribbon']).$this->Html->tag('p','Lugares',['class' => '']).'', 
					['controller' => 'Lugares', 'action' => 'index/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-note']).$this->Html->tag('p','Pre-Inscripcion',['class' => '']).'', 
					['controller' => 'Inscripciones', 'action' => 'index-pre'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-check']).$this->Html->tag('p','Inscripcion',['class' => '']).'', 
					['controller' => 'Inscripciones', 'action' => 'index/'],
					['escape' => false])?>
				</li>

                <li>
                    <?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-notebook']).$this->Html->tag('p','Eventos',['class' => '']).'',
                        ['controller' => 'Eventos/index', 'action' => 'index'],
                        ['escape' => false])?>
                </li>

                <li>
                    <?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-add-user']).$this->Html->tag('p','Usuarios',['class' => '']).'',
                        ['controller' => 'Usuarios/index', 'action' => 'index'],
                        ['escape' => false])?>
                </li>

                <li>
                    <?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-print']).$this->Html->tag('p','Reporte Incripciones',['class' => '']).'',
                        ['controller' => 'inscripciones', 'action' => 'reporte'],
                        ['escape' => false])?>
                </li>
		
				
				<li>
						<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-power']).$this->Html->tag('p','Cerrar Sesion',['class' => '']).'', 
					['controller' => 'usuarios', 'action' => 'logout'],
					['escape' => false])?>
				</li>


			</ul>
    	</div>
    </div>

