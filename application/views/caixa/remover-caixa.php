<!-- Modal de remover caixa -->
<div id="mdlRemoverMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverMaquina" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Remover caixa</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center">Tem certeza que quer apagar esse <strong>caixa</strong>?</div>
            <form class="" method="post" 
                  action="<?php echo base_url("caixa/remover") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- ID caixa -->
                        <div class="col-md-12" hidden="">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">ID:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId" 
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvNome" class="control-label">Nome:</label>
                                <input type="text" name="iptRmvNome" id="iptRmvNome" 
                                       class="form-control" placeholder="" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptRmvIp" class="control-label">IP:</label>
                                <input type="text" name="iptRmvIp" id="iptRmvIp" 
                                       class="form-control" placeholder="" disabled="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="selRmvLocal" class="control-label">Local:</label>
                                <select name="selRmvLocal" id="selRmvLocal" 
                                        class="form-control" placeholder="" disabled="">
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
                        Remover
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>