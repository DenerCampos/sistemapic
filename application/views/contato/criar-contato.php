<!-- Modal de criar contato -->
<div id="mdlCriarContato"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarContato" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Novo contato</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-cria-contato" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmCriContato" method="post" action="<?php echo base_url("contato/criar") ?>">
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
                        
                        <!-- empresa -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriEmpresa" class="control-label">Empresa:</label>
                                <input type="text" name="iptCriEmpresa" id="iptCriEmpresa" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        
                        <!-- tel -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriTel" class="control-label">Telefone:</label>
                                <input type="text" name="iptCriTel" id="iptCriTel" 
                                       class="form-control" placeholder="Telefone" required="true">
                            </div>
                        </div>  
                        
                        <!-- contato -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriContato" class="control-label">Contato:</label>
                                <input type="text" name="iptCriContato" id="iptCriContato" 
                                       class="form-control" placeholder="Nome">
                            </div>
                        </div>   
                      
                        <!-- Observação -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriObs" class="control-label">Informações importantes:</label>
                                <textarea class="form-control" id="iptCriObs" name="iptCriObs"
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
                    <button type="submit" class="btn btn-primary">
                        Criar
                    </button>
                </div>
                
            </form> <!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>