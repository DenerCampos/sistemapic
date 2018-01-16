<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- maquinas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarMaquina" 
                        data-toggle="modal" data-target="#mdlCriarMaquina" role="button">
                    Nova maquina
                </button>
                
                <button class="btn btn-danger" type="submit" href="#mdlGerarMaquina" 
                        data-toggle="modal" data-target="#mdlGerarMaquina" role="button">
                    Gerar tabela IP completa
                </button>
                
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/maquina_admin/busca") ?>">
                    <div class="input-group">
                        <input type="text" class="form-control" id="iptBusca" name="iptBusca" 
                               placeholder="buscar por nome ou IP...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning" type="submit">Buscar!</button>
                        </span>
                    </div>
                </form>            
            </div>
            
        </div> <!-- fim row-->
        
        <!-- Inicio painel-->
        <div class="panel panel-warning panel-admin">
            <!--Todas maquinas-->
            <?php if (isset($maquinas)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Maquinas cadastradas</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Ip</th>
                                <th>Descrição</th>
                                <th>Local</th>
                                <th>Tipo</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($maquinas as $maquina) { ?>
                            <tr>
                                <td><?php echo $maquina->getNome(); ?></td>
                                <td><?php echo $maquina->getLogin(); ?></td>
                                <td><?php echo $maquina->getIp(); ?></td>
                                <td><?php echo $maquina->getDescricao(); ?></td>
                                <td><?php echo $local->buscaId($maquina->getIdlocal())->getNome(); ?></td>
                                <td><?php echo $tipo->buscaId($maquina->getIdtipo())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Editar" role="button" href="#mdlEditarMaquina" 
                                       data-toggle="modal" data-target="#mdlEditarMaquina"
                                       data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                       onclick="editarMaquina(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverMaquina" 
                                       data-toggle="modal" data-target="#mdlRemoverMaquina"
                                       data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                       onclick="removerMaquina(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim maquina-->
            
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
                                <th>Login</th>
                                <th>Ip</th>
                                <th>Descrição</th>
                                <th>Local</th>
                                <th>Tipo</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $resultado->getLogin(); ?></td>
                                <td><?php echo $resultado->getIp(); ?></td>
                                <td><?php echo $resultado->getDescricao(); ?></td>
                                <td><?php echo $local->buscaId($resultado->getIdlocal())->getNome(); ?></td>
                                <td><?php echo $tipo->buscaId($resultado->getIdtipo())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <a href="#" title="Editar" role="button" href="#mdlEditarMaquina" 
                                       data-toggle="modal" data-target="#mdlEditarMaquina"
                                       data-id="<?php echo $resultado->getIdmaquina(); ?>"
                                       onclick="editarMaquina(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverMaquina" 
                                       data-toggle="modal" data-target="#mdlRemoverMaquina"
                                       data-id="<?php echo $resultado->getIdmaquina(); ?>"
                                       onclick="removerMaquina(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim maquina-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>       
    </div>
</div> <!--fim row-->