<!-- Modal de editar patrimonio -->
<div id="mdlEditarPatrimonio"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarPatrimonio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Edição equipamento patrimonial</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-editar-patrimonio" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmEdtPatrimonio" method="post" action="<?php echo base_url("patrimonio/editar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptEdtEquipamento" class="control-label">Nome:</label>
                                <input type="text" name="iptEdtEquipamento" id="iptEdtEquipamento" 
                                       class="form-control" placeholder="Nome do equipamento" required="true">
                            </div>
                        </div>
                        <!-- patrimonio -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="number" name="iptEdtPatrimonio" id="iptEdtPatrimonio" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <!-- serial -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtSerial" class="control-label">Serial:</label>
                                <input type="text" name="iptEdtSerial" id="iptEdtSerial" 
                                       class="form-control" placeholder="Serial">
                            </div>
                        </div>
                        <!-- modelo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtModelo" class="control-label">Modelo:</label>
                                <input type="text" name="iptEdtModelo" id="iptEdtModelo" 
                                       class="form-control" placeholder="Modelo">
                            </div>
                        </div>    
                        <!-- descricao -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptEdtDesc" name="iptEdtDesc"
                                  placeholder="Dados adicionais" rows="3"></textarea>
                            </div>
                        </div>
                        <!-- Fornecedor -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtFornecedor" class="control-label">Fornecedor:</label>
                                <input type="text" name="iptEdtFornecedor" id="iptEdtFornecedor" 
                                       class="form-control" placeholder="Nome">
                            </div>
                        </div>
                        <!-- local -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selEdtLocal" class="control-label">Local:</label>
                                <select name="selEdtLocal" id="selEdtLocal" 
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
                        Salvar
                    </button>
                </div>
                
            </form> <!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>