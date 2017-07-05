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
                Novo Chamado
            </button>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">            
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("ocorrencia/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por número, problema ou descrição...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div><!-- fim row -->
    
    
    
    <?php if (isset($numeros)) { ?>
    <div class="row"> <!-- Numero chamado -->
        <div class="col-md-12">                    
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Pesquisa de chamados por número: <strong><?php echo $palavra; ?></strong></h3>
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
                            <?php foreach ($numeros as $numero) { ?>
                            <tr>
                                <td><?php echo $numero->getIdocorrencia(); ?></td>
                                <td><?php echo $numero->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($numero->getIdproblema())->getNome(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($numero->getData_abertura())); ?></td>
                                <td title="<?php echo $numero->getDescricao(); ?>">
                                    <?php echo $numero->reduzirDescricao($numero->getDescricao()); ?>
                                </td>
                                <td><?php echo $estado->buscaId($numero->getIdocorrencia_estado())->getNome(); ?></td>
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
                                    <?php if ($this->session->userdata("nivel") == 0){ ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $numero->getIdocorrencia(); ?>"
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
        </div>
    </div>
    <?php }?>
    
    <?php if (isset($problemas)) { ?>
    <div class="row"> <!-- Problema chamado -->
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Pesquisa de chamados por problema: <strong><?php echo $palavra; ?></strong></h3>
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
                            <?php foreach ($problemas as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getIdocorrencia(); ?></td>
                                <td><?php echo $resultado->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($resultado->getIdproblema())->getNome(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($resultado->getData_abertura())); ?></td>
                                <td title="<?php echo $resultado->getDescricao(); ?>">
                                    <?php echo $resultado->reduzirDescricao($resultado->getDescricao()); ?>
                                </td>
                                <td><?php echo $estado->buscaId($resultado->getIdocorrencia_estado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                       data-toggle="modal" data-target="#mdlImprimirChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
                                       onclick="imprimirChamado(this)">
                                        <i class="fa fa-print" ></i>
                                    </a>
                                    <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                       data-toggle="modal" data-target="#mdlVisualizarChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
                                       onclick="visualizarChamado(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>                                                 
                                    <?php if ($this->session->userdata("nivel") == 0){ ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
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
        </div>
    </div>
    <?php }?>
    
    <?php if (isset($descricao)) { ?>
    <div class="row"> <!-- Descrição chamado -->
        <div class="col-md-12">            
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Pesquisa de chamados por descrição: <strong><?php echo $palavra; ?></strong></h3>
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
                            <?php foreach ($descricao as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getIdocorrencia(); ?></td>
                                <td><?php echo $resultado->getUsuario(); ?></td>
                                <td><?php echo $problema->buscaId($resultado->getIdproblema())->getNome(); ?></td>
                                <td><?php echo date("d/m/Y - H:i", strtotime($resultado->getData_abertura())); ?></td>
                                <td title="<?php echo $resultado->getDescricao(); ?>">
                                    <?php echo $resultado->reduzirDescricao($resultado->getDescricao()); ?>
                                </td>
                                <td><?php echo $estado->buscaId($resultado->getIdocorrencia_estado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a title="Imprimir" role="button" href="#mdlImprimirChamado" 
                                       data-toggle="modal" data-target="#mdlImprimirChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
                                       onclick="imprimirChamado(this)">
                                        <i class="fa fa-print" ></i>
                                    </a>
                                    <a title="Visualizar" role="button" href="#mdlVisualizarChamado" 
                                       data-toggle="modal" data-target="#mdlVisualizarChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
                                       onclick="visualizarChamado(this)">
                                        <i class="fa fa-search-plus" ></i>
                                    </a>
                                    <?php if ($this->session->userdata("nivel") == 0){ ?>
                                    <a title="Remover" role="button" href="#mdlRemoverChamado" 
                                       data-toggle="modal" data-target="#mdlRemoverChamado"
                                       data-id="<?php echo $resultado->getIdocorrencia(); ?>"
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
        </div>
    </div>
    <?php }?>
    <?php if (!isset($numeros) && !isset($problemas) && !isset($descricao)) { ?>
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

  
            