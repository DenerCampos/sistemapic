<!-- Modal de editar chamado -->
<div id="mdlEditarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarChamado" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar chamado</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="formulario" method="post" 
                  action="<?php echo base_url("ocorrencia/editar") ?>">
                <div class="modal-body">
                    <div class="carregando-modal alert alert-info text-center">
                        <p>
                            <strong>Aguarde...</strong>
                            <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                        </p>
                    </div>
                    <div class="corpo-modal">
                        <div class="row">
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <label for="iptEdtId" class="control-label">Id:</label>
                                    <input type="text" name="iptEdtId" id="iptEdtId" 
                                           class="form-control" required="true">
                                </div>
                            </div>
                            <div class="col-md-12 hidden">
                                <div class="form-group">
                                    <label for="iptEdtUrl" class="control-label">Url:</label>
                                    <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                           class="form-control" required="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selEdtUnidade" class="control-label">Unidade:</label>
                                    <select name="selEdtUnidade" id="selEdtUnidade" 
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
                                    <label for="selEdtSetor" class="control-label">Setor:</label>
                                    <select name="selEdtSetor" id="selEdtSetor" 
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
                                    <label for="selEdtProblema" class="control-label">Problema:</label>
                                    <select name="selEdtProblema" id="selEdtProblema" 
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
                                    <label for="selEdtArea" class="control-label">Área de atendimento:</label>
                                    <select name="selEdtArea" id="selEdtArea" 
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
                                    <label for="iptEdtUsuario" class="control-label">Nome do usuário:</label>
                                    <input type="text" name="iptEdtUsuario" id="iptEdtUsuario" 
                                           class="form-control" placeholder="Nome do usuário reclamante" required="true">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="iptEdtVnc" class="control-label">Vnc:</label>
                                    <input type="text" name="iptEdtVnc" id="iptEdtVnc"
                                           class="form-control" placeholder="000">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="iptEdtRamal" class="control-label">Ramal:</label>
                                    <input type="text" name="iptEdtRamal" id="iptEdtRamal"
                                           class="form-control" placeholder="8300">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="iptEdtDesc" class="control-label">Descrição:</label>
                                    <textarea class="form-control" id="iptEdtDesc" maxlength="1000" name="iptEdtDesc"
                                              placeholder="Descrição do chamado" disabled=""></textarea>
                                </div>
                            </div>
                            <!--Comentarios-->
                            <div class="comentario col-md-12">
                                <div class="form-group">
                                    <label for="iptEdtComentario" class="control-label">Comentários anteriores:</label>                       
                                    <textarea class="form-control" id="iptEdtComentario" maxlength="1000" 
                                      name="iptEdtComentario"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="iptEdtComentarioNovo" class="control-label">Comentário:</label>                       
                                    <textarea class="form-control" id="iptEdtComentarioNovo" maxlength="1000" name="iptEdtComentarioNovo"
                                      placeholder="Novo comentário" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row anexo-grupo hidden">
                            <div class="col-md-12">
                                <h4 class="titulo-anexo">Anexos</h4>
                            </div>
                            <div class="col-md-12" id="anexo-editar">
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>