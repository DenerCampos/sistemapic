<!-- Modal de editar email conf -->
<div id="mdlEditarEmailConf"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarEmailConf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar configuração de e-mail</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/email_conf_admin/atualizaEmailConf") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId" 
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtUserName" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptEdtUserName" id="iptEdtUserName" 
                                       class="form-control" placeholder="Nome..." required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtHost" class="control-label">Endereço do host:</label>
                                <input type="text" name="iptEdtHost" id="iptEdtHost" required="true"
                                       class="form-control" placeholder="endereço...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtUser" class="control-label">Nome do usuário SMTP:</label>
                                <input type="text" name="iptEdtUser" id="iptEdtUser" 
                                       class="form-control" placeholder="Nome..." required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtPass" class="control-label">Senha do usuário SMTP:</label>
                                <input type="text" name="iptEdtPass" id="iptEdtPass" required="true"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtProtocol" class="control-label">Protocolo:</label>
                                <select name="selEdtProtocol" id="selEdtProtocol" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <option>mail</option>
                                    <option>sendmail</option>
                                    <option>smtp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtCryp" class="control-label">Cryptografia:</label>
                                <select name="selEdtCryp" id="selEdtCryp" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <option>SMTP</option>
                                    <option>TLS</option>
                                    <option>SSL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptEdtPort" class="control-label">Porta:</label>
                                <input type="text" name="iptEdtPort" id="iptEdtPort" 
                                       class="form-control" placeholder="21" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selEdtEstado" class="control-label">Estado:</label>
                                <select name="selEdtEstado" id="selEdtEstado" 
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
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>