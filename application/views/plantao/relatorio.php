<!-- Inicio -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema PIC</title>

        <!-- METAS -->
        <meta charset="utf-8">  
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sistemapic.relatorio.css" />
    </head>
    <body>
        <div class="cabecalho">
            <div class="imagem-cabecalho">
                <img class="logo" src="<?php echo $assetsUrl;?>/img/logo-pic.png">
            </div>
            <div class="texto-cabecalho">
                <h1>Relatório plantão PIC</h1>
                Data: <?php echo $data;?>
                <br/>
                Plantonista: <?php echo $this->session->userdata("nome"); ?> 
            </div>
        </div>
        <?php foreach ($setores as $setor) {?>
        <div class="corpo">
            <div class="setor">                
                <strong><?php echo $setor->getNome(); ?></strong>
            </div>
            <div class="chamados">
                <?php foreach ($chamados as $chamado) {?>
                <?php if (($chamado->getIdsetor()) == ($setor->getIdsetor())){ ?>
                    <strong>- Chamado nº <?php echo $chamado->getIdocorrencia(); ?>:</strong> 
                    <?php echo $chamado->getDescricao()." (".$chamado->getUsuario().")."?>
                    <br/>
                    <strong>- Solução:</strong>
                    <?php echo $comentario->buscaFechamento($chamado->getIdocorrencia())->getDescricao(); ?>                    
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </body>
</html>
<!-- Fim sitema -->