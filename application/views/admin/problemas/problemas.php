<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- problemas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarProblema" 
                        data-toggle="modal" data-target="#mdlCriarProblema" role="button">
                    Novo problema
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/problema_admin/busca") ?>">
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
            <!--Todos problemas-->
            <?php if (isset($problemas)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Problemas cadastrados</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($problemas as $problema) { ?>
                            <tr>
                                <td><?php echo $problema->getNome(); ?></td>
                                <td><?php echo $problema->getDescricao(); ?></td>
                                <td><?php echo $estado->buscaId($problema->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($problema->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarProblema" 
                                       data-toggle="modal" data-target="#mdlAtivarProblema"
                                       data-id="<?php echo $problema->getIdproblema(); ?>"
                                       onclick="ativarProblema(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarProblema" 
                                       data-toggle="modal" data-target="#mdlEditarProblema"
                                       data-id="<?php echo $problema->getIdproblema(); ?>"
                                       onclick="editarProblema(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverProblema" 
                                       data-toggle="modal" data-target="#mdlRemoverProblema"
                                       data-id="<?php echo $problema->getIdproblema(); ?>"
                                       onclick="removerProblema(this)">
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
            <?php }?> <!--Fim todos problemas-->
            
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
                                <th>Descrição</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $resultado->getDescricao(); ?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarProblema" 
                                       data-toggle="modal" data-target="#mdlAtivarProblema"
                                       data-id="<?php echo $resultado->getIdproblema(); ?>"
                                       onclick="ativarProblema(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarProblema" 
                                       data-toggle="modal" data-target="#mdlEditarProblema"
                                       data-id="<?php echo $resultado->getIdproblema(); ?>"
                                       onclick="editarProblema(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverProblema" 
                                       data-toggle="modal" data-target="#mdlRemoverProblema"
                                       data-id="<?php echo $resultado->getIdproblema(); ?>"
                                       onclick="removerProblema(this)">
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
            <?php }?> <!--Fim busca problemas-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>         
    </div>
</div> <!--fim row-->