<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
      <meta charset="utf-8" />
      <title>Sistema PIC - Avaliação funcional</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    
    <body>
        
        <div>
            <div  id="emb-email-header">
                <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: 0;Margin-right: auto;max-width: 250px" 
                     src="<?php echo $assetsUrl ?>/img/logo-pic-email.png" alt="" width="400" height="100"></div><br/><br/>
            <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
                <?php echo $texto;?>
            </p>
            <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 12px;line-height: 25px;Margin-bottom: 25px"> 
                *E-mail automático. Não responda este e-mail*<br/> Equipe <a href="<?php echo base_url(); ?>">Sistema PIC</a>.
            </p>
        </div>
        
    </body>
</html>