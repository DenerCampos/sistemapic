<!-- Modal de criar email conf -->
<div id="mdlCriarEmailConf"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarEmailConf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar configuração de e-mail</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">Deixe somente <strong>uma</strong> configuração de e-mail ativa</div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/email_conf_admin/criarEmailConf") ?>">
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriUserName" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptCriUserName" id="iptCriUserName" 
                                       class="form-control" placeholder="Nome..." required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriHost" class="control-label">Endereço do host:</label>
                                <input type="text" name="iptCriHost" id="iptCriHost" required="true"
                                       class="form-control" placeholder="endereço...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriUser" class="control-label">Nome do usuário SMTP:</label>
                                <input type="text" name="iptCriUser" id="iptCriUser" 
                                       class="form-control" placeholder="Nome..." required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriPass" class="control-label">Senha do usuário SMTP:</label>
                                <input type="text" name="iptCriPass" id="iptCriPass" required="true"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriProtocol" class="control-label">Protocolo:</label>
                                <select name="selCriProtocol" id="selCriProtocol" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <option>smtp</option>
                                    <option>mail</option>
                                    <option>sendmail</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriCryp" class="control-label">Cryptografia:</label>
                                <select name="selCriCryp" id="selCriCryp" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <option>SMTP</option>
                                    <option>TLS</option>
                                    <option>SSL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriPort" class="control-label">Porta:</label>
                                <input type="text" name="iptCriPort" id="iptCriPort" 
                                       class="form-control" placeholder="21" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selCriEstado" class="control-label">Estado:</label>
                                <select name="selCriEstado" id="selCriEstado" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($estados as $estado) { ?>
                                    <option>
                                        <?php echo $estado->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning carregando">
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>