<!-- Modal de remover patrimonio -->
<div id="mdlRemoverPatrimonio"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlRemoverPatrimonio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <!-- Cabeçalho modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Exclusão equipamento patrimonial</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-remover-patrimonio" hidden=""></div>
            
            <!-- Formulario -->
            <form class="" id="frmRmvPatrimonio" method="post" action="<?php echo base_url("patrimonio/remover") ?>">
                <div class="modal-body">
                    <div class="row">
                        <!-- id -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvId" class="control-label">Id:</label>
                                <input type="text" name="iptRmvId" id="iptRmvId"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- url -->
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptRmvUrl" class="control-label">Url:</label>
                                <input type="text" name="iptRmvUrl" id="iptRmvUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <!-- nome -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptRmvEquipamento" class="control-label">Nome:</label>
                                <input type="text" name="iptRmvEquipamento" id="iptRmvEquipamento" 
                                       class="form-control" placeholder="Nome do equipamento" required="true">
                            </div>
                        </div>
                        <!-- patrimonio -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptRmvPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="number" name="iptRmvPatrimonio" id="iptRmvPatrimonio" 
                                       class="form-control" required="true">
                            </div>
                        </div> 
                        
                    </div> <!-- Fim row -->
                </div> <!-- Fim corpo modal -->
                <!--rodape modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Excluir
                    </button>
                </div>
                
            </form> <!-- Fim Formulario -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>