<!-- Modal de gerar tabela ip maquina -->
<div id="mdlGerarMaquina"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlGerarMaquina" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Gerar tabela de IPs</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-gerar-maquina">
                Colocar a faixa de ip que deseja (ex: 192.168.3). <br/>
                O Tipo tem que ser LIVRE para já iniciar como IP Livre. <br/>
            </div>
            
            <form class="" method="post" id="frmGerMaquinas"
                  action="<?php echo base_url("admin/maquina_admin/gerarTabelaIp") ?>">
                <div class="modal-body">
                    <div class="row"> 
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="iptGerIp" class="control-label">Ip:</label>
                                <input type="text" name="iptGerIp" id="iptGerIp" 
                                       class="form-control" placeholder="ip" required="true" value="192.168.">
                            </div>
                        </div>                        
                        
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="selGerLocal" class="control-label">Local:</label>
                                <select name="selGerLocal" id="selGerLocal" 
                                        class="form-control" placeholder="Seleciona tipo">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($locais as $local) { ?>
                                    <option>
                                        <?php echo $local->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selGerTipo" class="control-label">Tipo:</label>
                                <select name="selGerTipo" id="selGerTipo" 
                                        class="form-control" placeholder="Seleciona tipo">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($tipos as $tipo) { ?>
                                    <option>
                                        <?php echo $tipo->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selGerUnidade" class="control-label">Unidade:</label>
                                <select name="selGerUnidade" id="selGerUnidade" 
                                        class="form-control" placeholder="Seleciona unidade">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($unidades as $unidade) { ?>
                                    <option>
                                        <?php echo $unidade->getNome() ?>
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
                    <button type="submit" class="btn btn-danger carregando">
                        Gerar
                    </button>
                </div>
                
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>