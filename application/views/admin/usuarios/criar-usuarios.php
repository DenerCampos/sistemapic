<!-- Modal de criar usuario -->
<div id="mdlCriarUsuario"  class="modal fade" tabindex="-1" role="dialog" 
     aria-labelledby="mdlCriarUsuario" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Criar conta</h4>
            </div>
            <!-- Mensagem de erro -->
            <div class="alert alert-danger text-center" hidden=""></div>
            <form class="" method="post" 
                  action="<?php echo base_url("admin/usuario_admin/criarUsuario") ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 hidden">
                            <div class="form-group">
                                <label for="iptCriUrl" class="control-label">Url:</label>
                                <input type="text" name="iptCriUrl" id="iptCriUrl" value="<?php echo $this->uri->uri_string(); ?>"
                                       class="form-control" placeholder="" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriNome" class="control-label">Nome:</label>
                                <input type="text" name="iptCriNome" id="iptCriNome" 
                                       class="form-control" placeholder="Seu nome" required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriEmail" class="control-label">E-mail:</label>
                                <input type="email" name="iptCriEmail" id="iptCriEmail" required="true"
                                       class="form-control" placeholder="Seu e-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriSenha" class="control-label">Senha:</label>
                                <input type="password" name="iptCriSenha" id="iptCriSenha" required="true" 
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iptCriRSenha" class="control-label">Repita senha:</label>
                                <input type="password" name="iptCriRSenha" id="iptCriRSenha" required="true"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selCriNivel" class="control-label">Nivel:</label>
                                <select name="selCriNivel" id="selCriNivel" 
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
                                <label for="selCriEstado" class="control-label">Estado:</label>
                                <select name="selCriEstado" id="selCriEstado" 
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
                                <label for="selCriArea" class="control-label">Área Atendimento:</label>
                                <select name="selCriArea" id="selCriArea" disabled
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
                                <input type="checkbox" id="chkCriAdmin" name="chkCriAdmin" value="admin" > Adiministração
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriOcorrencia" name="chkCriOcorrencia" value="ocorrencia" checked="" > Help-Desk
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriCaixa" name="chkCriCaixa" value="caixa" > Caixa
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriManutencao" name="chkCriManutencao" value="manutencao" > Manutenção
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriRelatorio" name="chkCriRelatorio" value="relatorio" > Relatórios
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriUsuario" name="chkCriUsuario" value="usuario" checked="" > Usuário
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="chkCriEquipamento" name="chkCriEquipamento" value="equipamento" > Equipamentos
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Criar
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>