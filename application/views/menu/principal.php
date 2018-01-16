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
            <?php if ($this->session->has_userdata('acesso')){ ?>            
            <ul class="nav navbar-nav">
                
                <!--Help-desk-->
                <?php if (unserialize($this->session->userdata('acesso'))->getOcorrencia() == 1){ ?>                
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'helpdesk')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('ocorrencia'); ?>">Help-Desk</a>
                </li>
                <?php } ?>
                
                <!--Relatorios-->
                <?php if (unserialize($this->session->userdata('acesso'))->getRelatorio() == 1){ ?> 
                <li role="presentation" class="dropdown <?php if (isset($ativo) && ($ativo == 'relatorio')){ echo 'active';} ?>">
                    <a class="dropdown-toggle nav-link navbar-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Relatórios <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('plantao'); ?>">Relatório Plantão</a>
                        </li>
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('relatorio/geral'); ?>" >Relatório Geral</a>
                        </li> 
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('relatorio/setor'); ?>" >Relatório por setor</a>
                        </li> 
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('relatorio/usuario'); ?>" >Relatório por usuário</a>
                        </li>
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('relatorio/tecnico'); ?>" >Relatório por técnico</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                
                <!--Caixas-->
                <?php if (unserialize($this->session->userdata('acesso'))->getCaixa() == 1){ ?> 
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'caixa')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('caixa'); ?>">Caixas</a>
                </li>
                <?php } ?>
                
                <!--Manutencao-->
                <?php if (unserialize($this->session->userdata('acesso'))->getManutencao() == 1){ ?> 
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'manutencao')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('manutencao/defeito'); ?>">Manutenções</a>
                </li>
                <?php } ?>
                
                <!--Equipamentos-->
                <?php if (unserialize($this->session->userdata('acesso'))->getEquipamento() == 1){ ?> 
                <li role="presentation" class="dropdown <?php if (isset($ativo) && ($ativo == 'equipamento')){ echo 'active';} ?>">
                    <a class="dropdown-toggle nav-link navbar-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Equipamentos <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('maquina'); ?>">Maquinas (IP)</a>
                        </li>
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('pinpad'); ?>" >PinPads</a>
                        </li> 
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('pos'); ?>" >POS</a>
                        </li>
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('fiscal'); ?>" >Impressoras Fiscais</a>
                        </li>
                        <li>
                            <a class="navbar-link" href="<?php echo base_url('impressora'); ?>" >Impressoras</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                
                <!--Admin-->
                <?php if ($this->session->userdata('nivel') == 0){ ?> 
                <li role="presentation" class="<?php if (isset($ativo) && ($ativo == 'admin')){ echo 'active';} ?>">
                    <a class="nav-link navbar-link" href="<?php echo base_url('administracao'); ?>">Admin</a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
                       
            <?php if ($this->session->has_userdata('nome')){ ?>
            <div class="navbar-right">
                
                <!-- Notificações -->
                <ul class="nav navbar-nav">
                    
                    <li class="dropdown">
                        
                        <a id="notificacao-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
                           aria-expanded="false" title="Notificações">
                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            <span id="notif-qtd"></span>
                            <span class="caret"></span>
                        </a>
                        
                        <ul id="notificacao" class="dropdown-menu navbar-notificacao">
                            
                            <li class="carregamento-notificacao">
                                <div>
                                    <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                </div>
                            </li>
                            
                        </ul>
                        
                        
                    </li>
                    
                </ul>
                
                <!-- Perfil usuario logado-->
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
                                                <?php if (unserialize($this->session->userdata('acesso'))->getUsuario() == 1){ ?> 
                                                <a href="<?php echo base_url('usuario/editar'); ?>" class="btn btn-primary btn-block btn-sm">Editar perfil</a>
                                                <?php } ?>
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
            
            <!-- Perfil usuario não logado-->
            <div class="navbar-right">
               <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            Entrar 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-logar-head">
                                    <div class="row">
                                         <div class="col-md-12">
                                             <i class="fa fa-users" aria-hidden="true"></i>
                                             Login
                                        </div>
                                    </div>                                   
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-logar-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="" id="frmLogarMenu" method="post" action="<?php echo base_url("login/logar") ?>">
                                                <div class="form-group">
                                                    <label for="iptEmail" class="control-label">Email</label>                                                    
                                                    <input type="email" name="iptEmail" id="iptEmail" placeholder="email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="iptSenha" class="control-label">Senha</label>
                                                    <input type="password" name="iptSenha" id="iptSenha" placeholder="senha" class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block carregando">
                                                    Entrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>                                    
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>                                
                                <div class="text-right criar-conta">
                                    <a class="criar-conta btn btn-warning" href="#mdlCriarUsuario" data-toggle="modal" 
                                       data-target="#mdlCriarUsuario" role="button">
                                        Criar nova conta
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php }?>
            
        </div>
    </div> 
</nav>