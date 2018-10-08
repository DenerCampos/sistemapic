<!-- Modal de criar chamado -->
<div id="mdlCriarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarChamado" aria-hidden="true">
    
    <!-- Cria modal tamanho lg -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar chamado</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-criar-chamado" hidden=""></div>
            
            <!-- Formulario -->
            <form class="formulario" id="frmCriChamado" method="post" enctype="multipart/form-data"
                  action="<?php echo base_url("ocorrencia/novaOcorrencia") ?>">
                
                <!-- Corpo da modal -->
                <div class="modal-body">
                    <div class="row">
                        
                        <!-- menu nav -->
                        <ul class="nav nav-tabs nav-tabs-chamado" role="tablist">
                            <li class="active">
                                <a href="#ocorrencia" id="ocorrencia-tab" data-toggle="tab"> Dados do chamado </a>
                            </li>
                            <li class="">
                                <a href="#anexo" id="anexo-tab" data-toggle="tab"> Anexos </a>
                            </li>
                        </ul>
                        
                        <!-- Ocorrencia -->
                        <div class="tab-content">
                            <!-- Dados da Ocorrencia -->
                            <div class="tab-pane fade active in" id="ocorrencia"> 
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
                                    <div class="form-group ui-front">
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
                                               class="form-control" placeholder="000"
                                               value="<?php echo $vnc; ?>">
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
                                        <textarea class="form-control" id="iptCriDesc" name="iptCriDesc"
                                                  placeholder="Descrição do chamado" rows="3" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="iptCriEnviarArea" id="iptCriEnviarEmail" value="emailarea" checked="true"> Enviar e-mail para área de atendimento.
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="iptCriEnviarUsuario" id="iptCriEnviarUsuario" value="emailusuario"> Receber e-mail deste chamado.
                                    </label>
                                </div>
                            </div> <!-- Fim dados da Ocorrencia -->
                            
                            <!-- Anexos -->
                            <div class="tab-pane fade" id="anexo">   
                                <div class="col-md-12">
                                    <label for="" class="control-label">Anexos: <small>maximo 3</small></label>
                                </div>
                                <div class="col-md-4">
                                    <div class="imagem-anexo-preview">
                                        <a href="" class="lightview ">
                                            <img class="imagem-anexo img-thumbnail img-responsive" src="<?php echo $assetsUrl."/img/default-img.jpg" ?>">
                                        </a>
                                    </div>
                                    <label class="btn btn-default" for="cria-anexo0">
                                        <input class="" id="cria-anexo0" name="cria-anexo0" type="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                                        Escolher arquivo
                                    </label>
                                    <div class="nome-arquivo-anexo"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="imagem-anexo-preview">
                                        <a href="" class="lightview ">
                                            <img class="imagem-anexo img-thumbnail img-responsive" src="<?php echo $assetsUrl."/img/default-img.jpg" ?>">
                                        </a>
                                    </div>
                                    <label class="btn btn-default" for="cria-anexo1">
                                        <input class="" id="cria-anexo1" name="cria-anexo1" type="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                                        Escolher arquivo
                                    </label>
                                    <div class="nome-arquivo-anexo"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="imagem-anexo-preview">
                                        <a href="" class="lightview ">
                                            <img class="imagem-anexo img-thumbnail img-responsive" src="<?php echo $assetsUrl."/img/default-img.jpg" ?>">
                                        </a>
                                    </div>
                                    <label class="btn btn-default" for="cria-anexo2">
                                        <input class="" id="cria-anexo2" name="cria-anexo2" type="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                                        Escolher arquivo
                                    </label>
                                    <div class="nome-arquivo-anexo"></div>
                                </div>                                                                
                            </div> <!-- Fim anexos -->
                        </div> <!-- Fim ocorrencia -->
                    </div> <!-- Fim row -->                       
                </div> <!-- Fim corpo da modal -->
                <!-- rodapé modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->    
</div>