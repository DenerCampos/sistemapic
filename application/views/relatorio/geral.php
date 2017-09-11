<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Codigo html  -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <div class="row">
            <!-- Nome do relatorio  -->
            <div class="col-md-12 texto-cabecalho-relatorio">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                Relatório geral
            </div> 
        </div>
            
        <!-- form do relatorio  -->
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" id="frmRelatorioGeral" method="post" action="">
                    <div class="form-group">
                        <label for="iptCriDataInicio" class="col-sm-2 col-md-1 control-label">Inicio:</label>
                        <div class="col-sm-4 col-md-2">
                            <input type="date" name="iptCriDataInicio" id="iptCriDataInicio"
                               class="form-control" value="<?php echo date("Y-m-d", strtotime(date("Y-m-d")." -1 month"));?>">
                        </div>                            
                    </div>

                    <div class="form-group">
                        <label for="iptCriDataFim" class="col-sm-2 col-md-1 control-label">Fim:</label>
                        <div class="col-sm-4 col-md-2">
                            <input type="date" name="iptCriDataFim" id="iptCriDataFim"
                               class="form-control" value="<?php echo date("Y-m-d");?>">
                        </div>                         
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-md-offset-1 col-md-10">
                            <button type="submit" class="btn btn-primary carregando">
                                Gerar
                            </button>
                        </div>                         
                    </div>

                </form>
            </div>
        </div>
        
        <!-- separador  -->
        <div class="row">
            <div class="col-md-12 separador"></div>
        </div>

        <!-- processando relatorio  -->
        <div class="relatorio-resultado-processando">
            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                    Gerando o relatório. Aguarde... 
                </div>
            </div>            
        </div>
        
        <!-- erro relatorio  -->
        <div class="relatorio-resultado-erro">
            <div class="row">
                <div class="col-md-12 text-center">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    <span id="erro-relatorio"></span>
                </div>
            </div>            
        </div>
        
        <!-- Resultado  -->
        <div class="relatorio-resultado">
            <div class="row">
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Totais de chamados</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Abertos</th>
                                    <th>Atendimentos</th>
                                    <th>Fechados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="chamadosAbertos"></td>
                                    <td id="chamadosAtendimentos"></td>
                                    <td id="chamadosFechados"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>           
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Técnico que mais fechou chamados</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nomeTecnico"></td>
                                    <td id="totalTecnico"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Área que mais abriu chamado</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nomeArea"></td>
                                    <td id="totalArea"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Setor que mais abriu chamado</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nomeSetor"></td>
                                    <td id="totalSetor"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Problema mais reclamado</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nomeProblema"></td>
                                    <td id="totalProblema"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Caixa de resultado  -->
                <div class="col-md-4 display-conteudo-relatorio">
                    <div class="conteudo-relatorio">                        
                        <div class="titulo-relatorio">
                            <strong>Usuário que mais abriu chamados</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="nomeUsuario"></td>
                                    <td id="totalUsuario"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>