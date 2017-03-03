<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Usuarios  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarUsuario" 
                        data-toggle="modal" data-target="#mdlCriarUsuario" role="button">
                    Novo Usuário
                </button>
            </div>
            <div class="pesquisar-chamado col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Busca por login...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Buscar!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
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
                            <!--Todos usuarios-->
                            <?php if (isset($usuarios)) {?>
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
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <nav aria-label="Page navigation">
            <?php echo $paginas; ?>
        </nav>        
    </div>
</div> <!--fim row-->