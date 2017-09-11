<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Resultados-->
<div class="menu-chamado col-md-12">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarPlantao" 
                    data-toggle="modal" data-target="#mdlCriarPlantao" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Criar novo relatório
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("plantao/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por data ou nome usuário...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div><!-- fim row -->
    <?php if (isset($data)) { ?>
    <div class="row"> <!-- data plantão -->
        <div class="col-md-12">                    
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Pesquisa de relatórios por data: <strong><?php echo $palavra; ?></strong></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Data emissão</th>
                                <th>Intervalo</th>
                                <th>Usuário</th>
                                <th>Chamados</th>
                                <th class="text-right">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $value) { ?>
                            <tr>
                                <td><?php echo $value->getIdrelatorio_plantao(); ?></td>
                                <td><?php echo date("d/m/Y - H:m", strtotime($value->getData()));?></td>
                                <td><?php echo date("d/m/Y", strtotime($value->getData_inicio()))." até ".date("d/m/Y", strtotime($value->getData_fim()));?></td>
                                <td><?php echo $value->getUsuario(); ?></td>
                                <td title="<?php echo $value->getOcorrencias(); ?>">
                                    <?php echo $value->reduzirDescricao($value->getOcorrencias()); ?>
                                </td> 
                                <td class="text-right opcoes">  
                                    <a title="Enviar email" role="button" href="#mdlEmailPlantao" 
                                        data-toggle="modal" data-target="#mdlEmailPlantao"
                                        data-id="<?php echo $value->getIdrelatorio_plantao(); ?>"
                                        onclick="EnviarEmailPlantao(this)">
                                        <i class="fa fa-envelope-o"></i>
                                    </a>
                                    <a title="Visualizar" role="button" 
                                       href="<?php echo base_url('document/relatorio/')."/".$value->getIdrelatorio_plantao().".pdf";?>"
                                       target="_blank">
                                        <i class="fa fa-search-plus" ></i>
                                    </a> 
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
    
    <?php if (isset($usuario)) { ?>
    <div class="row"> <!-- usuario plantão -->
        <div class="col-md-12">                    
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Pesquisa de relatórios por usuário: <strong><?php echo $palavra; ?></strong></h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Data emissão</th>
                                <th>Intervalo</th>
                                <th>Usuário</th>
                                <th>Chamados</th>
                                <th class="text-right">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuario as $value) { ?>
                            <tr>
                                <td><?php echo $value->getIdrelatorio_plantao(); ?></td>
                                <td><?php echo date("d/m/Y - H:m", strtotime($value->getData()));?></td>
                                <td><?php echo date("d/m/Y", strtotime($value->getData_inicio()))." até ".date("d/m/Y", strtotime($value->getData_fim()));?></td>
                                <td><?php echo $value->getUsuario(); ?></td>
                                <td title="<?php echo $value->getOcorrencias(); ?>">
                                    <?php echo $value->reduzirDescricao($value->getOcorrencias()); ?>
                                </td>
                                <td class="text-right opcoes">    
                                    <a title="Enviar email" role="button" href="#mdlEmailPlantao" 
                                        data-toggle="modal" data-target="#mdlEmailPlantao"
                                        data-id="<?php echo $value->getIdrelatorio_plantao(); ?>"
                                        onclick="EnviarEmailPlantao(this)">
                                        <i class="fa fa-envelope-o"></i>
                                    </a>
                                    <a title="Visualizar" role="button" 
                                       href="<?php echo base_url('document/relatorio/')."/".$value->getIdrelatorio_plantao().".pdf";?>"
                                       target="_blank">
                                        <i class="fa fa-search-plus" ></i>
                                    </a> 
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
    <?php if (!isset($data) && !isset($usuario)) { ?>
    <div class="row"> <!-- Numero chamado -->
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Não há <strong>relatórios</strong> pela busca <strong><?php echo $palavra; ?></strong>.
            </div>
        </div>
    </div>
    <?php }?>
</div>

  
            