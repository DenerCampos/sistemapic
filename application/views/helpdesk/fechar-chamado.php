<!-- Modal de fechar chamado -->
<div id="mdlFecharChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlFecharChamado" aria-hidden="true">
    
    <!-- Cria modal tamanho lg -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Fechar chamado</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-fechar-chamado">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><strong>Fechamento de chamado!</strong></p>
            </div>
            
            <!-- Formulario de fechamento do chamado -->
            <form class="formulario" id="frmFchChamado" method="post" enctype="multipart/form-data"
                  action="<?php echo base_url("ocorrencia/fechar") ?>">
                
                <!-- Corpo da modal -->
                <div class="modal-body">
                    
                    <!-- Animação de carregando a modal até a conclusão da requisição AJAX-->
                    <div class="carregando-modal alert alert-info text-center">
                        <p>
                            <strong>Aguarde...</strong>
                            <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                        </p>
                    </div>
                    
                    <!-- Corpo da ocorrencia -->
                    <div class="corpo-modal">
                        <div class="row">
                            
                            <!-- menu nav -->
                            <ul class="nav nav-tabs nav-tabs-chamado" role="tablist">
                                <li class="active">
                                    <a href="#fecha-ocorrencia" id="fecha-ocorrencia-tab" data-toggle="tab"> Dados do chamado </a>
                                </li>
                                <li class="">
                                    <a href="#fecha-comentario" id="fecha-comentario-tab" data-toggle="tab"> Comentários <span class="badge" id="fecha-comentario-badge"></span></a>
                                </li>
                                <li class="">
                                    <a href="#fecha-anexo" id="fecha-anexo-tab" data-toggle="tab"> Anexos <span class="badge" id="fecha-anexo-badge"></span></a>
                                </li>
                                <li class="">
                                    <a href="#fecha-solucao" id="fecha-anexo-tab" data-toggle="tab"> Solução </a>
                                </li>
                            </ul><!-- fim menu nav -->
                            
                            <!-- Ocorrencia -->
                            <div class="tab-content">
                                <!-- Dados da Ocorrencia -->
                                <div class="tab-pane fade active in" id="fecha-ocorrencia">                             
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
                                            <input type="text" name="iptFchUrl" id="iptFchUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                                   class="form-control" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selFchUnidade" class="control-label">Unidade:</label>
                                            <select name="selFchUnidade" id="selFchUnidade" disabled=""
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
                                            <select name="selFchSetor" id="selFchSetor" disabled=""
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
                                            <select name="selFchProblema" id="selFchProblema" disabled=""
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
                                            <select name="selFchArea" id="selFchArea" disabled=""
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
                                            <input type="text" name="iptFchUsuario" id="iptFchUsuario" disabled=""
                                                   class="form-control" placeholder="Nome do usuário reclamante" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptFchVnc" class="control-label">Vnc:</label>
                                            <input type="text" name="iptFchVnc" id="iptFchVnc" disabled=""
                                                   class="form-control" placeholder="000">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptFchRamal" class="control-label">Ramal:</label>
                                            <input type="text" name="iptFchRamal" id="iptFchRamal" disabled=""
                                                   class="form-control" placeholder="8300">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptFchDesc" class="control-label">Descrição:</label>
                                            <textarea class="form-control" id="iptFchDesc" name="iptFchDesc"
                                              placeholder="Descrição do chamado" disabled="" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="iptFchAcompanharEmail" id="iptFchAcompanharEmail" value="email" checked="true"> Enviar e-mail para o usuário que abriu o chamado.
                                        </label>
                                    </div>
                                </div> <!-- Fim dados da Ocorrencia -->
                                
                                <!--Comentarios-->
                                <div class="tab-pane fade" id="fecha-comentario">
                                    <div class="col-md-12 comentario">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-info">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#comentarios-anteriores-fecha" aria-expanded="true" aria-controls="collapseOne">
                                                            Comentários anteriores <span class="caret"></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="comentarios-anteriores-fecha" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="panel-body" id="iptFchComentario">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!--Fim comentarios-->  
                                
                                <!--Anexos-->
                                <div class="tab-pane fade" id="fecha-anexo">
                                    <div id="fecha-anexo-antigo"></div>
                                    <div class="col-md-12 novo-anexo-edita">
                                        <label for="" class="control-label">Novos Anexos: <small>maximo 3</small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="imagem-anexo-preview">
                                            <a href="" class="lightview ">
                                                <img class="imagem-anexo img-thumbnail img-responsive" src="<?php echo $assetsUrl."/img/default-img.jpg" ?>">
                                            </a>
                                        </div>
                                        <label class="btn btn-default" for="fecha-anexo0">
                                            <input class="" id="fecha-anexo0" name="fecha-anexo0" type="file">
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
                                        <label class="btn btn-default" for="fecha-anexo1">
                                            <input class="" id="fecha-anexo1" name="fecha-anexo1" type="file">
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
                                        <label class="btn btn-default" for="fecha-anexo2">
                                            <input class="" id="fecha-anexo2" name="fecha-anexo2" type="file">
                                            Escolher arquivo
                                        </label>
                                        <div class="nome-arquivo-anexo"></div>
                                    </div>
                                </div> <!--Fim Anexos-->
                                
                                <!--Solução-->
                                <div class="tab-pane fade" id="fecha-solucao">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptFchComentarioNovo" class="control-label">Solução:</label>                       
                                            <textarea class="form-control" id="iptFchComentarioNovo" name="iptFchComentarioNovo"
                                                      placeholder="Descrição da solução adotada" rows="5" required="true"></textarea>
                                        </div>
                                    </div>
                                </div> <!--Fim solução-->
                            </div> <!-- Fim ocorrencia -->  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Fechar chamado
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>