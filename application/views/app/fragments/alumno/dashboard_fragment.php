<div class="row">
	<div class="col-md-12">	
		<h2 class="page-tittle">Inicio</h2>
		<ol class="breadcrumb-cd-fi">	
			<li class="active">
				<i class="fa fa-home"></i> Inicio	
			</li>
			
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-5">
		<img src="<?=base_url()?>static/img/bienvenido.png" alt="Bienvenido" class="img img-responsive">	
	</div>
    <div class="col-xs-12 col-md-6 panel panel-info">
        <h1 class="h1">Avisos </h1>

        <?php if (!is_null($avisos)){ ?>
            <?php foreach ($avisos as $aviso): ?>
                <div class="col-md-12 panel-heading">
                    <?php if ($aviso->rol == 4) {
                        echo "<h3 class='panel-title'>Aviso de Secretaría Académica</h3>";
                    }elseif ($aviso->rol == 7) {
                        echo "<h3 class='panel-title'>Aviso de Control Escolar</h3>";
                    } 
                    ?>                
                </div>
                <div class="col-md-12 panel-body">
                    <?=$aviso->aviso?>
                </div>

            <?php endforeach ?>

        <?php }else{ ?>
            <div class="col-md-12 panel-body">
                <h3>No Hay Avisos </h3>                       
            </div>
        <?php } ?>

        <?php if (!is_null($avisosE)){ ?>
            <?php foreach ($avisosE as $aviso): ?>
                <div class="col-md-12 panel-heading">
                    <?php 
                        echo "<h3 class='panel-title'>Aviso de tu Coordinador de Carrera</h3>"; 
                    ?>                
                </div>
                <div class="col-md-12 panel-body">
                    <?=$aviso->aviso?>
                </div>

            <?php endforeach ?>

        <?php } ?>

        
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="materias-modal" class="modal fade" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 id="myModalLabel" class="modal-title">Aviso:</h4>
        </div>
        <div class="modal-body" >
            Proporciona las materias que ya cursaste:
        </div>
        <div class="modal-footer">
            <button class="btn submit menta col-md-offset-4" type="button">Guardar</button>
            <button data-dismiss="modal" class="btn btn-primary col-md-offset-4" type="button">Omitir</button>
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>