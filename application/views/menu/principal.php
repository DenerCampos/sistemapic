<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Menu  -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                    data-target="#navbar-opcoes" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img class="logo-principal" alt="PIC" 
                     src="<?php echo$assetsUrl ?>/img/logo-pic.png" />
            </a>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar-opcoes">
            <!--menu-->
            <?php if (!$this->session->has_userdata('nivel')){ ?>
            
            <?php } ?>
            <!--menu usuario-->
            <?php if ($this->session->userdata('nivel') === '2'){ ?>
            <ul class="nav navbar-nav">
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'helpdesk')){ echo 'active';} ?>">
                    <a class="navbar-link" href="<?php echo base_url('ocorrencia'); ?>">Help-Desk</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'caixa')){ echo 'active';} ?>">
                    <a class="navbar-link" href="<?php echo base_url('caixa'); ?>">Caixas</a>
                </li>
            </ul>
            <?php } ?>
            <!--menu tecnico-->
            <?php if ($this->session->userdata('nivel') === '1'){ ?>
            <ul class="nav navbar-nav">
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'helpdesk')){ echo 'active';} ?>">
                    <a class="navbar-link" href="<?php echo base_url('ocorrencia'); ?>">Help-Desk</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'plantao')){ echo 'active';} ?>">
                    <a class="navbar-link " href="<?php echo base_url('plantao'); ?>">Relatório Plantão</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'caixa')){ echo 'active';} ?>">
                    <a class="navbar-link" href="<?php echo base_url('caixa'); ?>">Caixas</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'manutencao')){ echo 'active';} ?>">
                    <a class="navbar-link" href="<?php echo base_url('manutencao/defeito'); ?>">Manutenção Impressora</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'maquina')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('maquina'); ?>">IP´s maquinas PP</a>
                </li>
            </ul>
            <?php } ?>
            <!--menu admin-->
            <?php if ($this->session->userdata('nivel') === '0'){ ?>
            <ul class="nav navbar-nav">
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'helpdesk')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('ocorrencia'); ?>">Help-Desk</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'plantao')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link " href="<?php echo base_url('plantao'); ?>">Relatório Plantão</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'caixa')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('caixa'); ?>">Caixas</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'manutencao')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('manutencao/defeito'); ?>">Manutenções</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'maquina')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('maquina'); ?>">IP´s maquinas PP</a>
                </li>
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'admin')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('administracao'); ?>">Admin</a>
                </li>
            </ul>
            <?php } ?>
            
            <?php if ($this->session->has_userdata('nome')){ ?>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <?php echo $this->session->userdata('nome'); ?> 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="imagem-perfil-edit">
<!--                                                <i class="fa fa-user-circle-o icon-size"></i>-->
                                                <img class="imagem-size img-circle img-thumbnail img-responsive"
                                                     src="<?php echo $this->session->userdata('foto');?>">
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left"><strong> <?php echo $this->session->userdata('nome'); ?></strong></p>
                                            <p class="text-left small"> <?php echo $this->session->userdata('login'); ?></p>
                                            <p class="text-left">
                                                <a href="<?php echo base_url('usuario/editar'); ?>" class="btn btn-primary btn-block btn-sm">Editar perfil</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="<?php echo base_url('login/logoff'); ?>" class="btn btn-danger btn-block">Sair do sistema</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php } else {?>
            
            <div class="navbar-right">
               <ul class="nav navbar-nav">
                    <li class="active">
                        <a class="navbar-link trigger" href="#" role="button">Entrar</a>
                        <div class="head hide">
                            Login
                        </div>
                        <div class="content hide">
                            <form class="" method="post" 
                                  accept-charset=""action="<?php echo base_url("login/logar") ?>">
                                <div class="form-group">
                                    <label for="iptEmail">Email</label>
                                    <input type="email" class="form-control" name="iptEmail" id="iptEmail" placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="iptSenha">Senha</label>
                                    <input type="password" class="form-control" name="iptSenha" id="iptSenha" placeholder="senha">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Entrar
                                </button>
                            </form>
                            <div class="text-right criar-conta">
                                <a class="criar-conta" href="#mdlCriarUsuario" data-toggle="modal" 
                                   data-target="#mdlCriarUsuario" role="button" onclick="esconderLogin()">
                                    Criar conta
                                </a>
                            </div>
                        </div>
                    </li>
                </ul> 
            </div>
            <?php }?>
            
        </div>
    </div> 
</nav>