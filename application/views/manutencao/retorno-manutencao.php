<!-- Modal de retorno manutencao -->
<div id="mdlRetornoManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRetornoManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Retorno da manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">
                Se for uma impressora fiscal, emita uma <strong>leitura X!</strong> <br/>
                Se for qualquer outro tipo de equipamento, <strong>ligue e teste!</strong> <br/>
                Caso apresente problema, encerre esta manutenção e na parte de garantia clique na opçao <strong>defeito</strong> para repetir o processo.
            </div>
            
            <!-- Formulario retorno manutenção -->
            <form class="formulario" method="post" 
                  action="<?php echo base_url("manutencao/retornoManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">  
                        <!-- Campo id -->
                        <div class="col-md-12 hidden" >
                            <div class="form-group">
                                <label for="iptRtnId" class="control-label">Id:</label>
                                <input type="text" name="iptRtnId" id="iptRtnId" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRtnUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRtnUrl" id="iptRtnUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptRtnEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptRtnEquipamento" id="iptRtnEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true" disabled="">
                            </div>
                        </div>   
                        <!-- Campo data do defeito -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRtnDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptRtnDataDefeito" id="iptRtnDataDefeito" disabled="" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo data do envio para manutenção -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRtnDataEnvio" class="control-label">Data envio:</label>
                                <input type="date" name="iptRtnDataEnvio" id="iptRtnDataEnvio" disabled="" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo data do retorno -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRtnDataRetorno" class="control-label">Data retorno:</label>
                                <input type="date" name="iptRtnDataRetorno" id="iptRtnDataRetorno" 
                                       class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <!-- Campo dias de garantia -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selRtnGarantia" class="control-label">Garantia (em dias):</label>
                                <select name="selRtnGarantia" id="selRtnGarantia" 
                                        class="form-control">
                                    <option>0</option>
                                    <option>30</option>
                                    <option>60</option>
                                    <option selected="">90</option>
                                    <option>120</option>
                                    <option>150</option>
                                    <option>180</option>
                                </select>
                            </div>
                        </div>
                        <!-- Campo descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptRtnSolucao" class="control-label">Solução do reparo:</label>
                                <textarea class="form-control" id="iptCriDescricao" maxlength="1000" name="iptRtnSolucao"
                                          placeholder="Descreva a solução par ao reparo..." rows="2"></textarea>
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