<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- estado de ocorrencias  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarEstado" 
                        data-toggle="modal" data-target="#mdlCriarEstado" role="button">
                    Novo estado de ocorrências
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
                <h3 class="panel-title">Estados de ocorrências cadastrados</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Todas estados-->
                            <?php if (isset($estados)) {?>
                            <?php foreach ($estados as $estado) { ?>
                            <tr>
                                <td><?php echo $estado->getNome(); ?></td>
                                <td><?php echo $estado->getDescricao(); ?></td>
                                <td class="text-right opcoes">                                   
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEstado" 
                                       data-toggle="modal" data-target="#mdlEditarEstado"
                                       data-id="<?php echo $estado->getIdocorrencia_estado(); ?>"
                                       onclick="editarEstado(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>
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