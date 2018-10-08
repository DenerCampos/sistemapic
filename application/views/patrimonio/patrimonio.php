<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- novo -->
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarPatrimonio" 
                    data-toggle="modal" data-target="#mdlCriarPatrimonio" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo equipamento
            </button>
            <a class="btn btn-success" href="<?php echo base_url("exibir/patrimonio"); ?>" role="button">
                <i class="fa fa-list-alt"></i> Listar todos
            </a>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("patrimonio/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome, modelo, patrimônio ou serial...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div> <!-- fim row -->
    
    <!-- Mapa -->    
    <div class="row">
        
        <div id="back" class="btn voltar-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </div>
        <!-- Mapa Patrimonio -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mapa-patrimonio">
            
            <img src="<?php echo $assetsUrl;?>/img/pic-patrimonio.JPG" alt="" 
                 class="img-mapa-patrimonio" usemap="#Mapa" id="mapa-patrimonio"/>
            <map name="Mapa" id="Mapa" class="desc-ponto-mapa"> 
            <?php if (isset($locais)) { ?>
                <?php foreach ($locais as $local) { ?>
                <area alt="" class="" data-toggle="popover"
                      id="<?php echo $local->getIdlocal(); ?>"
                      title="<?php echo "<strong>".$local->getNome()."</strong>"; ?>"
                      data-content="<?php if (isset($patrimonio)) { ?>
                      <?php foreach ($patrimonio as $equipamento) { ?>
                      <?php if($equipamento->getIdlocal() == $local->getIdlocal()){ ?>
                      <?php echo $equipamento->getEquipamento() . ": " . $equipamento->getPatrimonio()."<br/>"; ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>"
                      href="#<?php echo "titulo".$local->getIdlocal() ?>" 
                      shape="<?php echo $local->getShape(); ?>" 
                      coords="<?php echo $local->getCoords(); ?>"/>
                <?php } ?> <!--Fim foreach-->
                <?php } ?> <!--Fim se-->
            </map>
        </div>
    </div>
    
    <!-- Dados (Painel) -->
    <div class="row painel-patrimonio">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
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
                            <i class="fa fa-angle-down" aria-hidden="true"></i> 
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
                           <?php if (isset($patrimonio)) { ?>
                           <?php foreach ($patrimonio as $equipamento) { ?>
                           <?php if($equipamento->getIdlocal() == $local->getIdlocal()){ ?>
                            <li class="list-group-item">
                                
                                <div class="row"> 
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h4 class="titulo-patrimonio">
                                            <?php echo $equipamento->getEquipamento()." <small>Patrimônio: ".$equipamento->getPatrimonio()."</small>"?>
                                        </h4>
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Modelo</th>                                    
                                                    <th>Número de serie</th>
                                                    <th>Fornecedor</th>
                                                    <th>Descrição</th>
                                                    <th class="text-right">Opções</th>
                                                </tr>
                                            </thead>
                                            <!-- corpo tabela -->
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $equipamento->getModelo(); ?></td>
                                                    <td><?php echo $equipamento->getSerie(); ?></td>
                                                    <td><?php echo $equipamento->getFornecedor(); ?></td>
                                                    <td><?php echo $equipamento->getDescricao(); ?></td>
                                                    <td class="text-right">
                                                        <a href="#mdlEditarPatrimonio" data-toggle="modal" 
                                                           data-target="#mdlEditarPatrimonio" role="button"
                                                           data-id="<?php echo $equipamento->getIdpatrimonio(); ?>"
                                                           onclick="editarPatrimonio(this)">
                                                            <i class="fa fa-edit" title="Editar"></i>
                                                        </a>
                                                        <a href="#mdlRemoverPatrimonio" data-toggle="modal" 
                                                           data-target="#mdlRemoverPatrimonio" role="button"
                                                           data-id="<?php echo $equipamento->getIdpatrimonio(); ?>"
                                                           onclick="removerPatrimonio(this)">
                                                            <i class="fa fa-trash" title="Remover"></i>
                                                        </a>
                                                    </td>
                                                </tr>                                                
                                            </tbody>
                                        </table>
                                        
                                        <h4 class="titulo-s-patrimonio">Manutenções</h4>
                                        <?php $manutencoes = $this->manutencao->buscaPatrimonio($equipamento->getPatrimonio()); //recebe todas manutenções do patrimonio exibido ?>
                                        <?php if (isset($manutencoes)) { ?>
                                        <table class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Defeito</th>                                    
                                                    <th>Envio</th>
                                                    <th>Retorno</th>
                                                    <th>Garantia</th>
                                                    <th>Solução</th>
                                                    <th class="text-right">Opções</th>
                                                </tr>
                                            </thead>
                                            <!-- corpo tabela -->   
                                            <tbody>
                                                <?php foreach ($manutencoes as $manu) { ?>
                                                <tr>
                                                    <td><?php echo date("d/m/y", strtotime($manu->getData_defeito())); ?></td>
                                                    <td><?php echo date("d/m/y", strtotime($manu->getData_entrega())); ?></td>
                                                    <td><?php echo date("d/m/y", strtotime($manu->getData_retorno())); ?></td>
                                                    <td><?php echo date("d/m/y", strtotime($manu->getData_garantia())); ?></td>
                                                    <td><?php echo $manu->getSolucao(); ?></td>
                                                    <td class="text-right">
                                                        <a href="#mdlVisualizarManutencao" data-toggle="modal" 
                                                           data-target="#mdlVisualizarManutencao" role="button"
                                                           data-id="<?php echo $manu->getIdmanutencao(); ?>"
                                                           onclick="visualizarManutencao(this)">
                                                            <i class="fa fa-search-plus" title="Vizualizar"></i>
                                                        </a>
                                                    </td>
                                                </tr>  
                                                <?php } ?> <!--Fim foreach manutencao-->
                                            </tbody>
                                            <?php } else { ?> <!--Fim se manutencao-->
                                            <p class="texto-patrimonio">Não tem manutenção neste equipamento.</p>
                                            <?php } ?> <!--Fim else manutencao-->
                                        </table>
                                    </div>
                                    
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
    </div>
</div>