<!-- Modal de enviar e-mail checklist -->
<div id="mdlEmailChecklist"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEmailChecklist" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Enviar e-mail do checklist</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-email-checklist" hidden=""></div>
            
            <!-- Formulario -->
            <form class="formulario" id="frmEmailChecklist" method="post" 
                  action="<?php echo base_url("checklist/enviarEmail") ?>">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEmlId" class="control-label">Id:</label>
                                <input type="text" name="iptEmlId" id="iptEmlId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEmlUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEmlUrl" id="iptEmlUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptEmlNumero" class="control-label">Checklist:</label>
                                <input type="text" name="iptEmlNumero" id="iptEmlNumero" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEmlData" class="control-label">Data checklist:</label>
                                <input type="text" name="iptEmlData" id="iptEmlData" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEmlUsuario" class="control-label">Usuário:</label>
                                <input type="text" name="iptEmlUsuario" id="iptEmlUsuario" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEmlPara" class="control-label">Para:</label>
                                <input type="email" name="iptEmlPara" id="iptEmlPara" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEmlCopia" class="control-label">Copia:</label>
                                <input type="email" name="iptEmlCopia" id="iptEmlCopia" 
                                       class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEmlAssunto" class="control-label">Assunto:</label>
                                <input type="text" name="iptEmlAssunto" id="iptEmlAssunto" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="">
                                <label for="iptEmlCorpo" class="control-label">Texto:</label>
                                <textarea class="form-control" id="iptEmlCorpo" name="iptEmlCorpo"
                                          placeholder="Corpo do e-mail" rows="3" required=""></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Enviar e-mail
                    </button>
                </div>
                
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>