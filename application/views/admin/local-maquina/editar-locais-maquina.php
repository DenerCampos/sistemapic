<!-- Modal de editar local -->
<div id="mdlEditarLocal"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarLocal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar local</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/local_maquina_admin/atualizaLocal") ?>">
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
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtNome" class="control-label">Nome:</label>
                                <input type="text" name="iptEdtNome" id="iptEdtNome" 
                                       class="form-control" placeholder="Nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtShape" class="control-label">Shape:</label>
                                <input type="text" name="iptEdtShape" id="iptEdtShape"
                                       class="form-control" placeholder="Tipo geometrico">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtCoords" class="control-label">Coordenadas:</label>
                                <input type="text" name="iptEdtCoords" id="iptEdtCoords"
                                       class="form-control" placeholder="Coordenadas">
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
                        <div class="col-md-12 text-right text-danger">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="chkEdtCaixa" id="chkEdtCaixa" value="0"> é um local de caixa?
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
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>