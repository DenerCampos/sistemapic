<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml">
    <head>
        <meta content="pt-br" http-equiv="Content-Language"/>
        <meta content="text/html; charset=utf8" http-equiv="Content-Type"/>
        <title>Mensagem encaminhada do Sistema PIC</title>
    </head>
    <body>
        
        <div>
            <div  id="emb-email-header">
                <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: 0;Margin-right: auto;max-width: 250px" 
                     src="<?php echo $assetsUrl ?>/img/logo-pic-email.png" alt="" width="400" height="100">
            </div><br/><br/>
                
            <div style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
                <h4>Prezado <?php echo $nome; ?>.</h4>
                <p>Sua nova senha é: <strong><?php echo $senha; ?></strong></p>
                <p>Favor trocar a senha ao entrar no sistema.</p>
                
                <p>Obrigado!</p>
            </div>
                
            <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 12px;line-height: 25px;Margin-bottom: 25px"> 
                *E-mail automático. Não responda este e-mail*<br/> Equipe <a href="<?php echo base_url(); ?>">Sistema PIC</a>.
            </p>
        </div>
        
    </body>
</html>