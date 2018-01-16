<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
                <!-- em atendimento -->
                <?php if (isset($atendimentos)) { ?>
                <!-- painel -->
                <div class="panel panel-info" id="chamado-atualiza">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Chamados em atendimento</strong></h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <!-- tabela -->
                        <table class="table table-hover">
                            <!-- cabeçalho tabela -->
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Aberto em</th>
                                    <th>Última atualização</th>
                                    <th>Usuário</th>
                                    <th>Problema</th>
                                    <th>Descrição</th>
                                    <th>Técnico</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <!-- corpo tabela -->
                            <tbody>
                                <?php foreach ($atendimentos as $atendimento) { ?>
                                <tr>
                                    <td><?php echo $atendimento->getIdocorrencia(); ?></td>
                                    <td><?php echo date("d/m/Y - H:i", strtotime($atendimento->getData_abertura())); ?></td>
                                    <td><?php echo date("d/m/Y - H:i", strtotime($atendimento->getData_alteracao())); ?></td>
                                    <td><?php echo $atendimento->getUsuario(); ?></td>
                                    <td><?php echo $problema->buscaId($atendimento->getIdproblema())->getNome(); ?></td>                                    
                                    <td title="<?php echo $atendimento->getDescricao(); ?>">
                                        <?php echo $atendimento->reduzirDescricao($atendimento->getDescricao()); ?>
                                    </td>
                                    <td><?php echo $usuario->buscaId($atendimento->getUsuario_atende())->getNome(); ?></td>
                                    <td class="text-right opcoes">
                                        <a title="Editar" role="button" href="#mdlEditarChamado" 
                                           data-toggle="modal" data-target="#mdlEditarChamado"
                                           data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
                                           onclick="editarChamado(this)">
                                            <i class="fa fa-pencil-square-o" ></i>
                                        </a>
                                        <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                           data-toggle="modal" data-target="#mdlImprimirChamado"
                                           data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
                                           onclick="imprimirChamado(this)">
                                            <i class="fa fa-print" ></i>
                                        </a>
                                        <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                           data-toggle="modal" data-target="#mdlVisualizarChamado"
                                           data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
                                           onclick="visualizarChamado(this)">
                                            <i class="fa fa-search-plus" ></i>
                                        </a>
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
                    Não há <strong>chamados</strong> em atendimento.
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