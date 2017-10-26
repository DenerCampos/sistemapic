<!-- Modal de editar chamado -->
<div id="mdlEditarChamado"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarChamado" aria-hidden="true">
    
    <!-- Cria modal tamanho lg -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar chamado</h4>
            </div>
            
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" id="erro-editar-chamado" hidden=""></div>
            
            <!-- Formulario de edição do chamado -->
            <form class="formulario" id="frmEdtChamado" method="post" enctype="multipart/form-data"
                  action="<?php echo base_url("ocorrencia/editar") ?>">
                
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
                                    <a href="#edita-ocorrencia" id="edita-ocorrencia-tab" data-toggle="tab"> Dados do chamado </a>
                                </li>
                                <li class="">
                                    <a href="#edita-comentario" id="edita-comentario-tab" data-toggle="tab"> Comentários <span class="badge" id="edita-comentario-badge"></span></a>
                                </li>
                                <li class="">
                                    <a href="#edita-anexo" id="edita-anexo-tab" data-toggle="tab"> Anexos <span class="badge" id="edita-anexo-badge"></span></a>
                                </li>
                            </ul><!-- fim menu nav -->
                            
                            <!-- Ocorrencia -->
                            <div class="tab-content">
                                <!-- Dados da Ocorrencia -->
                                <div class="tab-pane fade active in" id="edita-ocorrencia">                        
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
                                            <textarea class="form-control" id="iptEdtDesc" maxlength="1000" name="iptEdtDesc" disabled=""
                                                      placeholder="Descrição do chamado" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="iptEdtAcompanharEmail" id="iptEdtAcompanharEmail" value="email" checked="true"> Acompanhamento por e-mail.
                                        </label>
                                    </div>
                                </div> <!-- Fim dados da Ocorrencia -->
                            
                                <!--Comentarios-->
                                <div class="tab-pane fade" id="edita-comentario">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtComentarioNovo" class="control-label">Comentário:</label>                       
                                            <textarea class="form-control" id="iptEdtComentarioNovo" maxlength="1000" name="iptEdtComentarioNovo"
                                                      placeholder="Novo comentário" rows="5" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 comentario">
                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-info">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#comentarios-anteriores-edita" aria-expanded="true" aria-controls="collapseOne">
                                                            Comentários anteriores <span class="caret"></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="comentarios-anteriores-edita" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="panel-body" id="iptEdtComentario">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <!--Anexos-->
                                <div class="tab-pane fade" id="edita-anexo">
                                    <div id="edita-anexo-antigo"></div>
                                    <div class="col-md-12 novo-anexo-edita">
                                        <label for="" class="control-label">Novos Anexos: <small>maximo 3</small></label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="imagem-anexo-preview">
                                            <a href="" class="lightview ">
                                                <img class="imagem-anexo img-thumbnail img-responsive" src="<?php echo $assetsUrl."/img/default-img.jpg" ?>">
                                            </a>
                                        </div>
                                        <label class="btn btn-default" for="edita-anexo0">
                                            <input class="" id="edita-anexo0" name="edita-anexo0" type="file">
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
                                        <label class="btn btn-default" for="edita-anexo1">
                                            <input class="" id="edita-anexo1" name="edita-anexo1" type="file">
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
                                        <label class="btn btn-default" for="edita-anexo2">
                                            <input class="" id="edita-anexo2" name="edita-anexo2" type="file">
                                            Escolher arquivo
                                        </label>
                                        <div class="nome-arquivo-anexo"></div>
                                    </div>
                                </div> <!--Fim Anexos-->
                            </div> <!-- Fim ocorrencia -->  
                        </div> <!-- Fim row -->
                    </div> <!-- Fim corpo da ocorrencia -->
                </div> <!-- Fim corpo da modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary carregando">
                        Salvar
                    </button>
                </div>
            </form> <!-- Fim formulario de edição do chamado -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>