<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- areas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarArea" 
                        data-toggle="modal" data-target="#mdlCriarArea" role="button">
                    Nova área
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
                <h3 class="panel-title">Áreas cadastradas</h3>
            </div>
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
                            <!--Todas areas-->
                            <?php if (isset($areas)) {?>
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