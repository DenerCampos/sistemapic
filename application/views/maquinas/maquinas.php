<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- maquinas  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarMaquina" id=""
                    data-toggle="modal" data-target="#mdlCriarMaquina" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Nova maquina
            </button>
            
            <a class="btn btn-success" href="<?php echo base_url("exibir/maquina"); ?>" role="button">
                <i class="fa fa-list-alt"></i> Listar todos
            </a>
            
            <a class="btn btn-warning" href="<?php echo base_url("maquina/buscar/LIVRE"); ?>" role="button">
                <i class="fa fa-list-alt"></i> Listar IP´s livres
            </a>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("maquina/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome ou ip...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>
    
    <ul class="nav nav-tabs" id="TabsIP" role="tablist"> 
        <li role="presentation" class="active">
            <a href="#picpampulhaIp" id="picpampulhaIp-tab" role="tab" data-toggle="tab" aria-controls="picpampulha" aria-expanded="true">PIC Pampulha</a>
        </li> 
        <li role="presentation" class="">
            <a href="#piccidadeIp" role="tab" id="piccidadeIp-tab" data-toggle="tab" aria-controls="piccidade" aria-expanded="false">PIC Cidade</a>
        </li>  
    </ul>
    
    <div class="tab-content" id="myTabContent"> 
        
        <div class="tab-pane fade active in" role="tabpanel" id="picpampulhaIp" aria-labelledby="picpampulha-tab"> 
            
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Ip´s</h3>
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
                                <?php if (isset($mPicPampulha)) {?>
                                <?php foreach ($mPicPampulha as $maquina) { ?>
                                <tr>
                                    <td><?php echo $maquina->getNome(); ?></td>
                                    <td><?php echo $maquina->getLogin(); ?></td>
                                    <td><?php echo $maquina->getIp(); ?></td>
                                    <td><?php echo $maquina->getDescricao(); ?></td>
                                    <td><?php echo $local->buscaId($maquina->getIdlocal())->getNome(); ?></td>
                                    <td><?php echo $tipo->buscaId($maquina->getIdtipo())->getNome(); ?></td>
                                    <td class="text-right">
                                        
                                        <?php if ($software->verificaInventario($maquina->getIdmaquina())) {?>
                                        <!-- visualizar inventario -->
                                        <a href="#" title="Visualizar inventário software" role="button" href="#mdlVisualizaInventario" 
                                           data-toggle="modal" data-target="#mdlVisualizaInventario"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="visualizarInventarioIp(this)">
                                            <i class="fa fa-book" aria-hidden="true"></i>
                                        </a>
                                        <?php } ?>

                                        <!-- editar -->
                                        <a href="#" title="Editar" role="button" href="#mdlEditarMaquina" 
                                           data-toggle="modal" data-target="#mdlEditarMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="editarMaquinaIp(this)">
                                            <i class="fa fa-pencil-square-o" ></i>
                                        </a>

                                        <!-- livre -->
                                        <?php if ($maquina->getNome() != "LIVRE"){ ?>
                                        <a href="#" title="Deixar livre" role="button" href="#mdlLivreMaquina" 
                                           data-toggle="modal" data-target="#mdlLivreMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="livreMaquinaIp(this)">
                                            <i class="fa fa-caret-square-o-down" ></i>
                                        </a>
                                        <?php } ?>
                                        <!--                                
                                        remover
                                        <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?>
                                        <a href="#" title="Remover" role="button" href="#mdlRemoverMaquina" 
                                           data-toggle="modal" data-target="#mdlRemoverMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="removerMaquinaIp(this)">
                                            <i class="fa fa-remove" ></i>
                                        </a>                                
                                        <?php } ?>
                                        -->
                                    </td>
                                </tr>
                                <?php } //foreach maquinas?>
                                <?php } //isset maquinas?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="pagina-direita">
                <nav aria-label="Page navigation">
                    <?php echo $paginas; ?>
                </nav>
            </div>
            
        </div> 
        
        <div class="tab-pane fade" role="tabpanel" id="piccidadeIp" aria-labelledby="piccidade-tab"> 

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Lista de Ip´s</h3>
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
                                <?php if (isset($mPicCidade)) {?>
                                <?php foreach ($mPicCidade as $maquina) { ?>
                                <tr>
                                    <td><?php echo $maquina->getNome(); ?></td>
                                    <td><?php echo $maquina->getLogin(); ?></td>
                                    <td><?php echo $maquina->getIp(); ?></td>
                                    <td><?php echo $maquina->getDescricao(); ?></td>
                                    <td><?php echo $local->buscaId($maquina->getIdlocal())->getNome(); ?></td>
                                    <td><?php echo $tipo->buscaId($maquina->getIdtipo())->getNome(); ?></td>
                                    <td class="text-right">

                                        <!-- editar -->
                                        <a href="#" title="Editar" role="button" href="#mdlEditarMaquina" 
                                           data-toggle="modal" data-target="#mdlEditarMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="editarMaquinaIp(this)">
                                            <i class="fa fa-pencil-square-o" ></i>
                                        </a>

                                        <!-- livre -->
                                        <?php if ($maquina->getNome() != "LIVRE"){ ?>
                                        <a href="#" title="Deixar livre" role="button" href="#mdlLivreMaquina" 
                                           data-toggle="modal" data-target="#mdlLivreMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="livreMaquinaIp(this)">
                                            <i class="fa fa-caret-square-o-down" ></i>
                                        </a>
                                        <?php } ?>
                                        <!--                                
                                        remover
                                        <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?>
                                        <a href="#" title="Remover" role="button" href="#mdlRemoverMaquina" 
                                           data-toggle="modal" data-target="#mdlRemoverMaquina"
                                           data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                           onclick="removerMaquinaIp(this)">
                                            <i class="fa fa-remove" ></i>
                                        </a>                                
                                        <?php } ?>
                                        -->
                                    </td>
                                </tr>
                                <?php } //foreach maquinas?>
                                <?php } //isset maquinas?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="pagina-direita">
                <nav aria-label="Page navigation">
                    <?php echo $paginas; ?>
                </nav>
            </div>
            
        </div> 
        
    </div>
    
          
</div>