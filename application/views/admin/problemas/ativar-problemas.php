<!-- Modal de ativar problema -->
<div id="mdlAtivarProblema"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlAtivarProblema" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Ativar problema</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Tem certeza?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/problema_admin/ativaProblema") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptAtvId" class="control-label">Id:</label>
                                <input type="text" name="iptAtvId" id="iptAtvId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptAtvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptAtvUrl" id="iptAtvUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptAtvNome" class="control-label">Nome:</label>
                                <input type="text" name="iptAtvNome" id="iptAtvNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptAtvDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptAtvDesc" maxlength="100" name="iptAtvDesc"
                                  placeholder="Descrição do problema" rows="3"></textarea>
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