<!-- Modal de ativar email conf -->
<div id="mdlAtivarEmailConf"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlAtivarEmailConf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Ativar configuração de e-mail</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Tem certeza?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/email_conf_admin/ativaEmailConf") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptAtvId" class="control-label">Id:</label>
                                <input type="text" name="iptAtvId" id="iptAtvId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptAtvUsername" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptAtvUsername" id="iptAtvUsername" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptAtvHost" class="control-label">Nome do host:</label>
                                <input type="text" name="iptAtvHost" id="iptAtvHost" required="true"
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
                        Ativar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>