<!-- Modal de editar maquina -->
<div id="mdlEditarMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarMaquina" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar maquina</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-editar-maquina" hidden=""></div>
            
            <form class="" id="frmEdtMaquina" method="post" 
                  action="<?php echo base_url("maquina/atualizaMaquina") ?>">
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtNome" class="control-label">Nome:</label>
                                <input type="text" name="iptEdtNome" id="iptEdtNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtIp" class="control-label">Ip:</label>
                                <input type="text" name="iptEdtIp" id="iptEdtIp" 
                                       class="form-control" placeholder="ip" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtUser" class="control-label">Usuário:</label>
                                <input type="text" name="iptEdtUser" id="iptEdtUser" 
                                       class="form-control" placeholder="Login">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selEdtLocal" class="control-label">Local:</label>
                                <select name="selEdtLocal" id="selEdtLocal" 
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selEdtTipo" class="control-label">Tipo:</label>
                                <select name="selEdtTipo" id="selEdtTipo" 
                                        class="form-control" placeholder="Seleciona tipo">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($tipos as $tipo) { ?>
                                    <option>
                                        <?php echo $tipo->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptEdtDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptEdtDesc" maxlength="100" name="iptEdtDesc"
                                  placeholder="Descrição do maquina" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>