<!-- Inicio -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema PIC</title>

        <!-- METAS -->
        <meta charset="utf-8">  
        <link type="text/css" rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/sistemapic.avaliacao.css" />
    </head>
    <body>
        <div class="cabecalho-avaliacao" >
            <div class="imagem-cabecalho">
                <img class="logo" src="<?php echo $assetsUrl;?>/img/logo-pic.png">
            </div>
            <div class="texto-cabecalho">
                <h2>Avaliação funcional: <?php echo $aluno->getNome(); ?></h2>
            </div>
        </div>
        <!-- DADOS PESSOAIS -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">DADOS PESSOAIS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Nome: </strong><?php echo $aluno->getNome(); ?></td>
                    <td><strong>Cota: </strong> <?php echo $aluno->getCota(); ?></td>
                    <td><strong>Idade: </strong> <?php echo $aluno->getIdade(); ?></td>
                    <td><strong>Data: </strong> <?php echo date("d/m/Y", strtotime($avaliacao->getData())); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>E-mail: </strong><?php echo $aluno->getEmail(); ?></td>
                    <td><strong>Sexo: </strong> <?php echo $aluno->getSexo(); ?></td>
                    <td><strong>Estado Civil: </strong> <?php echo $aluno->getEstado_civil(); ?></td>
                </tr>
            </tbody>    
        </table>

        <!-- HISTÓRICO PESSOAL -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">HISTÓRICO PESSOAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Tabagista: </strong><?php echo $avaliacao->getTabagista(); ?></td>
                    <td><strong>Etilista: </strong> <?php echo $avaliacao->getEtilista(); ?></td>
                    <td colspan="2"><strong>Histórico de atividade física: </strong> <?php echo $avaliacao->getAtividade_fisica(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Profissão: </strong><?php echo $aluno->getProfissao(); ?></td>
                    <td colspan="2"><strong>Posição de trabalho: </strong><?php echo $aluno->getPosicao_trabalho(); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- DADOS CLÍNICOS -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">DADOS CLÍNICOS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><strong>Lesão articular: </strong><?php echo $clinico->getLesao_articular(); ?></td>
                    <td colspan="2"><strong>Coluna: </strong> <?php echo $clinico->getColuna(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Tratamento cardiológico: </strong><?php echo $clinico->getCardiologico(); ?></td>
                    <td colspan="2"><strong>Varizes: </strong><?php echo $clinico->getVarizes(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Cirurgias: </strong><?php echo $clinico->getCirurgias(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Hérnia: </strong><?php echo $clinico->getHernia(); ?></td>
                    <td colspan="2"><strong>P.A: </strong><?php echo $clinico->getPa(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>História familiar: </strong><?php echo $clinico->getHistoria_familiar(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Medicamentos: </strong><?php echo $clinico->getMedicamentos(); ?></td>
                    <td colspan="2"><strong>Outras informações: </strong><?php echo $clinico->getInformacoes(); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- EXAME FISIOTERÁPICO -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">EXAME FISIOTERÁPICO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4"><strong>Postura geral: </strong><?php echo $fisioterapico->getPostura(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Coluna vertebral: </strong><?php echo $fisioterapico->getColuna_vertebral(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Força muscular: </strong><?php echo $fisioterapico->getForca_muscular(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>ADM: </strong><?php echo $fisioterapico->getAdm(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Atividade física proposta: </strong><?php echo $fisioterapico->getAtividade_proposta(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Objetivo da atividade física: </strong><?php echo $fisioterapico->getObjetivo_atividade(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Exercícios contra-indicados: </strong><?php echo $fisioterapico->getExercicio_contra_indicado(); ?></td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Conduta: </strong><?php echo $fisioterapico->getConduta(); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- ANTROPOMETRIA -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">ANTROPOMETRIA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Pescoço: </strong><?php echo $antropometria->getPescoco(); ?></td>
                    <td><strong>Ombros: </strong><?php echo $antropometria->getOmbros(); ?></td>
                    <td><strong>Tórax: </strong><?php echo $antropometria->getTorax(); ?></td>
                    <td><strong>Cintura: </strong><?php echo $antropometria->getCintura(); ?></td>
                </tr>
                <tr>
                    <td><strong>Abdômem: </strong><?php echo $antropometria->getAbdomem(); ?></td>
                    <td><strong>Quadril: </strong><?php echo $antropometria->getQuadril(); ?></td>
                    <td><strong>Coxa direita: </strong><?php echo $antropometria->getCoxa_direita(); ?></td>
                    <td><strong>Coxa esquerda: </strong><?php echo $antropometria->getCoxa_esquerda(); ?></td>
                </tr>
                <tr>
                    <td><strong>Pant. direita: </strong><?php echo $antropometria->getPanturilha_direita(); ?></td>
                    <td><strong>Pant. esquerda: </strong><?php echo $antropometria->getPanturilha_esquerda(); ?></td>
                    <td><strong>Braço direito: </strong><?php echo $antropometria->getBraco_direito(); ?></td>
                    <td><strong>Braço esquerdo: </strong><?php echo $antropometria->getBraco_esquerdo(); ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Antebraço direito: </strong><?php echo $antropometria->getAntebraco_direito(); ?></td>
                    <td colspan="2"><strong>Antebraço esquerdo: </strong><?php echo $antropometria->getAntebraco_esquerdo(); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- BIOIMPEDÂNCIA -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="4">BIOIMPEDÂNCIA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Peso: </strong><?php echo $bioimpedancia->getPeso(); ?></td>
                    <td><strong>Altura: </strong><?php echo $bioimpedancia->getAltura(); ?></td>
                    <td><strong>IMC: </strong><?php echo $bioimpedancia->getImc(); ?></td>
                    <td><strong>% água: </strong><?php echo $bioimpedancia->getAgua(); ?></td>
                </tr>
                <tr>
                    <td><strong>Água (l) : </strong><?php echo $bioimpedancia->getAgua_l(); ?></td>
                    <td><strong>Gordura corporal: </strong><?php echo $bioimpedancia->getGordura_corporal(); ?></td>
                    <td><strong>Peso da gordura (kg): </strong><?php echo $bioimpedancia->getPeso_gordura(); ?></td>
                    <td><strong>% gordura alvo: </strong><?php echo $bioimpedancia->getGordura_alvo(); ?></td>
                </tr>
                <tr>
                    <td><strong>% massa magra: </strong><?php echo $bioimpedancia->getMassa_magra(); ?></td>
                    <td><strong>Massa magra (kg): </strong><?php echo $bioimpedancia->getMassa_magra_kg(); ?></td>
                    <td colspan="2"><strong>Índice muscular: </strong><?php echo $bioimpedancia->getIndice_muscular(); ?></td>
                </tr>
            </tbody>
        </table>
        
        <img class="imagem-grafico" id="pngcanvas" src="<?php echo $grafico; ?>"/>  
        
        <!-- TESTE DE CAPACIDADE AERÓBICA -->
        <table>
            <thead>
                <tr class="info" >
                    <th colspan="5">TESTE DE CAPACIDADE AERÓBICA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><strong>Freq. cardiaca máxima : </strong><?php echo $aerobica->getFreq_cardiaca_max(); ?></td>
                    <td><strong>Freq repetição: </strong><?php echo $aerobica->getFreq_rep(); ?></td>
                    <td colspan="2"><strong>Freq. cardiaca treino: </strong><?php echo $aerobica->getFreq_cardiaca_treino(); ?></td>
                </tr> 
            </tbody>
        </table>

        <!-- AERÓBICA TESTE -->
        <table class="tabela-aerobicat">
            <thead>
                <tr class="active">
                    <th class="text-center">Velociadade (km/h)</th>
                    <th class="text-center">Tempo (min)</th>
                    <th class="text-center">Freq. cardiaca</th>
                    <th class="text-center">PSE</th>
                    <th class="text-center">Momento da corrida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aerobicat as $key => $valor) { ?>
                <tr>
                    <td class="text-center"><?php echo $valor->getVelocidade(); ?></td>
                    <td class="text-center"><?php echo $valor->getTempo(); ?></td>
                    <td class="text-center"><?php echo $valor->getFreq_cardiaca(); ?></td>
                    <td class="text-center"><?php echo $valor->getPse(); ?></td>
                    <td class="text-center"><?php echo $valor->getMomento_corrida(); ?></td>
                </tr>  
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="waring">O teste de capacidade aeróbica é realizado a 1% de inclinação.</td>
                </tr>
            </tfoot>
        </table>

        <!-- AERÓBICA RECUPERACAO -->
        <table class="tabela-aerobicar">
            <thead>
                <tr class="active">
                    <th class="text-center">Recuperação</th>
                    <th class="text-center">Velocidade</th>
                    <th class="text-center">BPM</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aerobicar as $key => $valor) { ?>
                <tr>
                    <td class="text-center"><?php echo $valor->getRecuperacao(); ?></td>
                    <td class="text-center"><?php echo $valor->getVelocidade(); ?></td>
                    <td class="text-center"><?php echo $valor->getBpm(); ?></td>
                </tr>  
                <?php } ?>
            </tbody>
        </table>

        <!-- AERÓBICA ZONA TEINAMENTO -->
        <table class="tabela-aerobicazt">
            <thead>
                <tr class="active">
                    <th class="text-center">Zona de treinamento (ZT)</th>
                    <th class="text-center">% da ZT</th>
                    <th class="text-center">BPM</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aerobicazt as $key => $valor) { ?>
                <tr>
                    <td class="text-center"><?php echo $valor->getZona_treinamento(); ?></td>
                    <td class="text-center"><?php echo $valor->getPorcentagem(); ?></td>
                    <td class="text-center"><?php echo $valor->getBpm(); ?></td>
                </tr>  
                <?php } ?>
            </tbody>
        </table> 
        
        <!-- Assinatura hilton-->
        <div class="text-center assinatura">
            <p>
                ___________________________________________________________________<br>
                HILTON FREIRE    -   CREFITO 4-MG   4.309 F
            </p>
           
            
        </div>
    </body>
</html>
<!-- Fim sitema -->