<!-- Modal de Esqueci Senha -->
<div id="mdlEsqueciSenha"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEsqueciSenha" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Recuperar senha</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-esqueci-senha" hidden=""></div>
            <form class="formulario" id="frmEsqueciSenha" method="post" 
                  action="<?php echo base_url("login/recuperarSenha") ?>">
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEsqueciSenhaUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEsqueciSenhaUrl" id="iptEsqueciSenhaUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEsqueciSenhaEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptEsqueciSenhaEmail" id="iptEsqueciSenhaEmail" required="true"
                                       class="form-control" placeholder="Seu e-mail cadastrado no sistema">
                            </div>
                        </div>                                           
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Enviar e-mail
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>