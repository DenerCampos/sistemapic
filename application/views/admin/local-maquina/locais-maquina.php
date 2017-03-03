<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- locais  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarLocal" 
                        data-toggle="modal" data-target="#mdlCriarLocal" role="button">
                    Novo local
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
                            <!--Todos locais-->
                            <?php if (isset($locais)) {?>
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