<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Lista setores  -->
<div class="col-md-12">
    <div class="col-md-4 setores">
        <h2>Setores</h2>
        <!--Busca-->
        <div class="busca">
            <div class="ui-widget form-group">
                <label for="buscaMaquina">Busca rapida:</label>
                <input type="text" name="buscaMaquina" id="buscaMaquina" 
                       class="form-control buscaMaquina"
                       placeholder="Digite numero do caixa">
            </div>
        </div>        
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            
            <?php if (isset($locais)) { ?>
            <?php foreach ($locais as $local) { ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="<?php echo "titulo".$local->getIdlocal() ?>">
                    <h4 class="panel-title">
                        <a class="<?php if ($local->getIdlocal() != 1){ echo "collapsed"; } ?>"
                           role="button" data-toggle="collapse" data-parent="#accordion"
                           href="<?php echo "#collapse".$local->getIdlocal() ?>"
                           aria-expanded="<?php if ($local->getIdlocal() != 1){ echo "false"; } ?>"
                           aria-controls="<?php echo "collapse".$local->getIdlocal() ?>">
                            <?php echo $local->getNome() ?>
                        </a>
                    </h4>
                </div>
                
                <div id="<?php echo "collapse".$local->getIdlocal() ?>" 
                     class="panel-collapse collapse <?php if ($local->getIdlocal() == 1){ echo "in"; } ?>" 
                     role="tabpanel" 
                     aria-labelledby="<?php echo "titulo".$local->getIdlocal() ?>">
                    
                    <div class="panel-body">
                        <ul class="list-group">
                           <?php if (isset($maquinas)) { ?>
                           <?php foreach ($maquinas as $maquina) { ?>
                           <?php if($maquina->getIdlocal() == $local->getIdlocal()){ ?>
                            <li class="list-group-item">
                                <?php echo $maquina->getNome() . ": " . $maquina->getIP(); ?>
                                <div class="opcoes-caixa opcoes">
                                    <a href="#" role="button"
                                       data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                       onclick="verificarEstado(this)">
                                        <i class="fa fa-info-circle" title="Verifica online"></i>
                                    </a>
                                    <a href="#mdlEditarMaquina" data-toggle="modal" 
                                       data-target="#mdlEditarMaquina" role="button"
                                       data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                       onclick="editarCaixa(this)">
                                        <i class="fa fa-edit" title="Editar Caixa"></i>
                                    </a>
                                    <?php if ($this->session->userdata('nivel') != '2'){ ?>
                                    <a href="#mdlRemoverMaquina" data-toggle="modal" 
                                       data-target="#mdlRemoverMaquina" role="button"
                                       data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                       onclick="removerCaixa(this)">
                                        <i class="fa fa-trash" title="Remover Caixa"></i>
                                    </a>
                                    <?php } ?> <!--Fim se-->
                                </div>
                            </li>
                           <?php } ?> <!--Fim se-->
                           <?php } ?> <!--Fim foreach-->
                           <?php } ?> <!--Fim se-->
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?> <!--Fim foreach-->
            <?php } ?> <!--Fim se-->
        </div>
    </div>
    
       
    <!--Mapa-->
    <div class="col-md-8">
        <h2>Mapa PIC</h2>
        <div class="mapa-pic">
            <img src="<?php echo $assetsUrl;?>/img/mapa-PIC.png" alt="" 
                 class="img-thumbnail" usemap="#Map" />
            <map name="Map" id="Map">
                <?php if (isset($locais)) { ?>
                <?php foreach ($locais as $local) { ?>
                <area alt="" class="" data-toggle="popover"
                      id="<?php echo $local->getIdlocal(); ?>"
                      title="<?php echo "<strong>".$local->getNome()."</strong>"; ?>"
                      data-content="<?php if (isset($maquinas)) { ?>
                      <?php foreach ($maquinas as $maquina) { ?>
                      <?php if($maquina->getIdlocal() == $local->getIdlocal()){ ?>
                      <?php echo $maquina->getNome() . ": " . $maquina->getIP()."<br/>"; ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>"
                      href="#" 
                      shape="<?php echo $local->getShape(); ?>" 
                      coords="<?php echo $local->getCoords(); ?>"/>
                <?php } ?> <!--Fim foreach-->
                <?php } ?> <!--Fim se-->
            </map>
        </div>
    </div>
    
</div>
