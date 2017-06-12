<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- tipos  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <!-- Pesquisa-->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarTipo" 
                        data-toggle="modal" data-target="#mdlCriarTipo" role="button">
                    Novo tipo
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/tipo_maquina_admin/busca") ?>">
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
            <!--Todos tipos-->
            <?php if (isset($tipos)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Tipos cadastrados</h3>
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
                            <?php foreach ($tipos as $tipo) { ?>
                            <tr>
                                <td><?php echo $tipo->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($tipo->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($tipo->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarTipo" 
                                       data-toggle="modal" data-target="#mdlAtivarTipo"
                                       data-id="<?php echo $tipo->getIdtipo(); ?>"
                                       onclick="ativarTipo(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarTipo" 
                                       data-toggle="modal" data-target="#mdlEditarTipo"
                                       data-id="<?php echo $tipo->getIdtipo(); ?>"
                                       onclick="editarTipo(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverTipo" 
                                       data-toggle="modal" data-target="#mdlRemoverTipo"
                                       data-id="<?php echo $tipo->getIdtipo(); ?>"
                                       onclick="removerTipo(this)">
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
            <?php }?> <!--Fim tipos maquina-->
            
            <!--Todos tipos-->
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
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarTipo" 
                                       data-toggle="modal" data-target="#mdlAtivarTipo"
                                       data-id="<?php echo $resultado->getIdtipo(); ?>"
                                       onclick="ativarTipo(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarTipo" 
                                       data-toggle="modal" data-target="#mdlEditarTipo"
                                       data-id="<?php echo $resultado->getIdtipo(); ?>"
                                       onclick="editarTipo(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverTipo" 
                                       data-toggle="modal" data-target="#mdlRemoverTipo"
                                       data-id="<?php echo $resultado->getIdtipo(); ?>"
                                       onclick="removerTipo(this)">
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
            <?php }?> <!--Fim tipos maquina-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>       
    </div>
</div> <!--fim row-->