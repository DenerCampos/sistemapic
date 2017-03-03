<!-- Modal de editar caixa -->
<div id="mdlEditarMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarMaquina" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar caixa</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="erro" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("caixa/alterar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- ID caixa -->
                        <div class="col-md-12" hidden="">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">ID:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId" 
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtNome" class="control-label">Nome:</label>
                                <input type="text" name="iptEdtNome" id="iptEdtNome" 
                                       class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtIp" class="control-label">IP:</label>
                                <input type="text" name="iptEdtIp" id="iptEdtIp" 
                                       class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="selEdtLocal" class="control-label">Local:</label>
                                <select name="selEdtLocal" id="selEdtLocal" 
                                        class="form-control" placeholder="">
                                    <!-- Lista todos setores -->
                                    <?php foreach ($locais as $local) { ?>
                                    <option>
                                        <?php echo $local->getNome() ?>
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
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>