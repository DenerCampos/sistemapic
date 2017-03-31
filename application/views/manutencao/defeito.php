<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                                    <td title="<?php echo $defeito->getDefeito(); ?>">
                                        <?php echo $defeito->reduzirDescricao($defeito->getDefeito()); ?></td>
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