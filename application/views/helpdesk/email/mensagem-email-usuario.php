<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml">
    <head>
        <meta content="pt-br" http-equiv="Content-Language"/>
        <meta content="text/html; charset=utf8" http-equiv="Content-Type"/>
        <title>Mensagem encaminhada do Sistema PIC</title>
    </head>
    <body>
        <h3>Sistema PIC - Help-Desk</h3>
        <h4><?php echo $usuario; ?>, Você abriu um novo chamado!</h4>
        <br/>
        <p>Descrição do chamado:<br/><br/>
            Número: <?php echo $id; ?> <br/>
            Problema: <?php echo $problema; ?> <br/>
            Descrição: <?php echo $descricao; ?> <br/>
        </p>
        <p>
            Aguarde que em instantes iremos atende-lo!
        </p>
        <p>Clique 
            <a href="<?php echo base_url('ocorrencia/aberto'); ?>">
                AQUI
            </a>
             para vizualizar este chamado.
        </p>
        <br/>
        <p>Obrigado!</p>
        <p>Equipe do Sistema PIC.</p>
    </body>
</html>