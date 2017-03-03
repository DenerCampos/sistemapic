<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- configuração de email  -->
    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
        <div class="row">
            <div class="novo-chamado col-md-6">
                <button class="btn btn-primary" type="submit" href="#mdlCriarEmailConf" 
                        data-toggle="modal" data-target="#mdlCriarEmailConf" role="button">
                    Nova configuração de e-mail
                </button>
            </div>
            <div class="pesquisar-chamado col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Busca por nome...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Buscar!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
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
                            <!--Todos emails-->
                            <?php if (isset($emailconf)) {?>
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
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <nav aria-label="Page navigation">
            <?php echo $paginas; ?>
        </nav>        
    </div>
</div> <!--fim row-->