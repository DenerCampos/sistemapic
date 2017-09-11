<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
                <!-- em aberto -->
                <?php if (isset($abertas)) { ?>
                <div class="panel panel-danger" id="chamado-aberto">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chamados em aberto</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Usuário</th>
                                    <th>Problema</th>
                                    <th>Data abertura</th>
                                    <th>Descrição</th>
                                    <th>Estado</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($abertas as $aberta) { ?>
                                <tr>
                                    <td><?php echo $aberta->getIdocorrencia(); ?></td>
                                    <td><?php echo $aberta->getUsuario(); ?></td>
                                    <td><?php echo $problema->buscaId($aberta->getIdproblema())->getNome(); ?></td>
                                    <td><?php echo date("d/m/Y - H:i", strtotime($aberta->getData_abertura())); ?></td>
                                    <td title="<?php echo $aberta->getDescricao(); ?>">
                                        <?php echo $aberta->reduzirDescricao($aberta->getDescricao()); ?>
                                    </td>
                                    <td><?php echo $estado->buscaId($aberta->getIdocorrencia_estado())->getNome(); ?></td>
                                    <td class="text-right opcoes">
                                        <a title="Atender" role="button" href="#mdlAtenderChamado" 
                                           data-toggle="modal" data-target="#mdlAtenderChamado"
                                           data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                           onclick="atenderChamado(this)">
                                           <i class="fa fa-sign-in" ></i>
                                        </a>
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
                                        <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                           data-toggle="modal" data-target="#mdlRemoverChamado"
                                           data-id="<?php echo $aberta->getIdocorrencia(); ?>"
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