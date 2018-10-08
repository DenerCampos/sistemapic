<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- patrimonios  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- novo -->
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarPatrimonio" 
                    data-toggle="modal" data-target="#mdlCriarPatrimonio" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo equipamento
            </button>
            <a class="btn btn-success" href="<?php echo base_url("exibir/patrimonio"); ?>" role="button">
                <i class="fa fa-list-alt"></i> Listar todos
            </a>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("patrimonio/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome, modelo, patrimônio ou serial...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
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
    
    <!-- painel listando -->
    <?php if (isset($lista)) {?>
    <div class="panel panel-primary">
        <!-- cabeçalho painel -->
        <div class="panel-heading">
            <h3 class="panel-title">Equipamentos cadastrados</h3>
        </div>
        <!-- corpo painel -->
        <div class="panel-body">
            <div class="table-responsive">
                <!-- tabela -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Patrimônio</th>
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
                            <td><?php echo $item->getEquipamento(); ?></td>
                            <td><?php echo $item->getPatrimonio(); ?></td>
                            <td><?php echo $item->getModelo(); ?></td>
                            <td><?php echo $item->getSerie(); ?></td>
                            <td><?php echo $item->getDescricao(); ?></td>
                            <td><?php echo $local->buscaId($item->getIdlocal())->getNome(); ?></td>                                               
                            <td class="text-right">
                                <!-- visualizar manutenções  -->
                                <a href="<?php echo base_url("manutencao/buscar/".$item->getPatrimonio()); ?>">
                                    <i class="fa fa-wrench" title="Manutenções"></i>
                                </a>                               
                                <!-- editar -->
                                <a href="#mdlEditarPatrimonio" data-toggle="modal" 
                                   data-target="#mdlEditarPatrimonio" role="button"
                                   data-id="<?php echo $item->getIdpatrimonio(); ?>"
                                   onclick="editarPatrimonio(this)">
                                    <i class="fa fa-edit" title="Editar"></i>
                                </a>
                                <a href="#mdlRemoverPatrimonio" data-toggle="modal" 
                                   data-target="#mdlRemoverPatrimonio" role="button"
                                   data-id="<?php echo $item->getIdpatrimonio(); ?>"
                                   onclick="removerPatrimonio(this)">
                                    <i class="fa fa-trash" title="Remover"></i>
                                </a>
                            </td> <!-- fim opções -->    
                            
                        </tr>
                        <?php } //foreach lista?>                        
                    </tbody>
                </table> <!-- fim tabela -->
            </div>
        </div> <!-- fim corpo painel -->
    </div> <!-- fim painel listando -->
    <?php } else {?>
    
    <!-- Mensagem que não há cadastros -->
    <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Não há <strong>equipamentos</strong> cadastrados.
    </div>
    <?php }?> 
       
</div>