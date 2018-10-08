<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- manutencaos  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
    <!-- botão voltar topo  -->
    <!--<div id="back" class="btn voltar-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </div>-->
    
    <div class="row">
        
        <!-- nova manutencao  -->
        <div class="novo-chamado col-md-6">
            <a class="btn btn-warning" href="<?php echo base_url("manutencao"); ?>" role="button">
                <i class="fa fa-arrow-circle-o-left"></i> Voltar
            </a>
            <button class="btn btn-primary" type="submit" href="#mdlCriarManutencao" 
                    data-toggle="modal" data-target="#mdlCriarManutencao" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Nova manutenção
            </button>
        </div>
        
        <!-- pesquisa  -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("manutencao/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por equipamento, patrimônio ou fornecedor...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div>
    
    <!-- resultado da pesquisa  -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo "Busca por: <strong>".$palavra."</strong>. - Resultado: ".$total." ocorrências"; ?>
            </div>
        </div>
    </div>
    
    <!-- tab panel -->
    <div class="row">
        <div class="col-md-12">
            
            <!-- com defeito -->
            <?php if (isset($defeitos)) {?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Aguardando envio para assitência técnica</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Equipamento</th>
                                <th>Defeito</th>
                                <th>Fornecedor</th>
                                <th>Data defeito</th>                           
                                <th>Patrimônio</th>
                                <th>Setor</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas-->
                            <?php foreach ($defeitos as $defeito) { ?>
                            <tr>
                                <td><?php echo $defeito->getEquipamento(); ?></td>
                                <td title="<?php echo $defeito->getDefeito(); ?>">
                                    <?php echo $defeito->reduzirDescricao($defeito->getDefeito()); ?></td>
                                <td><?php echo $defeito->getFornecedor(); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($defeito->getData_defeito())); ?></td>
                                <td><?php echo $defeito->getPatrimonio(); ?></td>
                                <td><?php echo $setor->buscaId($defeito->getIdsetor())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Enviar manutenção" role="button" href="#mdlEnviarManutencao" 
                                       data-toggle="modal" data-target="#mdlEnviarManutencao"
                                       data-id="<?php echo $defeito->getIdmanutencao(); ?>"
                                       onclick="enviarManutencao(this)">
                                        <i class="fa fa-share-square-o" ></i>
                                    </a>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarManutencao" 
                                       data-toggle="modal" data-target="#mdlEditarManutencao"
                                       data-id="<?php echo $defeito->getIdmanutencao(); ?>"
                                       onclick="editarManutencao(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a> 
                                    <a href="#" title="Visualizar" role="button" href="#mdlVisualizarManutencao" 
                                       data-toggle="modal" data-target="#mdlVisualizarManutencao"
                                       data-id="<?php echo $defeito->getIdmanutencao(); ?>"
                                       onclick="visualizarManutencao(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a> 
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                       data-toggle="modal" data-target="#mdlRemoverManutencao"
                                       data-id="<?php echo $defeito->getIdmanutencao(); ?>"
                                       onclick="removerManutencao(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } //foreach manutencaos?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>

            <!-- em manutencao -->
            <?php if (isset($manutencoes)) {?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Manutenções em andamento</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Equipamento</th>
                                <th>Defeito</th>
                                <th>Fornecedor</th>
                                <th>Data defeito</th>
                                <th>Data de envio</th>                            
                                <th>Patrimônio</th>
                                <th>Setor</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas-->
                            <?php foreach ($manutencoes as $manutencao) { ?>
                            <tr>
                                <td><?php echo $manutencao->getEquipamento(); ?></td>
                                <td title="<?php echo $manutencao->getDefeito(); ?>">
                                    <?php echo $manutencao->reduzirDescricao($manutencao->getDefeito()); ?></td>
                                <td><?php echo $manutencao->getFornecedor(); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($manutencao->getData_defeito())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($manutencao->getData_entrega())) ; ?></td>
                                <td><?php echo $manutencao->getPatrimonio(); ?></td>
                                <td><?php echo $setor->buscaId($manutencao->getIdsetor())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Retorno de manutenção" role="button" href="#mdlRetornoManutencao" 
                                       data-toggle="modal" data-target="#mdlRetornoManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="retornoManutencao(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <a href="#" title="Não teve conserto" role="button" href="#mdlSemConsertoManutencao" 
                                       data-toggle="modal" data-target="#mdlSemConsertoManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="semconsertoManutencao(this)">
                                        <i class="fa fa-window-close-o" ></i>
                                    </a>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarManutencao" 
                                       data-toggle="modal" data-target="#mdlEditarManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="editarManutencao(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a> 
                                    <a href="#" title="Visualizar" role="button" href="#mdlVisualizarManutencao" 
                                       data-toggle="modal" data-target="#mdlVisualizarManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="visualizarManutencao(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                       data-toggle="modal" data-target="#mdlRemoverManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="removerManutencao(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } //foreach manutencaos?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }?>                        

            <!-- consertadas -->
            <?php if (isset($fechadas)) {?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Manutenções fechadas</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Equipamento</th>
                                <th>Defeito</th>
                                <th>Data defeito</th>
                                <th>Data de envio</th> 
                                <th>Data do retorno</th>
                                <th>Garantia</th>
                                <th>Patrimônio</th>
                                <th>Setor</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas-->
                            <?php foreach ($fechadas as $fechada) { ?>
                            <tr>
                                <td><?php echo $fechada->getEquipamento(); ?></td>
                                <td title="<?php echo $fechada->getDefeito(); ?>">
                                    <?php echo $fechada->reduzirDescricao($fechada->getDefeito()); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($fechada->getData_defeito())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($fechada->getData_entrega())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($fechada->getData_retorno())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($fechada->getData_garantia())); ?></td>
                                <td><?php echo $fechada->getPatrimonio(); ?></td>
                                <td><?php echo $setor->buscaId($fechada->getIdsetor())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Visualizar" role="button" href="#mdlVisualizarManutencao" 
                                       data-toggle="modal" data-target="#mdlVisualizarManutencao"
                                       data-id="<?php echo $fechada->getIdmanutencao(); ?>"
                                       onclick="visualizarManutencao(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>
                                    <?php if ($this->session->userdata("nivel") == 0){ //somenta admin ?>
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                       data-toggle="modal" data-target="#mdlRemoverManutencao"
                                       data-id="<?php echo $fechada->getIdmanutencao(); ?>"
                                       onclick="removerManutencao(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php } //foreach manutencaos?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>

            <!-- em garantia -->
            <?php if (isset($garantias)) {?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Manutenções em garantia</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Equipamento</th>
                                <th>Defeito</th>
                                <th>Data defeito</th>
                                <th>Data de envio</th> 
                                <th>Data do retorno</th>
                                <th>Garantia</th>
                                <th>Patrimônio</th>
                                <th>Unidade</th>
                                <th>Setor</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas-->
                            <?php foreach ($garantias as $garantia) { ?>
                            <tr>
                                <td><?php echo $garantia->getEquipamento(); ?></td>
                                <td title="<?php echo $garantia->getDefeito(); ?>">
                                    <?php echo $garantia->reduzirDescricao($garantia->getDefeito()); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($garantia->getData_defeito())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($garantia->getData_entrega())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($garantia->getData_retorno())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($garantia->getData_garantia())); ?></td>
                                <td><?php echo $garantia->getPatrimonio(); ?></td>
                                <td><?php echo $unidade->buscaId($garantia->getIdunidade())->getNome(); ?></td>
                                <td><?php echo $setor->buscaId($garantia->getIdsetor())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Apresentou defeito" role="button" href="#mdlDefeitoManutencao" 
                                       data-toggle="modal" data-target="#mdlDefeitoManutencao"
                                       data-id="<?php echo $garantia->getIdmanutencao(); ?>"
                                       onclick="defeitoManutencao(this)">
                                        <i class="fa fa-wrench" ></i>
                                    </a> 
                                    <a href="#" title="Visualizar" role="button" href="#mdlVisualizarManutencao" 
                                       data-toggle="modal" data-target="#mdlVisualizarManutencao"
                                       data-id="<?php echo $garantia->getIdmanutencao(); ?>"
                                       onclick="visualizarManutencao(this)">
                                        <i class="fa fa fa-search-plus" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                       data-toggle="modal" data-target="#mdlRemoverManutencao"
                                       data-id="<?php echo $garantia->getIdmanutencao(); ?>"
                                       onclick="removerManutencao(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } //foreach manutencaos?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }?>
            
            <!-- sem conserto -->
            <?php if (isset($semconserto)) {?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Não houve conserto do equipamento</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Equipamento</th>
                                <th>Defeito</th>
                                <th>Motivo</th>
                                <th>Data defeito</th>
                                <th>Data de envio</th>                            
                                <th>Patrimônio</th>
                                <th>Unidade</th>
                                <th>Setor</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas-->
                            <?php foreach ($semconserto as $manutencao) { ?>
                            <tr>
                                <td><?php echo $manutencao->getEquipamento(); ?></td>
                                <td title="<?php echo $manutencao->getDefeito(); ?>">
                                    <?php echo $manutencao->reduzirDescricao($manutencao->getDefeito()); ?></td>
                                <td title="<?php echo $manutencao->getMotivo(); ?>">
                                    <?php echo $manutencao->reduzirDescricao($manutencao->getMotivo()); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($manutencao->getData_defeito())); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($manutencao->getData_entrega())) ; ?></td>
                                <td><?php echo $manutencao->getPatrimonio(); ?></td>
                                <td><?php echo $unidade->buscaId($manutencao->getIdunidade())->getNome(); ?></td>
                                <td><?php echo $setor->buscaId($manutencao->getIdsetor())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Visualizar" role="button" href="#mdlVisualizarManutencao" 
                                       data-toggle="modal" data-target="#mdlVisualizarManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="visualizarManutencao(this)">
                                        <i class="fa fa fa-search-plus" ></i>
                                    </a> 
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                       data-toggle="modal" data-target="#mdlRemoverManutencao"
                                       data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                       onclick="removerManutencao(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } //foreach manutencaos?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>
</div>                        