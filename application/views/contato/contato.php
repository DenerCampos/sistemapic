<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Contato  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        
        <!-- novo -->
        <div class="novo-chamado col-md-6">
            <button class="btn btn-primary" type="submit" href="#mdlCriarContato" 
                    data-toggle="modal" data-target="#mdlCriarContato" role="button">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                 Novo contato
            </button>
        </div>
        
        <!-- busca -->
        <div class="pesquisar-chamado col-md-6">
            <form class="form-buscar" method="post"
                  action="<?php echo base_url("contato/buscar") ?>">
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
    
    <!-- Dados -->
    <div class="row">
        <!-- Dados do PIC Pampulha e Cidade -->
        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
            <h3 class="borda-bottom">Dados</h3> <br>
            <div class="titulo-filial">PIC Cidade</div>
            <address>
                <strong>Pampulha Iate Clube</strong><br>
                Rua Claudio Manuel - 1185<br>
                Funcionários, Belo Horizonte, MG<br>
                CEP: 30140-100<br>
                <abbr title="Cadastro Geral de Contribuintes">CGC:</abbr> 17.300.278/0002-68
            </address>
            <div class="titulo-filial">PIC Pampulha</div>
            <address>
                <strong>Pampulha Iate Clube</strong><br>
                Rua Ilha Grande - 555<br>
                Jardim Atlântico, Belo Horizonte, MG<br>
                CEP: 31555-031<br>
                <abbr title="Cadastro Geral de Contribuintes">CGC:</abbr> 17.300.278/0001-87
            </address>
        </div>
        
        <!-- Contatos -->
        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
            <!-- Accordion -->
            <h3 class="borda-bottom">Contatos</h3><br>
            <?php if (isset($lista)) {?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <?php foreach ($lista as $value) {?>
                <div class="panel panel-default">

                    <div class="panel-heading" role="tab" id="<?php echo 'heading'.$value->getIdcontato(); ?>">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'collapse'.$value->getIdcontato(); ?>" aria-expanded="true" aria-controls="<?php echo 'collapse'.$value->getIdcontato(); ?>">
                                <?php echo '<strong>'.$value->getEmpresa().'</strong> | Telefone: '.$value->getTel(); ?>
                                <div class="opcoes-caixa text-right">
                                    <!-- editar -->
                                    <a href="#" title="Editar" role="button" href="#mdlEditarContato" 
                                       data-toggle="modal" data-target="#mdlEditarContato"
                                       data-id="<?php echo $value->getIdcontato(); ?>"
                                       onclick="editarContato(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>

                                    <!-- remover -->
                                    <?php if (unserialize($this->session->userdata('acesso'))->getAdmin() == 1){ ?>
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverContato" 
                                       data-toggle="modal" data-target="#mdlRemoverContato"
                                       data-id="<?php echo $value->getIdcontato(); ?>"
                                       onclick="removerContato(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </div>
                            </a>
                        </h4>
                    </div>

                    <div id="<?php echo 'collapse'.$value->getIdcontato(); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo 'heading'.$value->getIdcontato(); ?>">
                        <div class="panel-body">
                            <?php echo '<strong>Contato: </strong>'.$value->getContato().'</br>'; ?>
                            <?php echo '<strong>Informações: </strong>'.nl2br($value->getObs()); ?>
                        </div>
                    </div>

                </div>
                <?php }?>
            </div>
            <?php } else {?>
            <!-- Mensagem que não há cadastros -->
            <div class="alert alert-info alert-dismissible text-center alerta" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Não há <strong>contatos</strong> cadastrados.
            </div>
            <?php }?> 
        </div>
        
    </div><!-- fim row -->
    
    
    
    <!-- paginação -->
    <?php if (isset($paginas)){  ?>
    <div class="pagina-direita">
        <nav aria-label="Page navigation">
            <?php echo $paginas; ?>
        </nav>
    </div>
    <?php }  ?>
    
</div>