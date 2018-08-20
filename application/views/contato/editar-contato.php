<!-- Modal de editar contato -->
<div id="mdlEditarContato"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarContato" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Edição contato</h4>
            </div>
            
            <!-- Mensagem de erro -->
           <div class="alert alert-danger text-center" id="erro-editar-contato" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmEdtContato" method="post" action="<?php echo base_url("contato/editar") ?>">
                <div class="modal-body">
                    <div class="row"> 
                        
                        <!-- url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        
                        <!-- id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        
                        <!-- empresa -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtEmpresa" class="control-label">Empresa:</label>
                                <input type="text" name="iptEdtEmpresa" id="iptEdtEmpresa" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        
                        <!-- tel -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtTel" class="control-label">Telefone:</label>
                                <input type="text" name="iptEdtTel" id="iptEdtTel" 
                                       class="form-control" placeholder="Telefone" required="true">
                            </div>
                        </div>  
                        
                        <!-- contato -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtContato" class="control-label">Contato:</label>
                                <input type="text" name="iptEdtContato" id="iptEdtContato" 
                                       class="form-control" placeholder="Nome">
                            </div>
                        </div>   
                      
                        <!-- Observação -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtObs" class="control-label">Informações importantes:</label>
                                <textarea class="form-control" id="iptEdtObs" name="iptEdtObs"
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
                        Salvar
                    </button>
                </div>
                
            </form><!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>