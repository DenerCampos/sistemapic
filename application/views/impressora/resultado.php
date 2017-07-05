<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- impressora  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- nova impressora -->
        <div class="novo-chamado col-md-6">
            <a class="btn btn-warning" href="<?php echo base_url("impressora"); ?>" role="button">
                <i class="fa fa-arrow-circle-o-left"></i> Voltar
            </a>
            <button class="btn btn-primary" type="submit" href="#mdlCriarImpressora" 
                    data-toggle="modal" data-target="#mdlCriarImpressora" role="button">
                Nova Impressora
            </button>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("impressora/buscar") ?>">
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
    
    <!-- resultado da pesquisa  -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo "Busca por: <strong>".$palavra."</strong>. - Resultado: ".$total." ocorrências"; ?>
            </div>
        </div>
    </div>
    
    <!-- painel listando pinpads -->
    <?php if (isset($lista)) {?>
    <div class="panel panel-primary">
        <!-- cabeçalho painel -->
        <div class="panel-heading">
            <h3 class="panel-title">Impressora cadastradas</h3>
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
                                <a href="#" title="Editar" role="button" href="#mdlEditarImpressora" 
                                   data-toggle="modal" data-target="#mdlEditarImpressora"
                                   data-id="<?php echo $item->getIdimpressora(); ?>"
                                   onclick="editarImpressora(this)">
                                    <i class="fa fa-pencil-square-o" ></i>
                                </a>
                                
                                <!-- remover -->
                                <?php if ($this->session->userdata('nivel') === '0') {?>
                                <a href="#" title="Remover" role="button" href="#mdlRemoverImpressora" 
                                   data-toggle="modal" data-target="#mdlRemoverImpressora"
                                   data-id="<?php echo $item->getIdimpressora(); ?>"
                                   onclick="removerImpressora(this)">
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
       
</div>