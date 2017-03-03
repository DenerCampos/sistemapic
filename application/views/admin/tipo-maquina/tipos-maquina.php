<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- tipos  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarTipo" 
                        data-toggle="modal" data-target="#mdlCriarTipo" role="button">
                    Novo tipo
                </button>
            </div>
            <div class="pesquisar-chamado col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Busca por nome...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Buscar!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
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
                            <!--Todos tipos-->
                            <?php if (isset($tipos)) {?>
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