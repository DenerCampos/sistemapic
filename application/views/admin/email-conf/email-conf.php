<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- configuração de email  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            
            <!-- adicionar -->
            <div class="novo-chamado col-md-6">
                <button class="btn btn-warning" type="submit" href="#mdlCriarEmailConf" 
                        data-toggle="modal" data-target="#mdlCriarEmailConf" role="button">
                    Nova configuração de e-mail
                </button>
            </div>
            
            <!-- Pesquisa-->
            <div class="pesquisar-chamado col-md-6">
                <form class="form-buscar" method="post"
                      action="<?php echo base_url("admin/email_conf_admin/busca") ?>">
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
            <!--Todos emails-->
            <?php if (isset($emailconf)) {?>
            <div class="panel-heading">
                <h3 class="panel-title">Configurações cadastradas</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Usuário SMTP</th>
                                <th>Host SMTP</th>
                                <th>Porta SMTP</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emailconf as $conf) { ?>
                            <tr>
                                <td><?php echo $conf->getUseragent(); ?></td>
                                <td><?php echo $conf->getSmtp_user(); ?></td>
                                <td><?php echo $conf->getSmtp_host(); ?></td>
                                <td><?php echo $conf->getSmtp_port(); ?></td>
                                <td><?php echo $estado->buscaId($conf->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($conf->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarEmailConf" 
                                       data-toggle="modal" data-target="#mdlAtivarEmailConf"
                                       data-id="<?php echo $conf->getIdemail_conf(); ?>"
                                       onclick="ativarEmailConf(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEmailConf" 
                                       data-toggle="modal" data-target="#mdlEditarEmailConf"
                                       data-id="<?php echo $conf->getIdemail_conf(); ?>"
                                       onclick="editarEmailConf(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverEmailConf" 
                                       data-toggle="modal" data-target="#mdlRemoverEmailConf"
                                       data-id="<?php echo $conf->getIdemail_conf(); ?>"
                                       onclick="removerEmailConf(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim email-->
            
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
                                <th>Usuario</th>
                                <th>Usuário SMTP</th>
                                <th>Host SMTP</th>
                                <th>Porta SMTP</th>
                                <th>Estado</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados as $resultado) { ?>
                            <tr>
                                <td><?php echo $resultado->getUseragent(); ?></td>
                                <td><?php echo $resultado->getSmtp_user(); ?></td>
                                <td><?php echo $resultado->getSmtp_host(); ?></td>
                                <td><?php echo $resultado->getSmtp_port(); ?></td>
                                <td><?php echo $estado->buscaId($resultado->getIdestado())->getNome(); ?></td>
                                <td class="text-right opcoes">
                                    <?php if ($resultado->getIdestado() == 2){ ?>                             
                                    <a href="#" title="Ativar" role="button" href="#mdlAtivarEmailConf" 
                                       data-toggle="modal" data-target="#mdlAtivarEmailConf"
                                       data-id="<?php echo $resultado->getIdemail_conf(); ?>"
                                       onclick="ativarEmailConf(this)">
                                        <i class="fa fa-check-square-o" ></i>
                                    </a>
                                    <?php } else {?>
                                    <a href="#" title="Editar" role="button" href="#mdlEditarEmailConf" 
                                       data-toggle="modal" data-target="#mdlEditarEmailConf"
                                       data-id="<?php echo $resultado->getIdemail_conf(); ?>"
                                       onclick="editarEmailConf(this)">
                                        <i class="fa fa-pencil-square-o" ></i>
                                    </a>   
                                    <a href="#" title="Remover" role="button" href="#mdlRemoverEmailConf" 
                                       data-toggle="modal" data-target="#mdlRemoverEmailConf"
                                       data-id="<?php echo $resultado->getIdemail_conf(); ?>"
                                       onclick="removerEmailConf(this)">
                                        <i class="fa fa-remove" ></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php }?>                            
                        </tbody>
                    </table>
                </div>
            </div> <!--Fim corpo-->
            <?php }?> <!--Fim email-->
            
        </div> <!-- fim painel -->
        
        <!--verifica se existe paginaçao-->
        <?php if (isset($paginas)) { ?>
        <nav aria-label="Page navigation" class="nav-admin">
            <?php echo $paginas; ?>
        </nav>
        <?php }?>               
    </div>
</div> <!--fim row-->