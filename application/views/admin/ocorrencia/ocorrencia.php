<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- estado de ocorrencias  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarEstado" 
                        data-toggle="modal" data-target="#mdlCriarEstado" role="button">
                    Novo estado de ocorrências
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/ocorrencia_estado_admin/busca") ?>">
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
            <!--Todas estados-->
            <?php if (isset($estados)) {?>
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
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim todos ocorrencia estado-->
            
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
                                <th>Descrição</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getNome(); ?></td>
                                <td><?php echo $resultado->getDescricao(); ?></td>
                                <td class="text-right opcoes">                                   
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEstado" 
                                       data-toggle="modal" data-target="#mdlEditarEstado"
                                       data-id="<?php echo $resultado->getIdocorrencia_estado(); ?>"
                                       onclick="editarEstado(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>
                                </td>
                            </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim todos ocorrencia estado-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>         
    </div>
</div> <!--fim row-->