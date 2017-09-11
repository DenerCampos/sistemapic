<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- maquinas  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="novo-chamado col-md-6">
            <a class="btn btn-warning" href="<?php echo base_url("maquina"); ?>" role="button">
                <i class="fa fa-arrow-circle-o-left"></i> Voltar
            </a>
            <button class="btn btn-primary" type="submit" href="#mdlCriarMaquina" 
                    data-toggle="modal" data-target="#mdlCriarMaquina" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Nova maquina
            </button>
        </div>
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("maquina/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome ou ip..."
                           <?php if (isset($palavra)) {echo 'value = "'.$palavra.'"';}?>>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo "Busca por: <strong>".$palavra."</strong>. - ".count($maquinas)." resultado(s):"; ?>
            </div>
        </div>
    </div>
    
    <!-- painel listando maquinas -->
    <?php if (isset($maquinas)) {?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Maquinas cadastradas</h3>
        </div>
        <!-- corpo painel -->
        <div class="panel-body">
            <div class="table-responsive">
                <!-- tabela -->
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
                        <?php foreach ($maquinas as $maquina) { ?>
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
                                
                                <!-- remover -->
                                <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?>
                                <a href="#" title="Remover" role="button" href="#mdlRemoverMaquina" 
                                   data-toggle="modal" data-target="#mdlRemoverMaquina"
                                   data-id="<?php echo $maquina->getIdmaquina(); ?>"
                                   onclick="removerMaquinaIp(this)">
                                    <i class="fa fa-remove" ></i>
                                </a>
                                <?php } ?>
                                
                            </td>
                        </tr>
                        <?php } //foreach maquinas?>
                    </tbody>
                </table> <!-- fim tabela -->
            </div>
        </div> <!-- fim corpo painel -->
    </div> <!-- fim painel listando pinpads -->
    <?php } else {?>
    
    <!-- Mensagem que não há cadastros -->
    <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Não há <strong>Maquinas</strong> cadastradas.
    </div>
    <?php }?> 
       
</div>