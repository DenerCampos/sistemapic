<!-- Modal de criar area -->
<div id="mdlCriarArea"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarArea" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar área</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/area_admin/criarArea") ?>">
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriNome" class="control-label">Nome:</label>
                                <input type="text" name="iptCriNome" id="iptCriNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptCriEmail" id="iptCriEmail" required="true"
                                       class="form-control" placeholder="E-mail">
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
                    <button type="submit" class="btn btn-primary">
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>