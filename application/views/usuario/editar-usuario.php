<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="row">
    
    <!-- Mensagem de erro -->
    <div class="alert alert-danger text-center" id="erro-editar-usuario" hidden=""></div>
    
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <!-- Formulario -->
            <form class="" id="frmEdtUsuario" method="post" enctype="multipart/form-data"
                      action="<?php echo base_url("usuario/atualizaUsuario") ?>">
                
                <!-- Foto -->
                <div class="col-md-3">
                    <div class="imagem-usuario">                        
                        <img class="foto-usuario img-circle img-thumbnail img-responsive"
                             src="<?php echo $this->session->userdata('foto');?>">
                    </div>                
                    <div class="arquivo">
                        <label class="btn btn-primary" for="iptEdtFoto">
                            <input class="arquivo" id="iptEdtFoto" name="iptEdtFoto" type="file">
                            Escolher arquivo
                        </label>
                    </div>
                </div>
                
                <!-- Edição -->
                <div class="col-md-9 form-usuario">
                    <div class="modal-body">
                        <div class="row">
                            <!-- ID -->
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <label for="iptEdtId" class="control-label">Id:</label>
                                    <input type="text" name="iptEdtId" id="iptEdtId"  value="<?php echo $this->session->userdata("id"); ?>"
                                           class="form-control" placeholder="Seu nome" required="true">
                                </div>
                            </div>
                            <!-- URL -->
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <label for="iptEdtUrl" class="control-label">Url:</label>
                                    <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo current_url(); ?>"
                                           class="form-control" placeholder="" required="true">
                                </div>
                            </div>
                            <!-- Nome -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iptEdtNome" class="control-label">Nome:</label>
                                    <input type="text" name="iptEdtNome" id="iptEdtNome" value="<?php echo $this->session->userdata("nome"); ?>"
                                           class="form-control" placeholder="Seu nome" required="true">
                                </div>
                            </div>
                            <!-- email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iptEdtEmail" class="control-label">E-mail:</label>
                                    <input type="email" name="iptEdtEmail" id="iptEdtEmail" required="true" value="<?php echo $this->session->userdata("login"); ?>"
                                           class="form-control" placeholder="Seu e-mail">
                                </div>
                            </div>
                            <!-- senha atual -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iptEdtSenhaAtual" class="control-label">Senha atual:</label>
                                    <input type="password" name="iptEdtSenhaAtual" id="iptEdtSenhaAtual" 
                                           class="form-control" placeholder="********">
                                </div>
                            </div>
                            <!-- nova senha -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iptEdtSenha" class="control-label">Nova senha:</label>
                                    <input type="password" name="iptEdtSenha" id="iptEdtSenha" 
                                           class="form-control" placeholder="********">
                                </div>
                            </div>
                            <!-- Repete nova senha-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iptEdtRSenha" class="control-label">Repita nova senha:</label>
                                    <input type="password" name="iptEdtRSenha" id="iptEdtRSenha" 
                                           class="form-control" placeholder="*********">
                                </div>
                            </div>                    
                        </div>
                    </div>
                    <div class="btn-usuario">
                        <button type="submit" class="btn btn-primary carregando">
                            Salvar
                        </button>
                    </div>                         
                </div>
            </form>
        </div>
    </div>
</div>