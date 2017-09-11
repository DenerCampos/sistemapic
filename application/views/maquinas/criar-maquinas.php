<!-- Modal de criar maquina -->
<div id="mdlCriarMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarMaquina" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar maquina</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-criar-maquina" hidden=""></div>
            
            <form class="" id="frmCriMaquina" method="post" 
                  action="<?php echo base_url("maquina/criarMaquina") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptCriUrl" class="control-label">Url:</label>
                                <input type="text" name="iptCriUrl" id="iptCriUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriNome" class="control-label">Nome:</label>
                                <input type="text" name="iptCriNome" id="iptCriNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriIp" class="control-label">Ip:</label>
                                <input type="text" name="iptCriIp" id="iptCriIp" 
                                       class="form-control" placeholder="ip" value="192.168.2.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriUser" class="control-label">Usuário:</label>
                                <input type="text" name="iptCriUser" id="iptCriUser" 
                                       class="form-control" placeholder="Login">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selCriLocal" class="control-label">Local:</label>
                                <select name="selCriLocal" id="selCriLocal" 
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
                                <label for="selCriTipo" class="control-label">Tipo:</label>
                                <select name="selCriTipo" id="selCriTipo" 
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
                                <label for="iptCriDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptCriDesc" maxlength="100" name="iptCriDesc"
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
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>