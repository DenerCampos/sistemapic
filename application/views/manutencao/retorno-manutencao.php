<!-- Modal de retorno manutencao -->
<div id="mdlRetornoManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRetornoManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Retorno da manutenção</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">
                Teste a impressora, emita uma <strong>leitura X.</strong>
            </div>
            <form class="formulario" method="post" 
                  action="<?php echo base_url("manutencao/retornoManutencao") ?>">
                <div class="modal-body">
                    <div class="row">  
                        <div class="col-md-12 hidden" >
                            <div class="form-group">
                                <label for="iptRtnId" class="control-label">Id:</label>
                                <input type="text" name="iptRtnId" id="iptRtnId" 
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRtnUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRtnUrl" id="iptRtnUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptRtnEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptRtnEquipamento" id="iptRtnEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true" disabled="">
                            </div>
                        </div>                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRtnDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptRtnDataDefeito" id="iptRtnDataDefeito" disabled="" 
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRtnDataRetorno" class="control-label">Data retorno:</label>
                                <input type="date" name="iptRtnDataRetorno" id="iptRtnDataRetorno" 
                                       class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selRtnGarantia" class="control-label">Garantia (em dias):</label>
                                <select name="selRtnGarantia" id="selRtnGarantia" 
                                        class="form-control">
                                    <option>30</option>
                                    <option>60</option>
                                    <option selected="">90</option>
                                    <option>120</option>
                                    <option>150</option>
                                    <option>180</option>
                                </select>
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