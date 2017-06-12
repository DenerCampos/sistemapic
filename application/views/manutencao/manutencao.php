<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                <?php } else { //isset manutencaos?>
                <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Não há <strong>equipamentos</strong> em manutenção.
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