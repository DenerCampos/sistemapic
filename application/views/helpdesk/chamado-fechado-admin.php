<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
                <!-- fechados admin -->
                <?php if (isset($fechadas)) { ?>
                <!-- painel -->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Chamados fechados</strong></h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <!-- tabela -->
                        <table class="table table-hover">
                            <!-- cabeçalho tabela -->
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Aberto em</th>
                                    <th>Fechado em</th>
                                    <th>Usuário</th>
                                    <th>Problema</th>
                                    <th>Descrição</th>
                                    <th>Técnico</th>
                                    <th>Área</th>
                                    <th>Estado</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <!-- corpo tabela -->
                            <tbody>
                                <?php foreach ($fechadas as $fechada) { ?>
                                <tr>
                                    <td><?php echo $fechada->getIdocorrencia(); ?></td>
                                    <td><?php echo date("d/m/Y - H:i", strtotime($fechada->getData_abertura())); ?></td>
                                    <td><?php echo date("d/m/Y - H:i", strtotime($fechada->getData_fechamento())); ?></td>
                                    <td><?php echo $fechada->getUsuario(); ?></td>
                                    <td><?php echo $problema->buscaId($fechada->getIdproblema())->getNome(); ?></td>
                                    <td title="<?php echo $fechada->getDescricao(); ?>">
                                        <?php echo $fechada->reduzirDescricao($fechada->getDescricao()); ?>
                                    </td>
                                    <td><?php echo $usuario->buscaId($fechada->getUsuario_fecha())->getNome(); ?></td>
                                    <td><?php echo $area->buscaId($fechada->getIdarea())->getNome(); ?></td>
                                    <td><?php echo $estado->buscaId($fechada->getIdocorrencia_estado())->getNome(); ?></td>
                                    <td class="text-right opcoes">
                                        <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                           data-toggle="modal" data-target="#mdlImprimirChamado"
                                           data-id="<?php echo $fechada->getIdocorrencia(); ?>"
                                           onclick="imprimirChamado(this)">
                                            <i class="fa fa-print" ></i>
                                        </a>
                                        <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                           data-toggle="modal" data-target="#mdlVisualizarChamado"
                                           data-id="<?php echo $fechada->getIdocorrencia(); ?>"
                                           onclick="visualizarChamado(this)">
                                            <i class="fa fa-search-plus" ></i>
                                        </a>
                                        <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                           data-toggle="modal" data-target="#mdlRemoverChamado"
                                           data-id="<?php echo $fechada->getIdocorrencia(); ?>"
                                           onclick="removerChamado(this)">
                                            <i class="fa fa-remove" ></i>
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
                    Não há <strong>chamados</strong> fechados.
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