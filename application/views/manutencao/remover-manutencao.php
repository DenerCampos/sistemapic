<!-- Modal de remover manutencao -->
<div id="mdlRemoverManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Deseja remover este equipamento da manutenção?</strong></div>
            
            <!-- Formulario remover manutenção -->
            <form class="formulario" method="post" 
                  action="<?php echo base_url("manutencao/removeManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row"> 
                        <!-- Campo id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRmvUrl" id="iptRmvUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptRmvEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptRmvEquipamento" id="iptRmvEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true" disabled="">
                            </div>
                        </div>  
                        <!-- Campo data do defeito -->
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
                    <button type="submit" class="btn btn-danger carregando">
                        Remover
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>