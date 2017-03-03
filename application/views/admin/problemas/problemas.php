<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- problemas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarProblema" 
                        data-toggle="modal" data-target="#mdlCriarProblema" role="button">
                    Novo problema
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
                            <!--Todas areas-->
                            <?php if (isset($problemas)) {?>
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