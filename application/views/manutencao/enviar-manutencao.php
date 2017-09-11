<!-- Modal de enviar manutencao -->
<div id="mdlEnviarManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEnviarManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Enviar para manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-enviar-manutencao" hidden=""></div>
            
            <!-- Formulario enviar para manutenção -->
            <form class="formulario" id="frmEnvManutencao" method="post" 
                  action="<?php echo base_url("manutencao/enviarManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Campo id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEnvId" class="control-label">Id:</label>
                                <input type="text" name="iptEnvId" id="iptEnvId" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEnvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEnvUrl" id="iptEnvUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptEnvEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptEnvEquipamento" id="iptEnvEquipamento" 
                                       class="form-control" placeholder="Equipamento" disabled="">
                            </div>
                        </div>
                        <!-- Campo data do envio para manutenção -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEnvDataEnvio" class="control-label">Data envio:</label>
                                <input type="date" name="iptEnvDataEnvio" id="iptEnvDataEnvio" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo fornecedor -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEnvFornecedor" class="control-label">Fornecedor:</label>
                                <input type="text" name="iptEnvFornecedor" id="iptEnvFornecedor" 
                                       class="form-control" placeholder="Nome do fornecedor." disabled="">
                            </div>
                        </div>
                    </div>
                </div><!-- Fim corpo modal -->
                
                <!-- rodape da modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Enviar
                    </button>
                </div>
                
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>