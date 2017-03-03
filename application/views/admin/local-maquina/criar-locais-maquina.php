<!-- Modal de criar local -->
<div id="mdlCriarLocal"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarLocal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar local</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/local_maquina_admin/criarLocal") ?>">
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
                                <label for="iptCriShape" class="control-label">Shape:</label>
                                <input type="text" name="iptCriShape" id="iptCriShape"
                                       class="form-control" placeholder="Tipo geometrico">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriCoords" class="control-label">Coordenadas:</label>
                                <input type="text" name="iptCriCoords" id="iptCriCoords"
                                       class="form-control" placeholder="Coordenadas">
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
                        <div class="col-md-12 text-right text-danger">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="chkCriCaixa" id="chkCriCaixa" value="0"> é um local de caixa?
                                </label>
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