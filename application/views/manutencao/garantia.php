<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>               
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