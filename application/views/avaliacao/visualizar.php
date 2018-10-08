<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- visualizar alaviacao  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 titulo-nova-avaliacao">
            <h3>Avaliação: <strong><?php echo $lista[0]["aluno"]->getNome(); ?></strong></h3>
        </div>
        
        <!-- Mensagem de erro -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="alert alert-danger text-center" id="erro-visualizar-avaliacao" hidden="" ></div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            
            <div class="row">
                <?php if (isset($lista)){?>
                <!-- menu nav lista de avaliações-->
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach ($lista as $key => $value){ ?>
                    <li class="<?php if ($key == $ultimo_lista){ echo "active";} ?>">
                        <a href="#<?php echo $value["avaliacao"]->getIdavaliacao(); ?>" 
                           id="<?php echo $value["avaliacao"]->getIdavaliacao()."-tab"; ?>" data-toggle="tab"> 
                            Avaliação <strong><?php echo $value["avaliacao"]->getIdavaliacao()." | ".  date("d/m", strtotime($value["avaliacao"]->getData())); ?></strong>
                        </a>
                    </li>
                    <?php }?>
                </ul>
                
                <div class="row"> 
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-dados-tab">
                        <div class="tab-content">
                            <?php foreach ($lista as $key => $value){ ?>
                            <div class="tab-pane fade <?php if ($key == $ultimo_lista){echo "active in";} ?>" 
                                  id="<?php echo $value["avaliacao"]->getIdavaliacao(); ?>">
                                
                                <!-- OPÇOES -->
                                <div>
                                    <!-- Voltar -->                                
                                    <div class="avalaicao-op">
                                        <a class="btn btn-warning" href="JavaScript: window.history.back();" role="button">
                                            <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                                            Voltar
                                        </a>
                                    </div>
                                    <!-- Editar -->
                                    <div class="avalaicao-op">
                                        <a class="btn btn-primary" href="<?php echo base_url("avaliacao/editar")."/".$value["avaliacao"]->getIdavaliacao();?>" 
                                           role="button" id="btneditar<?php echo $value["avaliacao"]->getIdavaliacao();?>">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Editar
                                        </a>
                                    </div>
                                    <!-- Enviar e-mail -->
                                    <div class="avalaicao-op">
                                        <a class="btn btn-primary" role="button" href="#mdlEmailAvaliacao"
                                           id="btnemail<?php echo $value["avaliacao"]->getIdavaliacao();?>"
                                           data-toggle="modal" data-target="#mdlEmailAvaliacao"
                                           data-id="<?php echo $value["avaliacao"]->getIdavaliacao(); ?>"
                                           onclick="emailAvaliacao(this)">
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            Enviar por e-mail
                                        </a>
                                    </div>
                                    <!-- Gerar PDF -->
                                    <div class="avalaicao-op">
                                        <a class="btn btn-primary" href="<?php echo base_url("avaliacao/pdf")."/".$value["avaliacao"]->getIdavaliacao();?>" 
                                           role="button" id="btnvisualizar<?php echo $value["avaliacao"]->getIdavaliacao();?>" target=“_blank”>
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                            Gerar PDF
                                        </a>
                                    </div>
                                </div>                                
                                
                                 <!-- DADOS PESSOAIS -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">DADOS PESSOAIS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nome: </strong><?php echo $value["aluno"]->getNome(); ?></td>
                                            <td><strong>Cota: </strong> <?php echo $value["aluno"]->getCota(); ?></td>
                                            <td><strong>Idade: </strong> <?php echo $value["aluno"]->getIdade(); ?></td>
                                            <td><strong>Data: </strong> <?php echo date("d/m/Y", strtotime($value["avaliacao"]->getData())); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>E-mail: </strong><?php echo $value["aluno"]->getEmail(); ?></td>
                                            <td><strong>Sexo: </strong> <?php echo $value["aluno"]->getSexo(); ?></td>
                                            <td><strong>Estado Civil: </strong> <?php echo $value["aluno"]->getEstado_civil(); ?></td>
                                        </tr>
                                    </tbody>    
                                </table>
                                 
                                <!-- HISTÓRICO PESSOAL -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">HISTÓRICO PESSOAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Tabagista: </strong><?php echo $value["avaliacao"]->getTabagista(); ?></td>
                                            <td><strong>Etilista: </strong> <?php echo $value["avaliacao"]->getEtilista(); ?></td>
                                            <td colspan="2"><strong>Histórico de atividade física: </strong> <?php echo $value["avaliacao"]->getAtividade_fisica(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Profissão: </strong><?php echo $value["aluno"]->getProfissao(); ?></td>
                                            <td colspan="2"><strong>Posição de trabalho: </strong><?php echo $value["aluno"]->getPosicao_trabalho(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!-- DADOS CLÍNICOS -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">DADOS CLÍNICOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><strong>Lesão articular: </strong><?php echo $value["clinico"]->getLesao_articular(); ?></td>
                                            <td colspan="2"><strong>Coluna: </strong> <?php echo $value["clinico"]->getColuna(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Tratamento cardiológico: </strong><?php echo $value["clinico"]->getCardiologico(); ?></td>
                                            <td colspan="2"><strong>Varizes: </strong><?php echo $value["clinico"]->getVarizes(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Cirurgias: </strong><?php echo $value["clinico"]->getCirurgias(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Hérnia: </strong><?php echo $value["clinico"]->getHernia(); ?></td>
                                            <td colspan="2"><strong>P.A: </strong><?php echo $value["clinico"]->getPa(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>História familiar: </strong><?php echo $value["clinico"]->getHistoria_familiar(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Medicamentos: </strong><?php echo $value["clinico"]->getMedicamentos(); ?></td>
                                            <td colspan="2"><strong>Outras informações: </strong><?php echo $value["clinico"]->getInformacoes(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!-- EXAME FISIOTERÁPICO -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">EXAME FISIOTERÁPICO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4"><strong>Postura geral: </strong><?php echo $value["fisioterapico"]->getPostura(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Coluna vertebral: </strong><?php echo $value["fisioterapico"]->getColuna_vertebral(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Força muscular: </strong><?php echo $value["fisioterapico"]->getForca_muscular(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>ADM: </strong><?php echo $value["fisioterapico"]->getAdm(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Atividade física proposta: </strong><?php echo $value["fisioterapico"]->getAtividade_proposta(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Objetivo da atividade física: </strong><?php echo $value["fisioterapico"]->getObjetivo_atividade(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Exercícios contra-indicados: </strong><?php echo $value["fisioterapico"]->getExercicio_contra_indicado(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><strong>Conduta: </strong><?php echo $value["fisioterapico"]->getConduta(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!-- ANTROPOMETRIA -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">ANTROPOMETRIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Pescoço: </strong><?php echo $value["antropometria"]->getPescoco(); ?></td>
                                            <td><strong>Ombros: </strong><?php echo $value["antropometria"]->getOmbros(); ?></td>
                                            <td><strong>Tórax: </strong><?php echo $value["antropometria"]->getTorax(); ?></td>
                                            <td><strong>Cintura: </strong><?php echo $value["antropometria"]->getCintura(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Abdômem: </strong><?php echo $value["antropometria"]->getAbdomem(); ?></td>
                                            <td><strong>Quadril: </strong><?php echo $value["antropometria"]->getQuadril(); ?></td>
                                            <td><strong>Coxa direita: </strong><?php echo $value["antropometria"]->getCoxa_direita(); ?></td>
                                            <td><strong>Coxa esquerda: </strong><?php echo $value["antropometria"]->getCoxa_esquerda(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pant. direita: </strong><?php echo $value["antropometria"]->getPanturilha_direita(); ?></td>
                                            <td><strong>Pant. esquerda: </strong><?php echo $value["antropometria"]->getPanturilha_esquerda(); ?></td>
                                            <td><strong>Braço direito: </strong><?php echo $value["antropometria"]->getBraco_direito(); ?></td>
                                            <td><strong>Braço esquerdo: </strong><?php echo $value["antropometria"]->getBraco_esquerdo(); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Antebraço direito: </strong><?php echo $value["antropometria"]->getAntebraco_direito(); ?></td>
                                            <td colspan="2"><strong>Antebraço esquerdo: </strong><?php echo $value["antropometria"]->getAntebraco_esquerdo(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!-- BIOIMPEDÂNCIA -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="4">BIOIMPEDÂNCIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Peso: </strong><?php echo $value["bioimpedancia"]->getPeso(); ?></td>
                                            <td><strong>Altura: </strong><?php echo $value["bioimpedancia"]->getAltura(); ?></td>
                                            <td><strong>IMC: </strong><?php echo $value["bioimpedancia"]->getImc(); ?></td>
                                            <td><strong>% água: </strong><?php echo $value["bioimpedancia"]->getAgua(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Água (l) : </strong><?php echo $value["bioimpedancia"]->getAgua_l(); ?></td>
                                            <td><strong>Gordura corporal: </strong><?php echo $value["bioimpedancia"]->getGordura_corporal(); ?></td>
                                            <td><strong>Peso da gordura (kg): </strong><?php echo $value["bioimpedancia"]->getPeso_gordura(); ?></td>
                                            <td><strong>% gordura alvo: </strong><?php echo $value["bioimpedancia"]->getGordura_alvo(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>% massa magra: </strong><?php echo $value["bioimpedancia"]->getMassa_magra(); ?></td>
                                            <td><strong>Massa magra (kg): </strong><?php echo $value["bioimpedancia"]->getMassa_magra_kg(); ?></td>
                                            <td colspan="2"><strong>Índice muscular: </strong><?php echo $value["bioimpedancia"]->getIndice_muscular(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div class="graficobio" data-massa="<?php echo $value["bioimpedancia"]->getMassa_magra_kg(); ?>"
                                     data-peso="<?php echo $value["bioimpedancia"]->getPeso_gordura(); ?>">
                                    <canvas class="bioChart " id="<?php echo $value["avaliacao"]->getIdavaliacao(); ?>" data-chart="<?php echo $value["avaliacao"]->getIdavaliacao(); ?>"></canvas>
                                </div>
                                
                                <!-- TESTE DE CAPACIDADE AERÓBICA -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="info" >
                                            <th colspan="5">TESTE DE CAPACIDADE AERÓBICA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><strong>Freq. cardiaca máxima : </strong><?php echo $value["aerobica"]->getFreq_cardiaca_max(); ?></td>
                                            <td><strong>Freq repetição: </strong><?php echo $value["aerobica"]->getFreq_rep(); ?></td>
                                            <td colspan="2"><strong>Freq. cardiaca treino: </strong><?php echo $value["aerobica"]->getFreq_cardiaca_treino(); ?></td>
                                        </tr> 
                                    </tbody>
                                </table>
                                
                                <!-- AERÓBICA TESTE -->
                                <table class="table table-bordered table-condensed tabela-aerobica">
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
                                        <?php foreach ($value["aerobica_teste"] as $key => $valor) { ?>
                                        <tr>
                                            <td><?php echo $valor->getVelocidade(); ?></td>
                                            <td><?php echo $valor->getTempo(); ?></td>
                                            <td><?php echo $valor->getFreq_cardiaca(); ?></td>
                                            <td><?php echo $valor->getPse(); ?></td>
                                            <td><?php echo $valor->getMomento_corrida(); ?></td>
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
                                <table class="table table-bordered table-condensed tabela-aerobica">
                                    <thead>
                                        <tr class="active">
                                            <th class="text-center">Recuperação</th>
                                            <th class="text-center">Velocidade</th>
                                            <th class="text-center">BPM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($value["aerobica_recuperacao"] as $key => $valor) { ?>
                                        <tr>
                                            <td><?php echo $valor->getRecuperacao(); ?></td>
                                            <td><?php echo $valor->getVelocidade(); ?></td>
                                            <td><?php echo $valor->getBpm(); ?></td>
                                        </tr>  
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
                                <!-- AERÓBICA ZONA TEINAMENTO -->
                                <table class="table table-bordered table-condensed tabela-aerobica">
                                    <thead>
                                        <tr class="active">
                                            <th class="text-center">Zona de treinamento (ZT)</th>
                                            <th class="text-center">% da ZT</th>
                                            <th class="text-center">BPM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($value["aerobica_zona_treinamento"] as $key => $valor) { ?>
                                        <tr>
                                            <td><?php echo $valor->getZona_treinamento(); ?></td>
                                            <td><?php echo $valor->getPorcentagem(); ?></td>
                                            <td><?php echo $valor->getBpm(); ?></td>
                                        </tr>  
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
                            </div> <!-- fim tab-pane fade -->
                            <?php }?> <!-- fim foreach $lista -->
                        </div>
                    </div>
                </div>
            <?php }?> <!-- fim isset $lista -->
            </div> <!-- fim row -->
            
        </div><!-- fim coluna antes menu -->
              
    </div> <!-- fim row -->
    <!-- botão voltar --> 
    <div id="back" class="btn voltar-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </div> 
</div>