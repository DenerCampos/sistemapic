<!-- Inicio -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema PIC</title>

        <!-- METAS -->
        <meta charset="utf-8">  
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sistemapic.checklist.css" />
    </head>
    <body>
        <div class="cabecalho-avaliacao" >
            <div class="imagem-cabecalho">
                <img class="logo" src="<?php echo $assetsUrl;?>/img/logo-pic.png">
            </div>
            <div class="texto-cabecalho">
                Check-list PIC Pampulha
            </div>
            <div class="texto-cabecalho-info">
                Responsável: <?php echo $nome; ?> <br> <br>
                Data: <?php echo $data; ?>
            </div>
        </div>
        <!-- Lista -->
        <?php foreach ($lista as $key => $value) { ?>
        <table>
            <thead>
                <tr class="info" >
                    <th class="th-concluido">VERIFICADO</th>
                    <th><?php echo strtoupper($value["grupo"]); ?></th>
                    <th>OBSERVAÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($value["item"] as $chave => $valor) { ?>
                <tr>
                    <td class="text-center"><img class="img-chk" src="<?php if ($valor["ok"] == 1){echo $assetsUrl."/img/chk-ok.JPG"; } else {echo $assetsUrl."/img/chk-erro.JPG"; } ?>"></td>
                    <td class="text-center"><?php echo $valor["equipamento"]; ?></td>
                    <td class="text-center"><?php if(!empty($valor["obs"])) { echo $valor["obs"]; } else { echo "-" ;} ?></td>
                </tr>
                <?php } ?>
            </tbody>    
        </table>
        <?php } ?> 
        
        <!-- Assinatura -->
        <div class="text-center assinatura">
            <p>
                ___________________________________________________________<br>
                <?php echo $nome; ?>
            </p>
           
            
        </div>
    </body>
</html>
<!-- Fim sitema -->