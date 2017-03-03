<!-- Modal de fechar chamado -->
<div id="mdlFecharChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlFecharChamado" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Fechar chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center"><strong>Fechamento de chamado!</strong></div>
            <form class="" method="post" 
                  action="<?php echo base_url("ocorrencia/fechar") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptFchId" class="control-label">Id:</label>
                                <input type="text" name="iptFchId" id="iptFchId" 
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptFchUrl" class="control-label">Url:</label>
                                <input type="text" name="iptFchUrl" id="iptFchUrl" value="<?php echo current_url(); ?>"
                                       class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selFchUnidade" class="control-label">Unidade:</label>
                                <select name="selFchUnidade" id="selFchUnidade" 
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
                                <label for="selFchSetor" class="control-label">Setor:</label>
                                <select name="selFchSetor" id="selFchSetor" 
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
                                <label for="selFchProblema" class="control-label">Problema:</label>
                                <select name="selFchProblema" id="selFchProblema" 
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
                                <label for="selFchArea" class="control-label">Área de atendimento:</label>
                                <select name="selFchArea" id="selFchArea" 
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
                                <label for="iptFchUsuario" class="control-label">Nome do usuário:</label>
                                <input type="text" name="iptFchUsuario" id="iptFchUsuario" 
                                       class="form-control" placeholder="Nome do usuário reclamante" required="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptFchVnc" class="control-label">Vnc:</label>
                                <input type="text" name="iptFchVnc" id="iptFchVnc"
                                       class="form-control" placeholder="000">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="iptFchRamal" class="control-label">Ramal:</label>
                                <input type="text" name="iptFchRamal" id="iptFchRamal"
                                       class="form-control" placeholder="8300">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptFchDesc" class="control-label">Descrição:</label>
                                <textarea class="form-control" id="iptFchDesc" maxlength="100" name="iptFchDesc"
                                  placeholder="Descrição do chamado"></textarea>
                            </div>
                        </div>
                        <!--Comentarios-->
                        <div class="comentario col-md-12">
                            <div class="form-group">
                                <label for="iptFchComentario" class="control-label">Comentários anteriores:</label>                       
                                <textarea class="form-control" id="iptFchComentario" maxlength="100" 
                                  name="iptFchComentario"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iptFchComentarioNovo" class="control-label">Solução:</label>                       
                                <textarea class="form-control" id="iptFchComentarioNovo" maxlength="100" name="iptFchComentarioNovo"
                                          placeholder="Solução" rows="3" required="true"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Fechar chamado
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>