<!-- Modal de atender chamado -->
<div id="mdlRemoverChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverChamado" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Excluir chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Deseja remover este chamado?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("ocorrencia/remover") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRmvUrl" id="iptRmvUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptRmvNumero" class="control-label">Numero:</label>
                                <input type="text" name="iptRmvNumero" id="iptRmvNumero" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptRmvUsuario" class="control-label">Usuário:</label>
                                <input type="text" name="iptRmvUsuario" id="iptRmvUsuario" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptRmvProblema" class="control-label">Problema:</label>
                                <input type="text" name="iptRmvProblema" id="iptRmvProblema" 
                                       class="form-control" required="true" disabled="">
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