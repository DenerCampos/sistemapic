<!-- Modal sem conserto manutencao -->
<div id="mdlSemConsertoManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlSemConsertoManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Equipamento sem conserto</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            
            <!-- Formulario retorno manutenção -->
            <form class="formulario" method="post" 
                  action="<?php echo base_url("manutencao/semconsertoManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">  
                        <!-- Campo id -->
                        <div class="col-md-12 hidden" >
                            <div class="form-group">
                                <label for="iptScmId" class="control-label">Id:</label>
                                <input type="text" name="iptScmId" id="iptScmId" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptScmUrl" class="control-label">Url:</label>
                                <input type="text" name="iptScmUrl" id="iptScmUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptScmEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptScmEquipamento" id="iptScmEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true" disabled="">
                            </div>
                        </div>   
                        <!-- Campo data do defeito -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptScmDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptScmDataDefeito" id="iptScmDataDefeito" disabled="" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo motivo -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptScmMotivo" class="control-label">Motivo:</label>
                                <textarea class="form-control" id="iptScmMotivo" maxlength="200" name="iptScmMotivo"
                                          placeholder="Motivo no qual não teve conserto..." rows="3" required=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>