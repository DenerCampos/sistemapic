<!-- Modal de criar chamado -->
<div id="mdlVisualizarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlVisualizarChamado" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Visualizar chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label for="iptVslId" class="control-label">Id:</label>
                            <input type="text" name="iptVslId" id="iptVslId" 
                                   class="form-control" required="true">
                        </div>
                    </div>
                    <div class="col-md-12 hidden">
                        <div class="form-group">
                            <label for="iptVslUrl" class="control-label">Url:</label>
                            <input type="text" name="iptVslUrl" id="iptVslUrl" value="<?php echo current_url(); ?>"
                                   class="form-control" required="true">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selVslUnidade" class="control-label">Unidade:</label>
                            <select name="selVslUnidade" id="selVslUnidade" 
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
                            <label for="selVslSetor" class="control-label">Setor:</label>
                            <select name="selVslSetor" id="selVslSetor" 
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
                            <label for="selVslProblema" class="control-label">Problema:</label>
                            <select name="selVslProblema" id="selVslProblema" 
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
                            <label for="selVslArea" class="control-label">Área de atendimento:</label>
                            <select name="selVslArea" id="selVslArea" 
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
                            <label for="iptVslUsuario" class="control-label">Nome do usuário:</label>
                            <input type="text" name="iptVslUsuario" id="iptVslUsuario" 
                                   class="form-control" placeholder="Nome do usuário reclamante" required="true">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="iptVslVnc" class="control-label">Vnc:</label>
                            <input type="text" name="iptVslVnc" id="iptVslVnc"
                                   class="form-control" placeholder="000">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="iptVslRamal" class="control-label">Ramal:</label>
                            <input type="text" name="iptVslRamal" id="iptVslRamal"
                                   class="form-control" placeholder="8300">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="iptVslDesc" class="control-label">Descrição:</label>
                            <textarea class="form-control" id="iptVslDesc" maxlength="100" name="iptVslDesc"
                              placeholder="Descrição do chamado"></textarea>
                        </div>
                    </div>
                    <!--Comentarios-->
                    <div class="comentario col-md-12">
                        <div class="form-group">
                            <label for="iptVslComentario" class="control-label">Comentários:</label>                       
                            <textarea class="form-control" id="iptVslComentario" maxlength="100" name="iptVslComentario"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>