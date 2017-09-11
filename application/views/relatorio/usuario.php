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
                Relatório por usuário
            </div> 
        </div>
            
        <!-- form do relatorio  -->
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" id="frmRelatorioUsuario" method="post" action="">
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
                            <strong>Totais de chamados por usuário</strong>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>           
                
                               
            </div>
        </div>

    </div>
</div>