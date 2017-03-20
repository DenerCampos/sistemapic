<!-- Modal de atender chamado -->
<div id="mdlImprimirChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlImprimirChamado" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Imprimir chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Deseja imprimir este chamado?</strong></div>
            <form class="" method="post" target="_blank"
                  action="<?php echo base_url("ocorrencia/imprimir") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptImpId" class="control-label">Id:</label>
                                <input type="text" name="iptImpId" id="iptImpId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptImpUrl" class="control-label">Url:</label>
                                <input type="text" name="iptImpUrl" id="iptImpUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptImpNumero" class="control-label">Numero:</label>
                                <input type="text" name="iptImpNumero" id="iptImpNumero" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptImpUsuario" class="control-label">Usuário:</label>
                                <input type="text" name="iptImpUsuario" id="iptImpUsuario" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptImpProblema" class="control-label">Problema:</label>
                                <input type="text" name="iptImpProblema" id="iptImpProblema" 
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
                        Gerar impressão
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>