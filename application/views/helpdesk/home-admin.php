<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Usuario ADM-->
<div class="menu-chamado col-md-12">
    <div class="row"> <!-- row -->
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarChamado" 
                    data-toggle="modal" data-target="#mdlCriarChamado" role="button">
                Novo Chamado
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Busca por número, problema ou descrição...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Buscar!</button>
                </span>
            </div>
        </div>
    </div><!-- fim row -->
    <!-- tab panel -->
    <div class="row">
        <div class="col-md-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active" role="presentation">
                        <a href="#aberto" id="aberto-tab" role="tab" data-toggle="tab" aria-controls="aberto"
                           aria-expanded="true">
                            Em aberto
                        </a>
                    </li>
                    <li class="" role="presentation">
                        <a href="#atendimento" id="atendimento-tab" role="tab" data-toggle="tab" aria-controls="atendimento"
                           aria-expanded="true">
                            Em atendimento
                        </a>
                    </li>
                    <li class="" role="presentation">
                        <a href="#fechado" id="fechado-tab" role="tab" data-toggle="tab" aria-controls="fechado"
                           aria-expanded="true">
                            Fechado
                        </a>
                    </li>
                </ul>
                <!-- em aberto -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="aberto">
                        <?php if (isset($abertas)) { ?>
                        <div class="panel panel-danger">
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
                                                <a title="Atender" role="button" href="#mdlAtenderChamado" 
                                                   data-toggle="modal" data-target="#mdlAtenderChamado"
                                                   data-id="<?php echo $aberta->getIdocorrencia(); ?>"
                                                   onclick="atenderChamado(this)">
                                                   <i class="fa fa-sign-in" ></i>
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
                    </div>
                    
                    <!-- em atendimento -->
                    <div role="tabpanel" class="tab-pane" id="atendimento">
                        <?php if (isset($atendimentos)) { ?>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chamados em atendimento</h3>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Usuário</th>
                                            <th>Problema</th>
                                            <th>Data abertura</th>
                                            <th>Data atendimento</th>
                                            <th>Descrição</th>
                                            <th>Técnico</th>
                                            <th>Estado</th>
                                            <th class="text-right">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($atendimentos as $atendimento) { ?>
                                        <tr>
                                            <td><?php echo $atendimento->getIdocorrencia(); ?></td>
                                            <td><?php echo $atendimento->getUsuario(); ?></td>
                                            <td><?php echo $problema->buscaId($atendimento->getIdproblema())->getNome(); ?></td>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($atendimento->getData_abertura())); ?></td>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($atendimento->getData_alteracao())); ?></td>
                                            <td title="<?php echo $atendimento->getDescricao(); ?>">
                                                <?php echo $atendimento->reduzirDescricao($atendimento->getDescricao()); ?>
                                            </td>
                                            <td><?php echo $usuario->buscaId($atendimento->getUsuario_atende())->getNome(); ?></td>
                                            <td><?php echo $estado->buscaId($atendimento->getIdocorrencia_estado())->getNome();; ?></td>
                                            <td class="text-right opcoes">
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
                                                <a title="Editar" role="button" href="#mdlEditarChamado" 
                                                   data-toggle="modal" data-target="#mdlEditarChamado"
                                                   data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
                                                   onclick="editarChamado(this)">
                                                    <i class="fa fa-pencil-square-o" ></i>
                                                </a>
                                                <a title="Fechar" role="button" href="#mdlFecharChamado" 
                                                   data-toggle="modal" data-target="#mdlFecharChamado"
                                                   data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
                                                   onclick="fecharChamado(this)">
                                                    <i class="fa fa-check-square-o" ></i>
                                                </a>
                                                <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                                   data-toggle="modal" data-target="#mdlRemoverChamado"
                                                   data-id="<?php echo $atendimento->getIdocorrencia(); ?>"
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
                            Não há <strong>chamados</strong> em atendimento.
                        </div>
                        <?php }?>
                    </div>
                    
                    <!-- fechados -->
                    <div role="tabpanel" class="tab-pane" id="fechado">
                        <?php if (isset($fechadas)) { ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chamados fechados</h3>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Usuário</th>
                                            <th>Problema</th>
                                            <th>Data abertura</th>
                                            <th>Data fechamento</th>
                                            <th>Descrição</th>
                                            <th>Técnico</th>
                                            <th>Estado</th>
                                            <th class="text-right">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($fechadas as $fechada) { ?>
                                        <tr>
                                            <td><?php echo $fechada->getIdocorrencia(); ?></td>
                                            <td><?php echo $fechada->getUsuario(); ?></td>
                                            <td><?php echo $problema->buscaId($fechada->getIdproblema())->getNome(); ?></td>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($fechada->getData_abertura())); ?></td>
                                            <td><?php echo date("d/m/Y - H:i", strtotime($fechada->getData_fechamento())); ?></td>
                                            <td title="<?php echo $fechada->getDescricao(); ?>">
                                                <?php echo $fechada->reduzirDescricao($fechada->getDescricao()); ?>
                                            </td>
                                            <td><?php echo $usuario->buscaId($fechada->getUsuario_fecha())->getNome(); ?></td>
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
                    </div>
                </div> <!--tab-content-->
            </div>  <!--tab-panel-->
        </div>
    </div><!--row-->
    <nav aria-label="Page navigation">
        <?php echo $paginas; ?>
    </nav> 
</div>