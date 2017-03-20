<!-- Modal de atender chamado -->
<div id="mdlAtenderChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlAtenderChamado" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Atender chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Deseja atender este chamado?</strong></div>
            <form class="formulario" method="post" 
                  action="<?php echo base_url("ocorrencia/atender") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptAtdId" class="control-label">Id:</label>
                                <input type="text" name="iptAtdId" id="iptAtdId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptAtdUrl" class="control-label">Url:</label>
                                <input type="text" name="iptAtdUrl" id="iptAtdUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptAtdNumero" class="control-label">Numero:</label>
                                <input type="text" name="iptAtdNumero" id="iptAtdNumero" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptAtdUsuario" class="control-label">Usuário:</label>
                                <input type="text" name="iptAtdUsuario" id="iptAtdUsuario" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptAtdProblema" class="control-label">Problema:</label>
                                <input type="text" name="iptAtdProblema" id="iptAtdProblema" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Atender
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>