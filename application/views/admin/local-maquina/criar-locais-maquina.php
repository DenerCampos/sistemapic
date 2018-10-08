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
                                <label for="selCriShape" class="control-label">Shape:</label>
                                <select name="selCriShape" id="selCriShape" 
                                        class="form-control" placeholder="Seleciona tipo">
                                    <!-- Lista todos tipos de shape permitido -->
                                    <option>rect</option>
                                    <option>circle</option>
                                    <option>poly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriCoords" class="control-label">Coordenadas:</label>
                                <input type="text" name="iptCriCoords" id="iptCriCoords"
                                       class="form-control" placeholder="Coordenadas">
                            </div>
                        </div>                        
                        <div class="col-md-12 text-right text-danger">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriCaixa" name="chkCriCaixa" value="caixa" > é um local de caixa?
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriPatrimonio" name="chkCriPatrimonio" value="patrimonio" > é um local de patrimônio?
                            </label>
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