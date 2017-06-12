<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Usuarios  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarUsuario" 
                        data-toggle="modal" data-target="#mdlCriarUsuario" role="button">
                    Novo Usuário
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/usuario_admin/busca") ?>">
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
            <!--Todos usuarios-->
            <?php if (isset($usuarios)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Usuários cadastrados</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Nivel</th>
                                <th>Área de atendimento</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario->getNome(); ?></td>
                                <td><?php echo $usuario->getLogin(); ?></td>
                                <td><?php switch ($usuario->getNivel()) {
                                            case 0:
                                                echo "Administrador";
                                                break;
                                            case 1:
                                                echo "Técnico";
                                                break;
                                            default:
                                                echo "Usuário";
                                                break;}?></td>
                                <td><?php if ($usuario->getIdarea() == NULL){ echo "Nenhuma";}
                                else{ echo $area->buscaId($usuario->getIdarea())->getNome() ; }?></td>
                                <td><?php echo $estado->buscaId($usuario->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($usuario->getIdestado() == 2){ ?>                             
                                    <a title="Ativar" role="button" href="#mdlAtivarUsuario" 
                                       data-toggle="modal" data-target="#mdlAtivarUsuario"
                                       data-id="<?php echo $usuario->getIdusuario(); ?>"
                                       onclick="ativarUsuario(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a title="Editar" role="button" href="#mdlEditarUsuario" 
                                       data-toggle="modal" data-target="#mdlEditarUsuario"
                                       data-id="<?php echo $usuario->getIdusuario(); ?>"
                                       onclick="editarUsuario(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a title="Remover" role="button" href="#mdlRemoverUsuario" 
                                       data-toggle="modal" data-target="#mdlRemoverUsuario"
                                       data-id="<?php echo $usuario->getIdusuario(); ?>"
                                       onclick="removerUsuario(this)">
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
            <?php }?> <!--Fim todos usuario-->
            
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
                                <th>Login</th>
                                <th>Nivel</th>
                                <th>Área de atendimento</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $resultado->getLogin(); ?></td>
                                <td><?php switch ($resultado->getNivel()) {
                                            case 0:
                                                echo "Administrador";
                                                break;
                                            case 1:
                                                echo "Técnico";
                                                break;
                                            default:
                                                echo "Usuário";
                                                break;}?></td>
                                <td><?php if ($resultado->getIdarea() == NULL){ echo "Nenhuma";}
                                else{ echo $area->buscaId($resultado->getIdarea())->getNome() ; }?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a title="Ativar" role="button" href="#mdlAtivarUsuario" 
                                       data-toggle="modal" data-target="#mdlAtivarUsuario"
                                       data-id="<?php echo $resultado->getIdusuario(); ?>"
                                       onclick="ativarUsuario(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a title="Editar" role="button" href="#mdlEditarUsuario" 
                                       data-toggle="modal" data-target="#mdlEditarUsuario"
                                       data-id="<?php echo $resultado->getIdusuario(); ?>"
                                       onclick="editarUsuario(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a title="Remover" role="button" href="#mdlRemoverUsuario" 
                                       data-toggle="modal" data-target="#mdlRemoverUsuario"
                                       data-id="<?php echo $resultado->getIdusuario(); ?>"
                                       onclick="removerUsuario(this)">
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
            <?php }?> <!--Fim busca usuario-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>        
    </div>
</div> <!--fim row-->