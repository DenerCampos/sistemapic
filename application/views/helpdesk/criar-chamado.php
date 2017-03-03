<!-- Modal de criar chamado -->
<div id="mdlCriarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarChamado" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("ocorrencia/novaOcorrencia") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriUnidade" class="control-label">Unidade:</label>
                                <select name="selCriUnidade" id="selCriUnidade" 
                                        class="form-control" placeholder="Seleciona unidade">
                                    <!-- Lista todos -->
                                    <?php foreach ($unidades as $unidade) { ?>
                                    <option>
                                        <?php echo $unidade->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriSetor" class="control-label">Setor:</label>
                                <select name="selCriSetor" id="selCriSetor" 
                                        class="form-control" placeholder="Seleciona setor">
                                    <!-- Lista todos -->
                                    <?php foreach ($setores as $setor) { ?>
                                    <option>
                                        <?php echo $setor->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriProblema" class="control-label">Problema:</label>
                                <select name="selCriProblema" id="selCriProblema" 
                                        class="form-control" placeholder="Seleciona problema">
                                    <!-- Lista todos -->
                                    <?php foreach ($problemas as $problema) { ?>
                                    <option>
                                        <?php echo $problema->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriArea" class="control-label">Área de atendimento:</label>
                                <select name="selCriArea" id="selCriArea" 
                                        class="form-control" placeholder="Seleciona área">
                                    <!-- Lista todos -->
                                    <?php foreach ($areas as $area) { ?>
                                    <option>
                                        <?php echo $area->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="iptCriUsuario" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptCriUsuario" id="iptCriUsuario" 
                                       class="form-control" placeholder="Nome do usuário reclamante" required="true"
                                       value="<?php echo $this->session->userdata("nome"); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptCriVnc" class="control-label">Vnc:</label>
                                <input type="text" name="iptCriVnc" id="iptCriVnc"
                                       class="form-control" placeholder="000">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptCriRamal" class="control-label">Ramal:</label>
                                <input type="text" name="iptCriRamal" id="iptCriRamal"
                                       class="form-control" placeholder="8300">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptCriDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptCriDesc" maxlength="1000" name="iptCriDesc"
                                          placeholder="Descrição do chamado" rows="5" required=""></textarea>
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