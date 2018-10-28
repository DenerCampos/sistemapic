<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- alaviacao  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- nova -->
        <div class="novo-chamado col-md-6">
            <a class="btn btn-primary" href="<?php echo base_url("avaliacao/novo");?>" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Nova avaliação
            </a>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("avaliacao/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome ou cota...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i> Buscar!</button>
                    </span>
                </div>
            </form>            
        </div>
        
    </div> <!-- fim row -->
    
    <!-- painel listando pinpads -->
    <?php if (!empty($lista)) {?>
    <div class="panel panel-primary">
        <!-- cabeçalho painel -->
        <div class="panel-heading">
            <h3 class="panel-title">Últimos cadastrados</h3>
        </div>
        <!-- corpo painel -->
        <div class="panel-body">
            <div class="table-responsive">
                <!-- tabela -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cota</th>
                            <th>Idade</th>
                            <th>E-mail</th>
                            <th>Data</th>
                            <th class="text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista as $item) { ?>
                        <tr>
                            <td><?php echo $item["aluno"]->getNome(); ?></td>
                            <td><?php echo $item["aluno"]->getCota(); ?></td>
                            <td><?php echo $item["aluno"]->getIdade(); ?></td>
                            <td><?php echo $item["aluno"]->getEmail(); ?></td>
                            <td><?php echo date("d-m-Y", strtotime($item["avaliacao"]->getData())); ?></td>                                            
                            <td class="text-right">
                                
                                <!-- editar -->
                                <a href="<?php echo base_url("avaliacao/editar")."/".$item["avaliacao"]->getIdavaliacao();?>"
                                   title="Editar avaliação" role="button">
                                    <i class="fa fa-pencil-square-o" ></i>
                                </a>
                                
                                <!-- visualizar -->
                                <a href="<?php echo base_url("avaliacao/visualizar/".$item["aluno"]->getIdaluno());?>"
                                   role="button" title="Vizualizar avaliações do aluno" >
                                    <i class="fa fa-search-plus" ></i>
                                </a>
                            </td> <!-- fim opções -->  
                            
                        </tr>
                        <?php } //foreach lista?>                        
                    </tbody>
                </table> <!-- fim tabela -->
            </div>
        </div> <!-- fim corpo painel -->
    </div> <!-- fim painel -->
    <?php } else {?>
    <!-- Mensagem que não há cadastros -->
    <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Não há <strong>avaliações</strong> cadastradas.
    </div>
    <?php }?>     
</div>