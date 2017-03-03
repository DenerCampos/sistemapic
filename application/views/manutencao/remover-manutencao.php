<!-- Modal de remover manutencao -->
<div id="mdlRemoverManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover manutenção</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Deseja remover este equipamento?</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("manutencao/excluirManutencao") ?>">
                <div class="modal-body">
                    <div class="row">  
                        <div class="col-md-12" hidden="">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptRmvEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptRmvEquipamento" id="iptRmvEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true" disabled="">
                            </div>
                        </div>                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRmvDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptRmvDataDefeito" id="iptRmvDataDefeito" 
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
                        Remover
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>