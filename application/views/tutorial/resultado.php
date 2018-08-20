<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- tutorial  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- novo -->
        <div class="novo-chamado col-md-6">
            <a class="btn btn-warning" href="<?php echo base_url("tutorial"); ?>" role="button">
                <i class="fa fa-arrow-circle-o-left"></i> Voltar
            </a>
            <button class="btn btn-primary" type="submit" href="#mdlCriarTutorial" 
                    data-toggle="modal" data-target="#mdlCriarTutorial" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo tutorial
            </button>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("tutorial/buscar") ?>">
                <div class="input-group">
                    <input type="text" class="form-control" required="" id="iptBusca" name="iptBusca" 
                           placeholder="Busca por nome...">
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
    
    <!-- Dados -->
    <div class="row">
        <!-- Informações -->
        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
            <h3 class="borda-bottom">Informações</h3> <br>
            <div>
                <ul>
                    <li>Tutoriais (passo a passo) em geral para os processos do TI </li>
                    <li>Não anexar arquivos maiores que 100MB.</li>
                    <li>Descrever da melhor maneira possível para entendimento de todos.</li>
                </ul>
            </div>
        </div>
        
        <!-- Programas -->
        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
            <!-- Accordion -->
            <h3 class="borda-bottom">Tutoriais</h3><br>
            <?php if (isset($lista)) {?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <?php foreach ($lista as $value) {?>
                <div class="panel panel-default">

                    <div class="panel-heading" role="tab" id="<?php echo 'heading'.$value->getIdtutorial(); ?>">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'collapse'.$value->getIdtutorial(); ?>" aria-expanded="true" aria-controls="<?php echo 'collapse'.$value->getIdtutorial(); ?>">
                                <?php echo '<strong>'.$value->getNome().'</strong>'; ?>
                                <div class="opcoes-caixa text-right">
                                    <!-- editar -->
                                    <a href="#" title="Editar" role="button" href="#mdlEditarTutorial" 
                                       data-toggle="modal" data-target="#mdlEditarTutorial"
                                       data-id="<?php echo $value->getIdtutorial(); ?>"
                                       onclick="editarTutorial(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>

                                    <!-- remover -->
                                    <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?>
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverTutorial" 
                                       data-toggle="modal" data-target="#mdlRemoverTutorial"
                                       data-id="<?php echo $value->getIdtutorial(); ?>"
                                       onclick="removerTutorial(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </div>
                            </a>
                        </h4>
                    </div>

                    <div id="<?php echo 'collapse'.$value->getIdtutorial(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo 'heading'.$value->getIdtutorial(); ?>">
                        <div class="panel-body">
                            <?php echo '<strong>Nome: </strong>'.$value->getNome().'</br>'; ?>
                            <?php echo '<strong>Informações: </strong>'.nl2br($value->getDescricao()).'</br>'; ?>
                            <?php if ($value->getLink() != 'Sem anexo'){ ?>
                            <?php echo '<strong>Download: </strong><a href="'.$value->getLink().'">'.$value->getNome().'</a>' ?>
                            <?php }?>
                        </div>
                    </div>

                </div>
                <?php }?>
            </div>
            <?php } else {?>
            <!-- Mensagem que não há cadastros -->
            <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Não há <strong>programas</strong> cadastrados.
            </div>
            <?php }?> 
        </div>
        
    </div><!-- fim row -->

</div>