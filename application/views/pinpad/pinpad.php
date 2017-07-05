<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- pinpad  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- novo pinpad -->
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarPinpad" 
                    data-toggle="modal" data-target="#mdlCriarPinpad" role="button">
                Novo PinPad
            </button>
            <a class="btn btn-success" href="<?php echo base_url("exibir/pinpad"); ?>" role="button">
                <i class="fa fa-list-alt"></i> Listar todos
            </a>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("pinpad/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome, modelo ou serial...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div> <!-- fim row -->
    
    <!-- painel listando pinpads -->
    <?php if (isset($lista)) {?>
    <div class="panel panel-primary">
        <!-- cabeçalho painel -->
        <div class="panel-heading">
            <h3 class="panel-title">PinPad´s cadastrados</h3>
        </div>
        <!-- corpo painel -->
        <div class="panel-body">
            <div class="table-responsive">
                <!-- tabela -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Descrição</th>
                            <th>Local</th>
                            <th class="text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista as $item) { ?>
                        <tr>
                            <td><?php echo $item->getNome(); ?></td>
                            <td><?php echo $item->getModelo(); ?></td>
                            <td><?php echo $item->getSerial(); ?></td>
                            <td><?php echo $item->getDescricao(); ?></td>
                            <td><?php echo $local->buscaId($item->getIdlocal())->getNome(); ?></td>                                               
                            <td class="text-right">
                                
                                <!-- editar -->
                                <a href="#" title="Editar" role="button" href="#mdlEditarPinpad" 
                                   data-toggle="modal" data-target="#mdlEditarPinpad"
                                   data-id="<?php echo $item->getIdpinpad(); ?>"
                                   onclick="editarPinpad(this)">
                                    <i class="fa fa-pencil-square-o" ></i>
                                </a>
                                
                                <!-- remover -->
                                <?php if ($this->session->userdata('nivel') === '0') {?>
                                <a href="#" title="Remover" role="button" href="#mdlRemoverPinpad" 
                                   data-toggle="modal" data-target="#mdlRemoverPinpad"
                                   data-id="<?php echo $item->getIdpinpad(); ?>"
                                   onclick="removerPinpad(this)">
                                    <i class="fa fa-remove" ></i>
                                </a>
                                <?php }?>
                            </td> <!-- fim opções -->  
                            
                        </tr>
                        <?php } //foreach lista?>                        
                    </tbody>
                </table> <!-- fim tabela -->
            </div>
        </div> <!-- fim corpo painel -->
    </div> <!-- fim painel listando pinpads -->
    <?php } else {?>
    <!-- Mensagem que não há cadastros -->
    <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Não há <strong>PinPad´s</strong> cadastrados.
    </div>
    <?php }?> 
    
    <!-- paginação -->
    <div class="pagina-direita">
        <nav aria-label="Page navigation">
            <?php echo $paginas; ?>
        </nav>
    </div>
    
</div>