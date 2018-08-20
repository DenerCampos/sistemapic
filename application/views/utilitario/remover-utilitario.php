<!-- Modal de remover Utilitario -->
<div id="mdlRemoverUtilitario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverUtilitario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover programa</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">Será excluido do banco de dados. <strong>Tem certeza?</strong></div>
            
            <!-- Formulario -->
            <form class="frmRmvUtilitario" method="post" action="<?php echo base_url("utilitario/remover") ?>">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptRmvNome" class="control-label">Nome programa:</label>
                                <input type="text" name="iptRmvNome" id="iptRmvNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>   
                      
                        <!-- descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptRmvDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptRmvDescricao" name="iptRmvDescricao"
                                  placeholder="Descrição do programa" rows="3"></textarea>
                            </div>
                        </div>
                        
                    </div> <!-- Fim row -->
                </div> <!-- Fim corpo modal -->
                
                <!--rodape modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger carregando">
                        Remover
                    </button>
                </div> 
                
            </form><!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>