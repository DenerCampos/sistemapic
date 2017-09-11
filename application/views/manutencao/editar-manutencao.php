<!-- Modal de editar manutencao -->
<div id="mdlEditarManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center alerta-editar-manutencao" id="erro-editar-manutencao"></div>
            
            <!-- Formulario editar manutenção -->
            <form class="formulario" id="frmEdtManutencao" method="post" 
                  action="<?php echo base_url("manutencao/atualizaManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Campo id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId" 
                                       class="form-control">
                            </div>
                        </div>
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptEdtEquipamento" id="iptEdtEquipamento" 
                                       class="form-control" placeholder="Nome do equipamento." required="true">
                            </div>
                        </div>
                        <!-- Campo defeito -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtDefeito" class="control-label">Defeito:</label>
                                <input type="text" name="iptEdtDefeito" id="iptEdtDefeito" 
                                       class="form-control" placeholder="Provável defeito">
                            </div>
                        </div> 
                        <!-- Campo fornecedor -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptEdtFornecedor" class="control-label">Fornecedor:</label>
                                <input type="text" name="iptEdtFornecedor" id="iptEdtFornecedor" 
                                       class="form-control" placeholder="Nome do fornecedor.">
                            </div>
                        </div> 
                        <!-- Campo data do defeito -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptEdtDataDefeito" id="iptEdtDataDefeito" 
                                       class="form-control" value="<?php echo date("Y-m-d");?>" disabled="">
                            </div>
                        </div>
                        <!-- Campo descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptEdtDescricao" maxlength="200" name="iptEdtDescricao"
                                  placeholder="Dados do equipamento. &NewLine;Ex: Serial do equipamento..." rows="2"></textarea>
                            </div>
                        </div>
                        <!-- Campo patrimonio do pic -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="iptEdtPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="text" name="iptEdtPatrimonio" id="iptEdtPatrimonio" 
                                       class="form-control" placeholder="0000">
                            </div>
                        </div>
                        <!-- Campo unidade -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtUnidade" class="control-label">Unidade:</label>
                                <select name="selEdtUnidade" id="selEdtUnidade" 
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
                                <label for="selEdtSetor" class="control-label">Setor:</label>
                                <select name="selEdtSetor" id="selEdtSetor" 
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