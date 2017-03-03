<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- setores  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarSetor" 
                        data-toggle="modal" data-target="#mdlCriarSetor" role="button">
                    Novo setor
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
                <h3 class="panel-title">Setores cadastrados</h3>
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
                            <?php if (isset($setores)) {?>
                            <?php foreach ($setores as $setor) { ?>
                            <tr>
                                <td><?php echo $setor->getNome(); ?></td>
                                <td><?php echo $estado->buscaId($setor->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($setor->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarSetor" 
                                       data-toggle="modal" data-target="#mdlAtivarSetor"
                                       data-id="<?php echo $setor->getIdsetor(); ?>"
                                       onclick="ativarSetor(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarSetor" 
                                       data-toggle="modal" data-target="#mdlEditarSetor"
                                       data-id="<?php echo $setor->getIdsetor(); ?>"
                                       onclick="editarSetor(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverSetor" 
                                       data-toggle="modal" data-target="#mdlRemoverSetor"
                                       data-id="<?php echo $setor->getIdsetor(); ?>"
                                       onclick="removerSetor(this)">
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