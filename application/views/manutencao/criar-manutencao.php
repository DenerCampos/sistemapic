<!-- Modal de criar manutencao -->
<div id="mdlCriarManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar manutenção</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-nova-manutencao" hidden=""></div>
            
            <!-- Formulario criar manutenção -->
            <form class="formulario" id="frmCriManutencao" method="post" 
                  action="<?php echo base_url("manutencao/criarManutencao") ?>">
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Campo url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptCriUrl" class="control-label">Url:</label>
                                <input type="text" name="iptCriUrl" id="iptCriUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- Campo equipamento -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptCriEquipamento" id="iptCriEquipamento" 
                                       class="form-control" placeholder="Nome do equipamento." required="true">
                            </div>
                        </div>
                        <!-- Campo defeito -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriDefeito" class="control-label">Defeito:</label>
                                <input type="text" name="iptCriDefeito" id="iptCriDefeito" 
                                       class="form-control" placeholder="Provável defeito.">
                            </div>
                        </div>   
                        <!-- Campo fornecedor -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptCriFornecedor" class="control-label">Fornecedor:</label>
                                <input type="text" name="iptCriFornecedor" id="iptCriFornecedor" 
                                       class="form-control" placeholder="Nome do fornecedor.">
                            </div>
                        </div>
                        <!-- Campo data do defeito -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptCriDataDefeito" id="iptCriDataDefeito" 
                                       class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <!-- Campo descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptCriDescricao" maxlength="200" name="iptCriDescricao"
                                          placeholder="Dados do equipamento. &NewLine;Ex: Serial do equipamento..." rows="2"></textarea>
                            </div>
                        </div>
                        <!-- Campo patrimonio do pic -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="iptCriPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="text" name="iptCriPatrimonio" id="iptCriPatrimonio" 
                                       class="form-control" placeholder="0000">
                            </div>
                        </div>
                        <!-- Campo unidade -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriUnidade" class="control-label">Unidade:</label>
                                <select name="selCriUnidade" id="selCriUnidade" 
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
                                <label for="selCriSetor" class="control-label">Setor:</label>
                                <select name="selCriSetor" id="selCriSetor" 
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
                        Criar
                    </button>
                </div>
                
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>