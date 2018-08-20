<!-- Modal de criar utilitario -->
<div id="mdlCriarUtilitario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarUtilitario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Novo programa</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-cria-utilitario" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmCriUtilitario" method="post" enctype="multipart/form-data" action="<?php echo base_url("utilitario/criar") ?>">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriNome" class="control-label">Nome programa:</label>
                                <input type="text" name="iptCriNome" id="iptCriNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>   
                      
                        <!-- descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptCriDescricao" name="iptCriDescricao"
                                  placeholder="Descrição do programa" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <!-- anexo -->
                        <div class="col-md-12">
                            <label for="" class="control-label">Instalador: <small>(do programa)</small></label>
                        </div>
                        <div class="col-md-12">
                            <label class="btn btn-default" for="iptCriAnexo">
                                <input class="" id="iptCriAnexo" name="iptCriAnexo" type="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                                Escolher programa
                            </label>
                            <span id="nomeAnexo"></span>
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