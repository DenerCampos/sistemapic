<!-- Modal de apresentou defeito na garantia manutencao -->
<div id="mdlDefeitoManutencao"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlDefeitoManutencao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Apresentou defeito em garantia</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("manutencao/defeitoManutencao") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" hidden="">
                            <div class="form-group">
                                <label for="iptDftId" class="control-label">Id:</label>
                                <input type="text" name="iptDftId" id="iptDftId" 
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptDftEquipamento" class="control-label">Equipamento:</label>
                                <input type="text" name="iptDftEquipamento" id="iptDftEquipamento" 
                                       class="form-control" placeholder="Equipamento" required="true">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="iptDftDefeito" class="control-label">Defeito:</label>
                                <input type="text" name="iptDftDefeito" id="iptDftDefeito" 
                                       class="form-control" placeholder="Provavel defeito">
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptDftDataDefeito" class="control-label">Data defeito:</label>
                                <input type="date" name="iptDftDataDefeito" id="iptDftDataDefeito" 
                                       class="form-control" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptDftDescricao" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptDftDescricao" maxlength="200" name="iptDftDescricao"
                                  placeholder="Breve descrição do equipamento" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="iptDftPatrimonio" class="control-label">Patrimônio:</label>
                                <input type="text" name="iptDftPatrimonio" id="iptDftPatrimonio" 
                                       class="form-control" placeholder="Patrimonio">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selDftUnidade" class="control-label">Unidade:</label>
                                <select name="selDftUnidade" id="selDftUnidade" 
                                        class="form-control" placeholder="Seleciona unidade">
                                    <!-- Lista todos -->
                                    <?php foreach ($unidades as $unidade) { ?>
                                    <option>
                                        <?php echo $unidade->getNome(); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="selDftSetor" class="control-label">Setor:</label>
                                <select name="selDftSetor" id="selDftSetor" 
                                        class="form-control" placeholder="Seleciona setor">
                                    <!-- Lista todos -->
                                    <?php foreach ($setores as $setor) { ?>
                                    <option>
                                        <?php echo $setor->getNome(); ?>
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