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
        
        <!-- Cabeçalho -->
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
        
        <!-- Setores dos chamados abertos no dia -->
        <?php foreach ($setores as $setor) {?>
        
        <!-- Corpo de cada chamado -->
        <div class="corpo">
            <!-- Setor -->
            <div class="setor">                
                <strong><?php echo $setor->getNome(); ?></strong>
            </div>
            <!-- Chamado -->
            <div class="chamados">
                <?php foreach ($chamados as $chamado) {?>
                <?php if (($chamado->getIdsetor()) == ($setor->getIdsetor())){ ?>
                
                    <!-- Chamado em aberto -->
                    <?php if ($chamado->getIdocorrencia_estado() == 1){ //chamados em aberto?>
                        <strong>- Chamado em aberto nº 
                            <a href="<?php echo base_url("ocorrencia/buscar")."/".$chamado->getIdocorrencia(); ?>" target="_blank">
                            <?php echo $chamado->getIdocorrencia(); ?></a></strong>
                        <br/>
                        <strong>- Data abertura: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura()))." ".
                                date("H:i", strtotime($chamado->getData_abertura()))." por ".$chamado->getUsuario()."."; ?>
                        <br/>
                        <strong>- Descrição:</strong>
                        <div class="descricao">
                            <?php echo str_replace("\r\n", "<br/>", $chamado->getdescricao()); ?>                        
                        </div>
                        <strong>- Solução:</strong>
                        <br/>
                        <div class="descricao">
                            <?php echo "Aguardando atendimento." ?>
                        </div>
                        <br/>
                    <?php }?>   
                        
                    <!-- Chamado em atendimento -->
                    <?php if ($chamado->getIdocorrencia_estado() == 2){ //chamados em atendimento?>
                        <strong>- Chamado em atendimento nº 
                            <a href="<?php echo base_url("ocorrencia/buscar")."/".$chamado->getIdocorrencia(); ?>" target="_blank">
                            <?php echo $chamado->getIdocorrencia(); ?></a></strong> 
                        <br/>
                        <strong>- Data abertura: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura()))." ".
                                date("H:i", strtotime($chamado->getData_abertura()))." por ".$chamado->getUsuario()."."; ?>
                        <br/>
                        <strong>- Descrição:</strong>
                        <div class="descricao">
                            <?php echo str_replace("\r\n", "<br/>", $chamado->getdescricao()); ?>
                        </div>
                        <strong>- Aditamentos:</strong>
                        <br/>
                        <?php $comentarios = $comentario->buscaIdOcorrencia($chamado->getIdocorrencia()); //recebe todos coumentarios ?>
                        <?php if (count($comentarios) > 0){ ?>
                            <div class="descricao">
                                <?php $comentarios = $comentario->buscaIdOcorrencia($chamado->getIdocorrencia()); //recebe todos coumentarios ?>
                                <?php foreach ($comentarios as $value) { ?>
                                    <?php echo "<em>".date("d/m/Y", strtotime($value->getData()))." ".
                                        date("H:i", strtotime($value->getData()))."</em>: "; ?>
                                    <?php echo str_replace("\r\n", "<br/>", $value->getDescricao()); ?>
                                <br/>
                                <?php }?>
                            </div>
                            <br/>
                        <?php } else { echo "Ainda não possui aditamento. <br/>" ;}?>
                        
                    <?php }?> 
                        
                    <!-- Chamado fechado -->
                    <?php if ($chamado->getIdocorrencia_estado() == 3){ //chamados em fechado?>
                        <strong>- Chamado fechado nº 
                            <a href="<?php echo base_url("ocorrencia/buscar")."/".$chamado->getIdocorrencia(); ?>" target="_blank">
                            <?php echo $chamado->getIdocorrencia(); ?></a></strong> 
                        <br/>
                        <strong>- Data abertura: </strong><?php echo date("d/m/Y", strtotime($chamado->getData_abertura()))." ".
                                date("H:i", strtotime($chamado->getData_abertura()))." por ".$chamado->getUsuario()."."; ?>
                        <br/>
                        <strong>- Descrição:</strong>
                        <div class="descricao">
                            <?php echo str_replace("\r\n", "<br/>", $chamado->getdescricao())." (".$chamado->getUsuario().")."?>
                        </div>
                        <?php $comentarios = $comentario->buscaIdOcorrencia($chamado->getIdocorrencia()); //recebe todos coumentarios ?>
                        <?php if (count($comentarios) > 1){ ?>
                            <?php $solucao = array_shift($comentarios); //recebe a solução e retira a mesma do array ?>
                            <strong>- Aditamentos:</strong>
                            <br/>
                            <div class="descricao">
                                <?php foreach ($comentarios as $value) { ?> 
                                    <?php echo "<em>".date("d/m/Y", strtotime($value->getData()))." as ".
                                        date("H:i", strtotime($value->getData()))."</em>: "; ?>
                                    <?php echo str_replace("\r\n", "<br/>", $value->getDescricao()); ?>
                                <br/>
                                <?php }?>
                            </div>
                        <?php } else { $solucao = $comentarios; } //recebe a solução caso so exista a solução ?>
                        <strong>- Solução:</strong>
                        <br/>
                        <div class="descricao">
                            <?php echo "<em>".date("d/m/Y", strtotime($value->getData()))." ".
                                date("H:i", strtotime($value->getData()))."</em>: "; ?>
                            <?php echo str_replace("\r\n", "<br/>", $solucao->getDescricao()); ?>
                        </div>
                        <br/>
                    <?php }?>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <!-- Fim corpo chamado -->
    </body>
</html>
<!-- Fim sitema -->