<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Relatório plantão-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarPlantao" 
                    data-toggle="modal" data-target="#mdlCriarPlantao" role="button">
                Criar novo relatório
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Busca por data...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">Buscar!</button>
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <?php if (isset($plantoes)){ ?>
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ultimos relatórios gerados</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Data emissão</th>
                                        <th>Intervalo</th>
                                        <th>Usuário</th> 
                                        <th>Chamados</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Todos-->
                                    <?php foreach ($plantoes as $plantao) { ?>
                                    <tr>
                                        <td><?php echo $plantao->getIdrelatorio_plantao(); ?></td>
                                        <td><?php echo date("d/m/Y - H:m", strtotime($plantao->getData()));?></td>
                                        <td><?php echo date("d/m/Y", strtotime($plantao->getData_inicio()))." até ".date("d/m/Y", strtotime($plantao->getData_fim()));?></td>
                                        <td><?php echo $plantao->getUsuario(); ?></td>
                                        <td><?php echo $plantao->getOcorrencias(); ?></td>
                                        <td class="text-right opcoes">                            
                                            <a title="Visualizar" role="button" href="#mdlVisualizarRelatorio" 
                                               data-toggle="modal" data-target="#mdlVisualizarChamado"
                                               data-id="<?php echo "1"; ?>"
                                               onclick="visualizarRelatorio(this)">
                                                <i class="fa fa-search-plus" ></i>
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php } //for plantao?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } else { //isset manutencaos?>
                <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Não há <strong>relatórios de plantão</strong> gerados.
                </div>
                <?php }?>
                <nav aria-label="Page navigation">
                    <!--<?php echo $paginas; ?>-->
                </nav>        
            </div>
        </div>
    </div>
</div> <!--fim row-->