<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Checklist-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="<?php echo base_url("checklist/novo"); ?>" 
                    role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Criar novo checklist
            </a>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("checklist/buscar"); ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome usuário...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <?php if (isset($lista)){ ?>
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
                                        <th>Usuário</th> 
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Todos-->
                                    <?php foreach ($lista as $value) { ?>
                                    <tr>
                                        <td><?php echo $value["id"]; ?></td>
                                        <td><?php echo $value["data"];?></td>
                                        <td><?php echo $value["usuario"]; ?></td>                                   
                                        <td class="text-right opcoes">
                                            <a title="Enviar email" role="button" href="#mdlEmailChecklist" 
                                                data-toggle="modal" data-target="#mdlEmailChecklist"
                                                data-id="<?php echo $value["id"]; ?>"
                                                onclick="emailChecklist(this)">
                                                <i class="fa fa-envelope-o"></i>
                                            </a>
                                            <a title="Visualizar" role="button" 
                                               href="<?php echo base_url('document/checklist/')."/".$value["id"].".pdf";?>"
                                               target="_blank">
                                                <i class="fa fa-search-plus" ></i>
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php } //for lista?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } else { //isset lista?>
                <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Não há <strong>relatórios de checklist</strong> gerados.
                </div>
                <?php }?>
                <nav aria-label="Page navigation">
                    <!--<?php echo $paginas; ?>-->
                </nav>        
            </div>
        </div>
    </div>
</div> <!--fim row-->