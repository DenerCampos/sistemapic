<!-- Modal de criar usuario -->
<div id="mdlRemoverUsuario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover conta</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Tem certeza?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/usuario_admin/desabilitaUsuario") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRmvUrl" id="iptRmvUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvNome" class="control-label">Nome:</label>
                                <input type="text" name="iptRmvNome" id="iptRmvNome" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptRmvEmail" id="iptRmvEmail" required="true"
                                       class="form-control" placeholder="Seu e-mail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Remover
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>