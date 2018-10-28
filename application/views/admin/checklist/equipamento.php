<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- equipamentos  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarEquipamento" 
                        data-toggle="modal" data-target="#mdlCriarEquipamento" role="button">
                    Novo equipamento
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/equipamento_checklist_admin/busca") ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" id="iptBusca" name="iptBusca" 
                               placeholder="buscar por nome...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning" type="submit">Buscar!</button>
                        </span>
                    </div>
                </form>            
            </div>
            
        </div> <!-- fim row-->
        
        <!-- Inicio painel-->
        <div class="panel panel-warning panel-admin">
            <!--Todos equipamentos-->
            <?php if (isset($lista)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Equipamentos de checklist cadastrados</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Grupo</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista as $value) { ?>
                            <tr>
                                <td><?php echo $value->getNome(); ?></td>
                                <td><?php echo $grupo->buscaId($value->getIdgrupo_checklist())->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($value->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($value->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarEquipamento" 
                                       data-toggle="modal" data-target="#mdlAtivarEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="ativarEquipamento(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEquipamento" 
                                       data-toggle="modal" data-target="#mdlEditarEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="editarEquipamento(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverEquipamento" 
                                       data-toggle="modal" data-target="#mdlRemoverEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="removerEquipamento(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </td>
                             </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim todos-->
            
            <!--Resultado busca-->
            <?php if (isset($resultados)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Busca por: <strong><?php echo $palavra;?></strong></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $value) { ?>
                            <tr>
                                <td><?php echo $value->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($value->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($value->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarEquipamento" 
                                       data-toggle="modal" data-target="#mdlAtivarEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="ativarEquipamento(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEquipamento" 
                                       data-toggle="modal" data-target="#mdlEditarEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="editarEquipamento(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverEquipamento" 
                                       data-toggle="modal" data-target="#mdlRemoverEquipamento"
                                       data-id="<?php echo $value->getIdequipamento_checklist(); ?>"
                                       onclick="removerEquipamento(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </td>
                             </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim todos-->
            
        </div><!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>           
    </div>
</div> <!--fim row-->