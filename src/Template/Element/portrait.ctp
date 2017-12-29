
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
					['controller' => 'Colectivos', 'action' => 'verMesas'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-users']).$this->Html->tag('p','Personas',['class' => '']).'', 
					['controller' => 'Personas', 'action' => 'index-venta-rapida/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-ribbon']).$this->Html->tag('p','Lugares',['class' => '']).'', 
					['controller' => 'Lugares', 'action' => 'index-venta-rapida/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-note']).$this->Html->tag('p','Pre-Inscripcion',['class' => '']).'', 
					['controller' => 'Lugares', 'action' => 'index-venta-rapida/'],
					['escape' => false])?>
				</li>

				<li>
					<?= $this->Html->link($this->Html->tag('i','',['class' => 'pe-7s-check']).$this->Html->tag('p','Concluir-Inscripcion',['class' => '']).'', 
					['controller' => 'Lugares', 'action' => 'index-venta-rapida/'],
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

