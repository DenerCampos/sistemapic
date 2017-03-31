<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                                    <td title="<?php echo $fechada->getDefeito(); ?>">
                                        <?php echo $fechada->reduzirDescricao($fechada->getDefeito()); ?></td>
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