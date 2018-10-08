<!-- Modal de criar patrimonio -->
<div id="mdlCriarPatrimonio"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarPatrimonio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Novo equipamento patrimonial</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-cria-patrimonio" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmCriPatrimonio" method="post" action="<?php echo base_url("patrimonio/criar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptCriUrl" class="control-label">Url:</label>
                                <input type="text" name="iptCriUrl" id="iptCriUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptCriEquipamento" class="control-label">Nome:</label>
                                <input type="text" name="iptCriEquipamento" id="iptCriEquipamento" 
                                       class="form-control" placeholder="Nome do equipamento" required="true">
                            </div>
                        </div>
                        <!-- patrimonio -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="number" name="iptCriPatrimonio" id="iptCriPatrimonio" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <!-- serial -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriSerial" class="control-label">Serial:</label>
                                <input type="text" name="iptCriSerial" id="iptCriSerial" 
                                       class="form-control" placeholder="Serial">
                            </div>
                        </div>
                        <!-- modelo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriModelo" class="control-label">Modelo:</label>
                                <input type="text" name="iptCriModelo" id="iptCriModelo" 
                                       class="form-control" placeholder="Modelo">
                            </div>
                        </div>    
                        <!-- descricao -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptCriDesc" name="iptCriDesc"
                                  placeholder="Dados adicionais" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- Fornecedor -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriFornecedor" class="control-label">Fornecedor:</label>
                                <input type="text" name="iptCriFornecedor" id="iptCriModelo" 
                                       class="form-control" placeholder="Modelo">
                            </div>
                        </div>
                        <!-- local -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selCriLocal" class="control-label">Local:</label>
                                <select name="selCriLocal" id="selCriLocal" 
                                        class="form-control" placeholder="Seleciona tipo">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($locais as $local) { ?>
                                    <option>
                                        <?php echo $local->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                        
                        
                        
                    </div> <!-- Fim row -->
                </div> <!-- Fim corpo modal -->
                <!--rodape modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Criar
                    </button>
                </div>
                
            </form> <!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>