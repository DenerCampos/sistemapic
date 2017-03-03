<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- maquinas  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarMaquina" 
                        data-toggle="modal" data-target="#mdlCriarMaquina" role="button">
                    Novo maquina
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
                            <!--Todas areas-->
                            <?php if (isset($maquinas)) {?>
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
                            <?php } //foreach maquinas?>
                            <?php } //isset maquinas?>
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