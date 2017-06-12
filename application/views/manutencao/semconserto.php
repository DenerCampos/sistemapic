<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                <?php } else { //isset manutencaos?>
                <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Não há <strong>equipamentos</strong> que não obteve conserto.
                </div>
                <?php }?>
            </div>  <!--tab-panel-->
        </div>
    </div><!--row-->
    <div class="row">
        <div class="pagina-direita">
            <?php if (isset($paginas)) {?>
            <nav aria-label="Page navigation">
                <?php echo $paginas; ?>
            </nav>
            <?php }?>
        </div>
    </div><!--row-->  
</div>