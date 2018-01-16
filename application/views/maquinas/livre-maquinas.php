<!-- Modal de liberar maquina -->
<div id="mdlLivreMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlLivreMaquina" aria-hidden="true">
    <div class="modal-dialog">        
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Liberar maquina</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-livre-maquina"><strong>Tem certeza que quer liberar o IP da maquina?</strong></div>
            
            <form class="" method="post" id="frmLvrMaquina"
                  action="<?php echo base_url("maquina/livreMaquina") ?>">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptLvrId" class="control-label">Id:</label>
                                <input type="text" name="iptLvrId" id="iptLvrId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptLvrUrl" class="control-label">Url:</label>
                                <input type="text" name="iptLvrUrl" id="iptLvrUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptLvrNome" class="control-label">Nome:</label>
                                <input type="text" name="iptLvrNome" id="iptLvrNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptLvrIp" class="control-label">Ip:</label>
                                <input type="text" name="iptLvrIp" id="iptLvrIp" 
                                       class="form-control" placeholder="ip" required="true">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Liberar
                    </button>
                </div>
                
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>