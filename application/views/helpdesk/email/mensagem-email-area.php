<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml">
    <head>
        <meta content="pt-br" http-equiv="Content-Language"/>
        <meta content="text/html; charset=utf8" http-equiv="Content-Type"/>
        <title>Mensagem encaminhada do Sistema PIC</title>
    </head>
    <body>
        <h3>Sistema PIC - Help-Desk</h3>
        <h4>Novo chamado aberto para área de <?php echo $area; ?>!</h4>
        <br/>
        <p>Descrição do atendimento:<br/><br/>
            Número: <?php echo $id; ?> <br/>
            Usuário: <?php echo $usuario; ?> <br/>
            Problema: <?php echo $problema; ?> <br/>
            Descrição: <?php echo $descricao; ?> <br/>
        </p>
        <p>Clique 
            <a href="<?php echo base_url('ocorrencia/aberto');?>">
                AQUI
            </a>
            para vizualizar o chamado.
        </p>
        <br/>
        <p>Obrigado!</p>
        <p>Equipe do Sistema PIC.</p>
    </body>
</html>