<!-- Modal de encaminhar chamado -->
<div id="mdlEncaminharChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEncaminharChamado" aria-hidden="true">
    
    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Encaminhar chamado</h4>
            
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-encaminhar-chamado" hidden=""></div>
            
            <form class="formulario" id="frmEncChamado" method="post" 
                  action="<?php echo base_url("ocorrencia/encaminhar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEncId" class="control-label">Id:</label>
                                <input type="text" name="iptEncId" id="iptEncId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEncUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEncUrl" id="iptEncUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptEncNumero" class="control-label">Numero:</label>
                                <input type="text" name="iptEncNumero" id="iptEncNumero" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptEncUsuario" class="control-label">Usuário:</label>
                                <input type="text" name="iptEncUsuario" id="iptEncUsuario" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptEncProblema" class="control-label">Problema:</label>
                                <input type="text" name="iptEncProblema" id="iptEncProblema" 
                                       class="form-control" required="true" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selEncTecnico" class="control-label">Enviar para o técnico:</label>
                                <select name="selEncTecnico" id="selEncTecnico" 
                                        class="form-control" placeholder="Seleciona técnico">
                                    <!-- Lista todos -->
                                    <?php foreach ($tecnicos as $tecnico) { ?>
                                    <option>
                                        <?php echo $tecnico->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEncComentario" class="control-label">Comentário:</label>                       
                                <textarea class="form-control" id="iptEncComentario"  name="iptEncComentario"
                                  placeholder="Novo comentário" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Encaminhar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>