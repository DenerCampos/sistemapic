<!-- Modal de visualizar manutencao -->
<div id="mdlVisualizarManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlVisualizarManutencao" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Visualização de manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            
            <!-- Corpo da modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Campo id -->
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label for="iptVslId" class="control-label">Id:</label>
                            <input type="text" name="iptVslId" id="iptVslId" 
                                   class="form-control">
                        </div>
                    </div>
                    <!-- Campo url -->
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label for="iptVslUrl" class="control-label">Url:</label>
                            <input type="text" name="iptVslUrl" id="iptVslUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                   class="form-control" placeholder="" required="true">
                        </div>
                    </div>
                    <!-- Campo equipamento -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iptVslEquipamento" class="control-label">Equipamento:</label>
                            <input type="text" name="iptVslEquipamento" id="iptVslEquipamento" 
                                   class="form-control" placeholder="Nome do equipamento.">
                        </div>
                    </div>
                    <!-- Campo defeito -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iptVslDefeito" class="control-label">Defeito:</label>
                            <input type="text" name="iptVslDefeito" id="iptVslDefeito" 
                                   class="form-control" placeholder="Provável defeito">
                        </div>
                    </div> 
                    <!-- Campo fornecedor -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="iptVslFornecedor" class="control-label">Fornecedor:</label>
                            <input type="text" name="iptVslFornecedor" id="iptVslFornecedor" 
                                   class="form-control" placeholder="Nome do fornecedor.">
                        </div>
                    </div> 
                    <!-- Campo data do defeito -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="iptVslDataDefeito" class="control-label">Data defeito:</label>
                            <input type="date" name="iptVslDataDefeito" id="iptVslDataDefeito" 
                                   class="form-control" value="<?php echo date("Y-m-d");?>">
                        </div>
                    </div>
                    <!-- Campo descrição -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="iptVslDescricao" class="control-label">Descrição:</label>
                            <textarea class="form-control" id="iptVslDescricao" maxlength="200" name="iptVslDescricao"
                              placeholder="Dados do equipamento. &NewLine;Ex: Serial do equipamento..." rows="2"></textarea>
                        </div>
                    </div>
                    <!-- Campo motivo -->
                    <div class="col-md-12 div-vsl-motivo">
                        <div class="form-group">
                            <label for="iptVslmotivo" class="control-label">Motivo:</label>
                            <textarea class="form-control" id="iptVslmotivo" maxlength="200" name="iptVslmotivo"
                              placeholder="Motivo..." rows="2"></textarea>
                        </div>
                    </div>
                    <!-- Campo solução -->
                    <div class="col-md-12 div-vsl-solucao">
                        <div class="form-group">
                            <label for="iptVslSolucao" class="control-label">Solução do reparo:</label>
                            <textarea class="form-control" id="iptVslSolucao" maxlength="200" name="iptVslSolucao"
                              placeholder="Solução..." rows="2"></textarea>
                        </div>
                    </div>
                    <!-- Campo patrimonio do pic -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="iptVslPatrimonio" class="control-label">Patrimônio:</label>
                            <input type="text" name="iptVslPatrimonio" id="iptVslPatrimonio" 
                                   class="form-control" placeholder="0000">
                        </div>
                    </div>
                    <!-- Campo unidade -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selVslUnidade" class="control-label">Unidade:</label>
                            <select name="selVslUnidade" id="selVslUnidade" 
                                    class="form-control" placeholder="Seleciona unidade">
                                <!-- Lista todos -->
                                <?php foreach ($unidades as $unidade) { ?>
                                <option>
                                    <?php echo $unidade->getNome(); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- Campo setor -->
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="selVslSetor" class="control-label">Setor:</label>
                            <select name="selVslSetor" id="selVslSetor" 
                                    class="form-control" placeholder="Seleciona setor">
                                <!-- Lista todos -->
                                <?php foreach ($setores as $setor) { ?>
                                <option>
                                    <?php echo $setor->getNome(); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div> <!-- Fim corpo modal -->
                
            <!-- rodape da modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Fechar
                </button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>