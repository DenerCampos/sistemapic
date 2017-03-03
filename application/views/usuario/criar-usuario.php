<!-- Modal de criar usuario -->
<div id="mdlCriarUsuario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar conta</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="erro" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("usuario/criar") ?>">
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriNome" class="control-label">Nome:</label>
                                <input type="text" name="iptCriNome" id="iptCriNome" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptCriEmail" id="iptCriEmail" required="true"
                                       class="form-control" placeholder="Seu e-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriSenha" class="control-label">Senha:</label>
                                <input type="password" name="iptCriSenha" id="iptCriSenha" required="true" 
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriRSenha" class="control-label">Repita senha:</label>
                                <input type="password" name="iptCriRSenha" id="iptCriRSenha" required="true"
                                       class="form-control" placeholder="">
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>