<!-- Modal de remover email conf -->
<div id="mdlRemoverEmailConf"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverEmailConf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover configuração de e-mail</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Tem certeza?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/email_conf_admin/desabilitaEmailConf") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvUsername" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptRmvUsername" id="iptRmvUsername" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvHost" class="control-label">Nome do host:</label>
                                <input type="text" name="iptRmvHost" id="iptRmvHost" required="true"
                                       class="form-control" placeholder="E-mail">
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