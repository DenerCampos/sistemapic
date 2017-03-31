<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- manutencaos  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarManutencao" 
                    data-toggle="modal" data-target="#mdlCriarManutencao" role="button">
                Nova manutenção
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("manutencao/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por equipamento...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>
    <!-- tab panel -->
    <div class="row">
        <div class="col-md-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?php if((isset($aba)) && ($aba == "defeito")) {echo "active";} if (!isset($aba)) {echo "active";} ?>" role="presentation">
                        <a href="#comdefeito" id="aberto-tab" role="tab" data-toggle="tab" aria-controls="comdefeito"
                           aria-expanded="true">
                            Com defeito
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "manutencao")) {echo "active";} ?>" role="presentation">
                        <a href="#emmanutencao" id="aberto-tab" role="tab" data-toggle="tab" aria-controls="emmanutencao"
                           aria-expanded="true">
                            Em manutenção
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "conserto")) {echo "active";} ?>" role="presentation">
                        <a href="#consertadas" id="atendimento-tab" role="tab" data-toggle="tab" aria-controls="consertadas"
                           aria-expanded="true">
                            Consertadas
                        </a>
                    </li>
                    <li class="<?php if((isset($aba)) && ($aba == "garantia")) {echo "active";} ?>" role="presentation">
                        <a href="#emgarantia" id="atendimento-tab" role="tab" data-toggle="tab" aria-controls="emgarantia"
                           aria-expanded="true">
                            Em garantia
                        </a>
                    </li>
                </ul>
                <!-- com defeito -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane <?php if((isset($aba)) && ($aba == "defeito")) {echo "active";} if (!isset($aba)) {echo "active";} ?> " id="comdefeito">
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
                                            <th>Data defeito</th>                           
                                            <th>Patrimônio</th>
                                            <th>Unidade</th>
                                            <th>Setor</th>
                                            <th class="text-right">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Todas-->
                                        <?php foreach ($defeitos as $defeito) { ?>
                                        <tr>
                                            <td><?php echo $defeito->getEquipamento(); ?></td>
                                            <td><?php echo $defeito->getDefeito(); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($defeito->getData_defeito())); ?></td>
                                            <td><?php echo $defeito->getPatrimonio(); ?></td>
                                            <td><?php echo $unidade->buscaId($defeito->getIdunidade())->getNome(); ?></td>
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
                        <?php } else { //isset manutencaos?>
                        <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Não há <strong>equipamentos</strong> para manutenção.
                        </div>
                        <?php }?>
                    </div>
                
                    <!-- em manutencao -->
                    <div role="tabpanel" class="tab-pane <?php if((isset($aba)) && ($aba == "manutencao")) {echo "active";} ?>" id="emmanutencao">
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
                                        <?php foreach ($manutencoes as $manutencao) { ?>
                                        <tr>
                                            <td><?php echo $manutencao->getEquipamento(); ?></td>
                                            <td><?php echo $manutencao->getDefeito(); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($manutencao->getData_defeito())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($manutencao->getData_entrega())) ; ?></td>
                                            <td><?php echo $manutencao->getPatrimonio(); ?></td>
                                            <td><?php echo $unidade->buscaId($manutencao->getIdunidade())->getNome(); ?></td>
                                            <td><?php echo $setor->buscaId($manutencao->getIdsetor())->getNome(); ?></td>
                                            <td class="text-right opcoes">
                                                <a href="#" title="Retorno de manutenção" role="button" href="#mdlRetornoManutencao" 
                                                   data-toggle="modal" data-target="#mdlRetornoManutencao"
                                                   data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                                   onclick="retornoManutencao(this)">
                                                    <i class="fa fa-check-square-o" ></i>
                                                </a>
                                                <a href="#" title="Editar" role="button" href="#mdlEditarManutencao" 
                                                   data-toggle="modal" data-target="#mdlEditarManutencao"
                                                   data-id="<?php echo $manutencao->getIdmanutencao(); ?>"
                                                   onclick="editarManutencao(this)">
                                                    <i class="fa fa-pencil-square-o" ></i>
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
                        <?php } else { //isset manutencaos?>
                        <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Não há <strong>equipamentos</strong> em manutenção.
                        </div>
                        <?php }?>
                    </div>
                    
                    <!-- consertadas -->
                    <div role="tabpanel" class="tab-pane <?php if((isset($aba)) && ($aba == "conserto")) {echo "active";} ?>" id="consertadas">
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
                                            <th>Unidade</th>
                                            <th>Setor</th>
                                            <th class="text-right">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Todas-->
                                        <?php foreach ($fechadas as $fechada) { ?>
                                        <tr>
                                            <td><?php echo $fechada->getEquipamento(); ?></td>
                                            <td><?php echo $fechada->getDefeito(); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($fechada->getData_defeito())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($fechada->getData_entrega())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($fechada->getData_retorno())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($fechada->getData_garantia())); ?></td>
                                            <td><?php echo $fechada->getPatrimonio(); ?></td>
                                            <td><?php echo $unidade->buscaId($fechada->getIdunidade())->getNome(); ?></td>
                                            <td><?php echo $setor->buscaId($fechada->getIdsetor())->getNome(); ?></td>
                                            <td class="text-right opcoes">
                                                <a href="#" title="Editar" role="button" href="#mdlEditarManutencao" 
                                                   data-toggle="modal" data-target="#mdlEditarManutencao"
                                                   data-id="<?php echo $fechada->getIdmanutencao(); ?>"
                                                   onclick="editarManutencao(this)">
                                                    <i class="fa fa-pencil-square-o" ></i>
                                                </a>   
                                                <a href="#" title="Remover" role="button" href="#mdlRemoverManutencao" 
                                                   data-toggle="modal" data-target="#mdlRemoverManutencao"
                                                   data-id="<?php echo $fechada->getIdmanutencao(); ?>"
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
                        <?php } else { //isset manutencaos?>
                        <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Não há <strong>equipamentos</strong> consertados.
                        </div>
                        <?php }?>
                    </div> 
                    
                    <!-- em garantia -->
                    <div role="tabpanel" class="tab-pane <?php if((isset($aba)) && ($aba == "garantia")) {echo "active";} ?>" id="emgarantia">
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
                                            <td><?php echo $garantia->getDefeito(); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($garantia->getData_defeito())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($garantia->getData_entrega())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($garantia->getData_retorno())); ?></td>
                                            <td><?php echo date("d/m/Y", strtotime($garantia->getData_garantia())); ?></td>
                                            <td><?php echo $garantia->getPatrimonio(); ?></td>
                                            <td><?php echo $unidade->buscaId($garantia->getIdunidade())->getNome(); ?></td>
                                            <td><?php echo $setor->buscaId($garantia->getIdsetor())->getNome(); ?></td>
                                            <td class="text-right opcoes">
                                                <a href="#" title="Defeito" role="button" href="#mdlDefeitoManutencao" 
                                                   data-toggle="modal" data-target="#mdlDefeitoManutencao"
                                                   data-id="<?php echo $garantia->getIdmanutencao(); ?>"
                                                   onclick="defeitoManutencao(this)">
                                                    <i class="fa fa-wrench" ></i>
                                                </a> 
                                                <a href="#" title="Editar" role="button" href="#mdlEditarManutencao" 
                                                   data-toggle="modal" data-target="#mdlEditarManutencao"
                                                   data-id="<?php echo $garantia->getIdmanutencao(); ?>"
                                                   onclick="editarManutencao(this)">
                                                    <i class="fa fa-pencil-square-o" ></i>
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
                        <?php } else { //isset manutencaos?>
                        <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Não há <strong>equipamentos</strong> em garantia.
                        </div>
                        <?php }?>
                    </div>

                </div> <!--tab-content-->
            </div>  <!--tab-panel-->
        </div>
    </div><!--row-->      
</div>