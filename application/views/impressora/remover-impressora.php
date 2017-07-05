<!-- Modal de remover impressora -->
<div id="mdlRemoverImpressora"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverImpressora" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover Impressora</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">Será excluido do banco de dados. <strong>Tem certeza?</strong></div>
            
            <!-- Formulario -->
            <form class="" method="post" action="<?php echo base_url("impressora/remove") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRmvUrl" id="iptRmvUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvNome" class="control-label">Nome:</label>
                                <input type="text" name="iptRmvNome" id="iptRmvNome" 
                                       class="form-control" placeholder="Nome">
                            </div>
                        </div>
                        <!-- modelo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvModelo" class="control-label">Modelo:</label>
                                <input type="text" name="iptRmvModelo" id="iptRmvModelo" 
                                       class="form-control" placeholder="Modelo" required="true">
                            </div>
                        </div>                        
                        <!-- serial -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvSerial" class="control-label">Serial:</label>
                                <input type="text" name="iptRmvSerial" id="iptRmvSerial" 
                                       class="form-control" placeholder="Serial" required="true">
                            </div>
                        </div>                        
                        <!-- local -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selRmvLocal" class="control-label">Local:</label>
                                <select name="selRmvLocal" id="selRmvLocal" 
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
                        <!-- descricao -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptRmvDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptRmvDesc" maxlength="2000" name="iptRmvDesc"
                                  placeholder="Dados adicionais" rows="3"></textarea>
                            </div>
                        </div>
                        
                    </div> <!-- Fim row -->
                </div> <!-- Fim corpo modal -->
                
                <!--rodape modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Remover
                    </button>
                </div> 
                
            </form><!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>