<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- areas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar areas  -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarArea" 
                        data-toggle="modal" data-target="#mdlCriarArea" role="button">
                    Nova área
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/area_admin/busca") ?>">
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
            <!--Todas areas-->
            <?php if (isset($areas)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Áreas cadastradas</h3>
            </div>
            <!--Corpo-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($areas as $area) { ?>
                            <tr>
                                <td><?php echo $area->getNome(); ?></td>
                                <td><?php echo $area->getEmail(); ?></td>
                                <td><?php echo $estado->buscaId($area->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($area->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarArea" 
                                       data-toggle="modal" data-target="#mdlAtivarArea"
                                       data-id="<?php echo $area->getIdarea(); ?>"
                                       onclick="ativarArea(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarArea" 
                                       data-toggle="modal" data-target="#mdlEditarArea"
                                       data-id="<?php echo $area->getIdarea(); ?>"
                                       onclick="editarArea(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverArea" 
                                       data-toggle="modal" data-target="#mdlRemoverArea"
                                       data-id="<?php echo $area->getIdarea(); ?>"
                                       onclick="removerArea(this)">
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
            <?php }?> <!--Fim todas areas-->
            
            <!--Todas resultados busca-->
            <?php if (isset($resultados)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Busca por: <strong><?php echo $palavra;?></strong></h3>
            </div>
            <!--Corpo-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $resultado->getEmail(); ?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarArea" 
                                       data-toggle="modal" data-target="#mdlAtivarArea"
                                       data-id="<?php echo $resultado->getIdarea(); ?>"
                                       onclick="ativarArea(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarArea" 
                                       data-toggle="modal" data-target="#mdlEditarArea"
                                       data-id="<?php echo $resultado->getIdarea(); ?>"
                                       onclick="editarArea(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverArea" 
                                       data-toggle="modal" data-target="#mdlRemoverArea"
                                       data-id="<?php echo $resultado->getIdarea(); ?>"
                                       onclick="removerArea(this)">
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
            <?php }?><!--Fim todas resultados busca-->
        
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>
    </div>
</div> <!--fim row-->