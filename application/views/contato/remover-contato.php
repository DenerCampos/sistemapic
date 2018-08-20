<!-- Modal de remover Contato -->
<div id="mdlRemoverContato"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverContato" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover contato</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">Será excluido do banco de dados. <strong>Tem certeza?</strong></div>
            
            <!-- Formulario -->
            <form class="" method="post" action="<?php echo base_url("contato/remover") ?>">
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
                        
                         <!-- empresa -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvEmpresa" class="control-label">Empresa:</label>
                                <input type="text" name="iptRmvEmpresa" id="iptRmvEmpresa" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        
                        <!-- tel -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvTel" class="control-label">Telefone:</label>
                                <input type="text" name="iptRmvTel" id="iptRmvTel" 
                                       class="form-control" placeholder="Telefone" required="true">
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