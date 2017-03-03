<!-- Modal de enviar manutencao -->
<div id="mdlEnviarManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEnviarManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Enviar para manutenção</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("manutencao/enviarManutencao") ?>">
                <div class="modal-body">
                    <div class="row">  
                        <div class="col-md-12" hidden="">
                            <div class="form-group">
                                <label for="iptEnvId" class="control-label">Id:</label>
                                <input type="text" name="iptEnvId" id="iptEnvId" 
                                       class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptEnvEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptEnvEquipamento" id="iptEnvEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true">
                            </div>
                        </div>                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEnvDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptEnvDataDefeito" id="iptEnvDataDefeito" 
                                       class="form-control" disabled="">
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>