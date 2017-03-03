<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- unidades  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarUnidade" 
                        data-toggle="modal" data-target="#mdlCriarUnidade" role="button">
                    Novo unidade
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
                            <!--Todas areas-->
                            <?php if (isset($unidades)) {?>
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