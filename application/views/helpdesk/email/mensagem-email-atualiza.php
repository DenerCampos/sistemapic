<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml">
    <head>
        <meta content="pt-br" http-equiv="Content-Language"/>
        <meta content="text/html; charset=utf8" http-equiv="Content-Type"/>
        <title>Mensagem encaminhada do Sistema PIC</title>
    </head>
    <body>
        <h3>Sistema PIC - Help-Desk</h3>
        <h4>Chamado atualizado no sistema</h4>
        <br/>
        <p><strong>Descrição do chamado:</strong><br/><br/>
            <strong>Número:</strong> <?php echo $id; ?> <br/>
            <strong>Estado:</strong> <?php echo $estado; ?> <br/>
            <strong>Área de atenimento:</strong> <?php echo $area; ?> <br/>
            <strong>Técnico:</strong> <?php echo $tecnico; ?> <br/>
            <strong>Usuário:</strong> <?php echo $usuario; ?> <br/>
            <strong>Problema:</strong> <?php echo $problema; ?> <br/>
            <strong>Descrição:</strong> <?php echo $descricao; ?> <br/>
            <strong>Atualização:</strong> <?php echo $comentario; ?> <br/>
        </p>
        <p>
            Para mais informações, favor acessar o chamado clicando 
            <a href="<?php echo base_url('ocorrencia/atendimento'); ?>">
                AQUI
            </a>
            .
        </p>
        <br/>
        <p>Obrigado!</p>
        <p>Equipe do Sistema PIC.</p>
    </body>
</html>