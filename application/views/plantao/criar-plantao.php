<!-- Modal de criar chamado -->
<div id="mdlCriarPlantao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarPlantao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Gerar relatório plantão</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-gerar-plantao" hidden=""></div>
            
            <!-- Formulario -->
            <form class="formulario" id="frmGeraPlantao" method="post" 
                  action="<?php echo base_url("plantao/gerar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriDataInicio" class="control-label">Data inicio:</label>
                                <input type="date" name="iptCriDataInicio" id="iptCriDataInicio"
                                       class="form-control" value="<?php echo date("Y-m-d", strtotime(date("Y-m-d")) - 86400);?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriDataFim" class="control-label">Data fim:</label>
                                <input type="date" name="iptCriDataFim" id="iptCriDataFim"
                                       class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                    </div>
                    <!-- Opções de relatórios -->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="itpRelAberto" id="itpRelAberto" value="aberto" checked="true"> Abertos.
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="itpRelAtendimento" id="itpRelAtendimento" value="atendimento" checked="true"> Em atendimentos.
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="itpRelFechado" id="itpRelFechado" value="fechado" checked="true"> Fechados.
                            </label>
                        </div>
                    </div>                    
                </div>                           
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Gerar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>