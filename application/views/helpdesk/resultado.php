<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--Resultados-->
<div class="menu-chamado col-md-12">
    
    <div class="row"> <!-- row -->
        <!-- novo -->
        <div class="novo-chamado col-md-6">
            <a class="btn btn-warning" href="<?php echo base_url("ocorrencia"); ?>" role="button">
                <i class="fa fa-arrow-circle-o-left"></i> Voltar
            </a>
            <button class="btn btn-primary" type="submit" href="#mdlCriarChamado" 
                    data-toggle="modal" data-target="#mdlCriarChamado" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo Chamado
            </button>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">            
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("ocorrencia/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por número, problema, descrição ou comentários...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div><!-- fim row -->
    
    <!-- resultado da pesquisa  -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo "Busca por: <strong>".$palavra."</strong>. - Resultado: ".$total." ocorrências"; ?>
            </div>
        </div>
    </div>
    
    <!-- tab panel -->
    <div class="row">
        <div class="col-md-12">
            
            <!-- Aberto -->
            <?php if (!empty($abertos)) {?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Chamados em aberto</strong></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
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
                        <tbody>
                            <?php foreach ($abertos as $numero) { ?>
                            <tr>
                                <td><?php echo $numero->getIdocorrencia(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_abertura())); ?></td>
                                <td><?php echo $numero->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($numero->getIdproblema())->getNome(); ?></td>
                                <td title="<?php echo $numero->getDescricao(); ?>">
                                    <?php echo $numero->reduzirDescricao($numero->getDescricao()); ?>
                                </td>
                                <td><?php echo $area->buscaId($numero->getIdarea())->getNome(); ?></td>
                                <td><?php echo $unidade->buscaId($numero->getIdunidade())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    
                                    <!-- Tecnico e admin -->
                                    <?php if (($this->session->userdata('nivel') == 0) || ($numero->getIdarea() == $this->session->userdata("area"))) { ?>
                                    <a title="Atender" role="button" href="#mdlAtenderChamado" 
                                       data-toggle="modal" data-target="#mdlAtenderChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="atenderChamado(this)">
                                       <i class="fa fa-sign-in" ></i>
                                    </a>
                                    <?php } ?>
                                    
                                    <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                       data-toggle="modal" data-target="#mdlImprimirChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="imprimirChamado(this)">
                                        <i class="fa fa-print" ></i>
                                    </a>
                                    
                                    <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                       data-toggle="modal" data-target="#mdlVisualizarChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="visualizarChamado(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a> 
                                    
                                    <!-- Admin -->
                                    <?php if ($this->session->userdata('nivel') == 0) { ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="removerChamado(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            
            <!-- Em atendimento -->
            <?php if (!empty($atendimentos)) {?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Chamados em atendimento</strong></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Número</th>                                
                                <th>Aberto em</th>
                                <th>Última atualização</th>
                                <th>Usuário</th>
                                <th>Problema</th>
                                <th>Descrição</th>
                                <th>Técnico</th>
                                <th>Área</th>
                                <th class="text-right">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atendimentos as $numero) { ?>
                            <tr>
                                <td><?php echo $numero->getIdocorrencia(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_abertura())); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_alteracao())); ?></td>
                                <td><?php echo $numero->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($numero->getIdproblema())->getNome(); ?></td>
                                <td title="<?php echo $numero->getDescricao(); ?>">
                                    <?php echo $numero->reduzirDescricao($numero->getDescricao()); ?>
                                </td>
                                <td><?php echo $usuario->buscaId($numero->getUsuario_atende())->getNome(); ?></td>
                                <td><?php echo $area->buscaId($numero->getIdarea())->getNome(); ?></td>
                                
                                <td class="text-right opcoes">
                                    <a title="Editar" role="button" href="#mdlEditarChamado" 
                                       data-toggle="modal" data-target="#mdlEditarChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="editarChamado(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>
                                    <!-- Tecnico e admin -->
                                    <?php if ($this->session->userdata('nivel') != 2) { ?>
                                    <a title="Emcaminhar" role="button" href="#mdlEncaminharChamado" 
                                       data-toggle="modal" data-target="#mdlEncaminharChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="encaminharChamado(this)">
                                        <i class="fa fa-external-link" ></i>
                                    </a>
                                    <?php }?>
                                    <!-- Tecnico e admin  -->
                                    <?php if (($this->session->userdata('nivel') == 0) || ($numero->getUsuario_atende() == $this->session->userdata('id'))) { ?>
                                    <a title="Fechar" role="button" href="#mdlFecharChamado" 
                                       data-toggle="modal" data-target="#mdlFecharChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="fecharChamado(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } ?>
                                    <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                       data-toggle="modal" data-target="#mdlImprimirChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="imprimirChamado(this)">
                                        <i class="fa fa-print" ></i>
                                    </a>
                                    <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                       data-toggle="modal" data-target="#mdlVisualizarChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="visualizarChamado(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>  
                                    <?php if ($this->session->userdata('nivel') == 0) { ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="removerChamado(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            
            <!-- Fechado -->
            <?php if (!empty($fechados)) {?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Chamados fechados</strong></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
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
                                <th class="text-right">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fechados as $numero) { ?>
                            <tr>
                                <td><?php echo $numero->getIdocorrencia(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_abertura())); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_fechamento())); ?></td>
                                <td><?php echo $numero->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($numero->getIdproblema())->getNome(); ?></td>
                                <td title="<?php echo $numero->getDescricao(); ?>">
                                    <?php echo $numero->reduzirDescricao($numero->getDescricao()); ?>
                                </td>
                                <td><?php echo $usuario->buscaId($numero->getUsuario_fecha())->getNome(); ?></td>
                                <td><?php echo $area->buscaId($numero->getIdarea())->getNome(); ?></td>
                                <td class="text-right opcoes">                                    
                                    <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                       data-toggle="modal" data-target="#mdlImprimirChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="imprimirChamado(this)">
                                        <i class="fa fa-print" ></i>
                                    </a>
                                    <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                       data-toggle="modal" data-target="#mdlVisualizarChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="visualizarChamado(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>
                                    <?php if ($this->session->userdata('nivel') == 0) { ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
                                       onclick="removerChamado(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php } ?>                                                                       
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>    
    
    
    <?php if (!isset($abertos) && !isset($atendimentos) && !isset($fechados)) { ?>
    <div class="row"> <!-- Numero chamado -->
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Não há <strong>chamados</strong> pela busca <strong><?php echo $palavra; ?></strong>.
            </div>
        </div>
    </div>
    <?php }?>
    
</div>

  
            