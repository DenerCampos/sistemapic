<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
                <!-- em aberto tecnico-->
                <?php if (isset($abertas)) { ?>
                    <div class="panel panel-danger" id="chamado-atualiza">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Chamados em aberto</strong><small> seus e da sua área de atendimento.</small></h3>
                        </div>
                        <!-- painel -->
                        <div class="panel-body table-responsive">
                            <!-- tabela -->
                            <table class="table table-hover table-responsive">
                                <!-- cabeçalho tabela -->
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Aberto em</th>
                                        <th>Usuário</th>
                                        <th>Problema</th>
                                        <th>Descrição</th>
                                        <th>Área</th>
                                        <th>Unidade</th>
                                        <th class="text-right">Opções</th>
                                    </tr>
                                </thead>
                                <!-- corpo tabela -->
                                <tbody>
                                    <?php foreach ($abertas as $aberta) { ?>
                                    <tr>
                                        <td>
                                            <?php if (strtotime(date("Y-m-d H:i:s")) < strtotime($aberta->getData_sla())) {?>
                                               <i class="fa fa-clock-o sla-ok" aria-hidden="true" title="Dentro do prazo até: <?php echo date("d/m - H:i", strtotime($aberta->getData_sla()))?>"></i>
                                            <?php } else { ?> 
                                                <i class="fa fa-clock-o sla-alert" aria-hidden="true" title="Fora do prazo, venceu: <?php echo date("d/m - H:i", strtotime($aberta->getData_sla()))?>"></i>
                                            <?php } ?>
                                            <?php echo $aberta->getIdocorrencia(); ?>
                                        </td>
                                        <td><?php echo date("d/m/Y - H:i", strtotime($aberta->getData_abertura())); ?></td>
                                        <td><?php echo $aberta->getUsuario(); ?></td>
                                        <td><?php echo $problema->buscaId($aberta->getIdproblema())->getNome(); ?></td>
                                        <td title="<?php echo $aberta->getDescricao(); ?>">
                                            <?php echo $aberta->reduzirDescricao($aberta->getDescricao()); ?>
                                        </td>
                                        <td><?php echo $area->buscaId($aberta->getIdarea())->getNome(); ?></td>
                                        <td><?php echo $unidade->buscaId($aberta->getIdunidade())->getNome(); ?></td>
                                        <td class="text-right opcoes">
                                            <?php if ($this->session->userdata("area") == $aberta->getIdarea()) { //tecnico não atende area diferente ?>
                                            <a title="Atender" role="button" href="#mdlAtenderChamado" 
                                               data-toggle="modal" data-target="#mdlAtenderChamado"
                                               data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                               onclick="atenderChamado(this)">
                                               <i class="fa fa-sign-in" ></i>
                                            </a>
                                            <?php } ?>
                                            <?php if ($this->session->userdata("id") == $aberta->getUsuario_abre()) { //tecnico não atende area diferente ?>
                                            <a title="Editar" role="button" href="#mdlEditarChamadoAberto" 
                                               data-toggle="modal" data-target="#mdlEditarChamadoAberto"
                                               data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                               onclick="editarChamadoAberto(this)">
                                                <i class="fa fa-pencil-square-o" ></i>
                                            </a>
                                            <?php } ?>
                                            <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                               data-toggle="modal" data-target="#mdlImprimirChamado"
                                               data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                               onclick="imprimirChamado(this)">
                                                <i class="fa fa-print" ></i>
                                            </a>
                                            <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                               data-toggle="modal" data-target="#mdlVisualizarChamado"
                                               data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                               onclick="visualizarChamado(this)">
                                                <i class="fa fa-search-plus" ></i>
                                            </a>
                                            <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?> 
                                            <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                                data-toggle="modal" data-target="#mdlRemoverChamado"
                                                data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                                onclick="removerChamado(this)">
                                                 <i class="fa fa-remove" ></i>
                                             </a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else {?>
                <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Não há <strong>chamados</strong> em aberto.
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