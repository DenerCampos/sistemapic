<!-- Modal de editar tutorial -->
<div id="mdlEditarTutorial"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarTutorial" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Edição tutorial</h4>
            </div>
            
            <!-- Mensagem de erro -->
           <div class="alert alert-danger text-center" id="erro-editar-tutorial" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmEdtTutorial" method="post" enctype="multipart/form-data" action="<?php echo base_url("tutorial/editar") ?>">
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
                        
                        <!-- nome -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtNome" class="control-label">Nome programa:</label>
                                <input type="text" name="iptEdtNome" id="iptEdtNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>   
                      
                        <!-- descrição -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptEdtDescricao" name="iptEdtDescricao"
                                  placeholder="Descrição do programa" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <!-- link -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtLink" class="control-label">Link:</label>
                                <input type="text" name="iptEdtLink" id="iptEdtLink" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>  
                        
                        <!-- anexo -->
                        <div class="col-md-12">
                            <label for="" class="control-label">Instalador: <small>(do programa)</small></label>
                        </div>
                        <div class="col-md-12">
                            <label class="btn btn-default" for="iptEdtAnexo">
                                <input class="" id="iptEdtAnexo" name="iptEdtAnexo" type="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                                Escolher programa
                            </label>
                            <span id="nomeEdtAnexo"></span>
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
                
            </form><!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>