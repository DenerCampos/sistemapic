<!-- Modal de vizualizar chamado -->
<div id="mdlVisualizarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlVisualizarChamado" aria-hidden="true">
    
    <!-- Cria modal tamanho lg -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Visualizar chamado</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            
            <!-- Corpo da modal -->
            <div class="modal-body">
                
                <!-- Animação de carregando a modal até a conclusão da requisição AJAX-->
                <div class="carregando-modal alert alert-info text-center">
                    <p>
                        <strong>Aguarde...</strong>
                        <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                    </p>
                </div>
                
                <div class="corpo-modal"> 
                    <div class="row">
                        
                        <!-- menu nav -->
                        <ul class="nav nav-tabs nav-tabs-chamado" role="tablist">
                            <li class="active">
                                <a href="#visualiza-ocorrencia" id="visualiza-ocorrencia-tab" data-toggle="tab"> Dados do chamado </a>
                            </li>
                            <li class="">
                                <a href="#visualiza-comentario" id="visualiza-comentario-tab" data-toggle="tab"> Comentários <span class="badge" id="visualiza-comentario-badge"></span></a>
                            </li>
                            <li class="">
                                <a href="#visualiza-anexo" id="visualiza-anexo-tab" data-toggle="tab"> Anexos <span class="badge" id="visualiza-anexo-badge"></span></a>
                            </li>
                        </ul><!-- fim menu nav -->
                        
                        <!-- Ocorrencia -->
                        <div class="tab-content">
                            <!-- Dados da Ocorrencia -->
                            <div class="tab-pane fade active in" id="visualiza-ocorrencia">
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
                                        <input type="text" name="iptVslUrl" id="iptVslUrl" value="<?php echo $this->uri->uri_string(); ?>"
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
                                          placeholder="Descrição do chamado" rows="5"></textarea>
                                    </div>
                                </div>
                            </div> <!-- Fim dados da Ocorrencia -->
                            
                            <!--Comentarios-->
                            <div class="tab-pane fade" id="visualiza-comentario"> 
                                <div class="col-md-12 comentario">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-info">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#comentarios-anteriores-vizualiza" aria-expanded="true" aria-controls="collapseOne">
                                                        Comentários anteriores <span class="caret"></span>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="comentarios-anteriores-vizualiza" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body" id="iptVslComentario">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!--Fim Comentarios-->
                            
                            <!--Anexos-->
                            <div class="tab-pane fade" id="visualiza-anexo"></div> <!--Fim Anexos-->
                        </div><!-- Fim Ocorrencia -->
                    </div> <!-- Fim row -->
                </div> <!-- Fim corpo-modal -->
            </div> <!-- Fim modal-body -->
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