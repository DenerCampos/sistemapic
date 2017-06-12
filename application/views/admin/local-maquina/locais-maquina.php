<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- locais  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarLocal" 
                        data-toggle="modal" data-target="#mdlCriarLocal" role="button">
                    Novo local
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/local_maquina_admin/busca") ?>">
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
            <!--Todos locais-->
            <?php if (isset($locais)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Locais cadastrados</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Caixa</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locais as $local) { ?>
                            <tr>
                                <td><?php echo $local->getNome(); ?></td>
                                <td><?php if ($local->getCaixa() == "0"){echo "Sim";} else {echo "Não";} ?></td>
                                <td><?php echo $estado->buscaId($local->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($local->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarLocal" 
                                       data-toggle="modal" data-target="#mdlAtivarLocal"
                                       data-id="<?php echo $local->getIdlocal(); ?>"
                                       onclick="ativarLocal(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarLocal" 
                                       data-toggle="modal" data-target="#mdlEditarLocal"
                                       data-id="<?php echo $local->getIdlocal(); ?>"
                                       onclick="editarLocal(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverLocal" 
                                       data-toggle="modal" data-target="#mdlRemoverLocal"
                                       data-id="<?php echo $local->getIdlocal(); ?>"
                                       onclick="removerLocal(this)">
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
            <?php }?> <!--Fim todos locais-->
            
            <!--Resultados busca-->
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
                                <th>Caixa</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php if ($resultado->getCaixa() == "0"){echo "Sim";} else {echo "Não";} ?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarLocal" 
                                       data-toggle="modal" data-target="#mdlAtivarLocal"
                                       data-id="<?php echo $resultado->getIdlocal(); ?>"
                                       onclick="ativarLocal(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarLocal" 
                                       data-toggle="modal" data-target="#mdlEditarLocal"
                                       data-id="<?php echo $resultado->getIdlocal(); ?>"
                                       onclick="editarLocal(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverLocal" 
                                       data-toggle="modal" data-target="#mdlRemoverLocal"
                                       data-id="<?php echo $resultado->getIdlocal(); ?>"
                                       onclick="removerLocal(this)">
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
            <?php }?> <!--Fim resultado busca-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>         
    </div>
</div> <!--fim row-->