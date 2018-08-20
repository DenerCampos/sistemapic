<!-- Modal de criar usuario -->
<div id="mdlEditarUsuario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlEditarUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Editar conta</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/usuario_admin/atualizaUsuario") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtId" class="control-label">Id:</label>
                                <input type="text" name="iptEdtId" id="iptEdtId" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptEdtUrl" class="control-label">Url:</label>
                                <input type="text" name="iptEdtUrl" id="iptEdtUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtNome" class="control-label">Nome:</label>
                                <input type="text" name="iptEdtNome" id="iptEdtNome" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptEdtEmail" id="iptEdtEmail" required="true"
                                       class="form-control" placeholder="Seu e-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtSenha" class="control-label">Senha:</label>
                                <input type="password" name="iptEdtSenha" id="iptEdtSenha" 
                                       class="form-control" placeholder="********">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptEdtRSenha" class="control-label">Repita senha:</label>
                                <input type="password" name="iptEdtRSenha" id="iptEdtRSenha"
                                       class="form-control" placeholder="*********">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtNivel" class="control-label">Nivel:</label>
                                <select name="selEdtNivel" id="selEdtNivel" 
                                        class="form-control" placeholder="Seleciona nivel">
                                    <!-- Lista todos niveis -->
                                    <option>Administrador</option>
                                    <option>Técnico</option>
                                    <option>Usuário</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtEstado" class="control-label">Estado:</label>
                                <select name="selEdtEstado" id="selEdtEstado" 
                                        class="form-control" placeholder="Seleciona estado">
                                    <!-- Lista todos estados -->
                                    <?php foreach ($estados as $estado) { ?>
                                    <option>
                                        <?php echo $estado->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selEdtArea" class="control-label">Área Atendimento:</label>
                                <select name="selEdtArea" id="selEdtArea" disabled="true"
                                        class="form-control">
                                    <option>Nenhuma</option>
                                    <!-- Lista todos estados -->
                                    <?php foreach ($areas as $area) { ?>
                                    <option>
                                        <?php echo $area->getNome() ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Nivel de acesso -->                        
                        <div class="col-md-12 nivel-acesso">
                            <div class="texto-bold">Nivel de acesso: <br/></div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtAdmin" name="chkEdtAdmin" value="admin" > Adiministração
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtOcorrencia" name="chkEdtOcorrencia" value="ocorrencia"> Help-Desk
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtCaixa" name="chkEdtCaixa" value="caixa" > Caixa
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtManutencao" name="chkEdtManutencao" value="manutencao" > Manutenção
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtRelatorio" name="chkEdtRelatorio" value="relatorio" > Relatórios
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtUsuario" name="chkEdtUsuario" value="usuario" > Usuário
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtEquipamento" name="chkEdtEquipamento" value="equipamento" > Equipamentos
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtAvaliacao" name="chkEdtAvaliacao" value="avaliacao" > Avaliação
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkEdtUtilitario" name="chkEdtUtilitario" value="utilitario" > Utilitários
                            </label>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Salvar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>