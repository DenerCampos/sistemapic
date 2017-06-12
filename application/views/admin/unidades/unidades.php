<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- unidades  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarUnidade" 
                        data-toggle="modal" data-target="#mdlCriarUnidade" role="button">
                    Novo unidade
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/unidade_admin/busca") ?>">
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
            <!--Todas unidades-->
            <?php if (isset($unidades)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Unidades cadastradas</h3>
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
                            <?php foreach ($unidades as $unidade) { ?>
                            <tr>
                                <td><?php echo $unidade->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($unidade->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($unidade->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarUnidade" 
                                       data-toggle="modal" data-target="#mdlAtivarUnidade"
                                       data-id="<?php echo $unidade->getIdunidade(); ?>"
                                       onclick="ativarUnidade(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarUnidade" 
                                       data-toggle="modal" data-target="#mdlEditarUnidade"
                                       data-id="<?php echo $unidade->getIdunidade(); ?>"
                                       onclick="editarUnidade(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverUnidade" 
                                       data-toggle="modal" data-target="#mdlRemoverUnidade"
                                       data-id="<?php echo $unidade->getIdunidade(); ?>"
                                       onclick="removerUnidade(this)">
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
            <?php }?> <!--Fim todas unidade-->
            
            <!--Pesquisa busca-->
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
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarUnidade" 
                                       data-toggle="modal" data-target="#mdlAtivarUnidade"
                                       data-id="<?php echo $resultado->getIdunidade(); ?>"
                                       onclick="ativarUnidade(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarUnidade" 
                                       data-toggle="modal" data-target="#mdlEditarUnidade"
                                       data-id="<?php echo $resultado->getIdunidade(); ?>"
                                       onclick="editarUnidade(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverUnidade" 
                                       data-toggle="modal" data-target="#mdlRemoverUnidade"
                                       data-id="<?php echo $resultado->getIdunidade(); ?>"
                                       onclick="removerUnidade(this)">
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
            <?php }?> <!--Fim pesquisa unidade-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>        
    </div>
</div> <!--fim row-->