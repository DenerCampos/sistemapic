<!-- Inicio -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema PIC</title>

        <!-- METAS -->
        <meta charset="utf-8">  
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sistemapic.impressao.css" />
    </head>
    <body>
        <div class="cabecalho">
            <div class="imagem-cabecalho">
                <img class="logo" src="<?php echo $assetsUrl;?>/img/logo-pic.png">
            </div>
            <div class="texto-cabecalho">
                <h1>Impressão do chamado <?php echo $chamado->getIdocorrencia(); ?></h1>
                Data: <?php echo date("d/m/Y")?> 
            </div>
        </div>
        <!-- Info -->
        <table class="tabela">
            <thead>
            </thead>
            <tbody>
                <!-- Info -->
                <tr>
                    <td class="dados"><strong>Número: </strong><?php echo $chamado->getIdocorrencia(); ?></td>
                    <td class="dados"><strong>Estado: </strong><?php echo $estado->buscaId($chamado->getIdocorrencia_estado())->getNome(); ?></td>
                    <td class="dados"><strong>Unidade: </strong><?php echo $unidade->buscaId($chamado->getIdunidade())->getNome(); ?></td>
                    <td class="dados"><strong>Setor: </strong><?php echo $setor->buscaId($chamado->getIdsetor())->getNome(); ?></td>                  
                </tr>
                <!-- Info -->
                <tr>
                    <td colspan="3" class="dados"><strong>Área de atendimento: </strong><?php echo $area->buscaId($chamado->getIdarea())->getNome(); ?></td>
                    <td class="dados"><strong>Problema: </strong><?php echo $problema->buscaId($chamado->getIdproblema())->getNome(); ?></td>
                </tr>
                <!-- Info -->
                <tr>
                    <td colspan="2" class="dados"><strong>Aberto por: </strong><?php echo $chamado->getUsuario(); ?></td>
                    <td class="dados"><strong>Vnc: </strong><?php echo $chamado->getVnc(); ?></td>
                    <td class="dados"><strong>Ramal: </strong><?php echo $chamado->getRamal(); ?></td>
                </tr>
                <!-- Datas -->
                <tr>
                    <?php if ($chamado->getIdocorrencia_estado() == 1) { ?>
                    <td colspan="4" class="dados"><strong>Data abertura: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura())); ?></td>
                    <?php } ?>
                    <?php if ($chamado->getIdocorrencia_estado() == 2) { ?>
                    <td colspan="2" class="dados"><strong>Data abertura </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura())); ?></td>
                    <td colspan="2" class="dados"><strong>Data atualização: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_alteracao())); ?></td>
                    <?php } ?>
                    <?php if ($chamado->getIdocorrencia_estado() == 3) { ?>
                    <td class="dados"><strong>Data abertura: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura()));; ?></td>
                    <td colspan="2" class="dados"><strong>Data atualização: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_alteracao())); ?></td>
                    <td class="dados"><strong>Data fechamento: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_fechamento())); ?></td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
        <!-- Descrição -->
        <table class="tabela">
            <thead>
            </thead>
            <tbody>                
                <!-- descricao -->
                <tr>
                    <td colspan="4" class="dados"><strong>Descrição: </strong><br/>
                        <div class="descricao">
                            <?php echo str_replace("\r\n", "<br/>", $chamado->getdescricao()); ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Comentarios -->
        <table class="tabela">
            <thead>
            </thead>
            <tbody> 
                <!-- Comentarios -->
                <?php if (isset($comentario)) {?>
                <?php if($chamado->getIdocorrencia_estado() == 3) { ?>
                <?php array_shift($comentario);} //retira primeiro elemeto ?>
                <tr>
                    <td colspan="4" class="dados"><strong>Comentarios: </strong><br/>
                        <div class="comentario">
                            <?php foreach ($comentario as $chave => $value) { ?>
                            
                            <?php echo str_replace("\r\n", "<br/>", $value)."<br/>"; }?>                            
                        </div>                            
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- Solução -->
        <table class="tabela">
            <thead>
            </thead>
            <tbody>
                <!-- Solução -->
                <?php if ((isset($solucao)) && ($chamado->getIdocorrencia_estado() == 3)) { ?>
                <tr>
                    <td colspan="4" class="dados"><strong>Solução: </strong></br>
                        <div class="solucao">
                            <?php echo str_replace("\r\n", "<br/>", $solucao)."<br/>"; ?>
                        </div>                            
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
                
        <?php if (isset($anexos)) { ?>
        <h3 class="texto-anexo">Anexos</h3>
        <?php foreach ($anexos as $anexo) { ?>       
        <img src="<?php echo $anexo; ?>" class="imagem-anexo" />
        <?php }?>
        <?php } ?>
    </body>
</html>
<!-- Fim sitema -->