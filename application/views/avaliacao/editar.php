<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- edição alaviacao  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 titulo-nova-avaliacao">
            <h3>Edição da avaliação: <strong><?php echo $lista["aluno"]->getNome(); ?></strong></h3>
        </div>
        
        <!-- Mensagem de erro -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="alert alert-danger text-center" id="erro-editar-avaliacao" hidden="" ></div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <!-- Formulario nova avaliação -->
            <form class="" id="frmEdtAvaliacao" method="post" action="<?php echo base_url("avaliacao/atualizar") ?>">
                <div class="row">
                    <!-- menu nav -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active">
                            <a href="#pessoais" id="pessoais-tab" data-toggle="tab"> Dados pessoais </a>
                        </li>
                        <li class="">
                            <a href="#historico" id="historico-tab" data-toggle="tab"> Histórico pessoal </a>
                        </li>
                        <li class="">
                            <a href="#clinico" id="clinico-tab" data-toggle="tab"> Clínico </a>
                        </li>
                        <li class="">
                            <a href="#fisioterapica" id="fisioterapica-tab" data-toggle="tab"> Fisioterápico </a>
                        </li>
                        <li class="">
                            <a href="#antropometria" id="antropometria-tab" data-toggle="tab"> Antropometria </a>
                        </li>
                        <li class="">
                            <a href="#bioimpedancia" id="bioimpedancia-tab" data-toggle="tab"> Bioimpedância </a>
                        </li>
                        <li class="">
                            <a href="#aerobica" id="aerobica-tab" data-toggle="tab"> Aeróbica </a>
                        </li>
                        <li class="">
                            <a href="#referencia" id="referencia-tab" data-toggle="tab"> Referência </a>
                        </li>
                    </ul>
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box-dados-tab">
                            <div class="tab-content">         
                                <!-- Dados pessoais -->
                                <div class="tab-pane fade active in" id="pessoais"> 
                                    <!-- ID avaliação -->
                                    <div class="col-md-12" hidden="">
                                        <div class="form-group">
                                            <label for="iptEdtIdAvaliacao">ID avaliação:</label>
                                            <input type="text" class="form-control" id="iptEdtIdAvaliacao" name="iptEdtIdAvaliacao" placeholder="Nome aluno" value="<?php echo $lista["avaliacao"]->getIdavaliacao(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Nome -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptEdtNomeAluno">Nome:</label>
                                            <input type="text" class="form-control" id="iptEdtNomeAluno" name="iptEdtNomeAluno" placeholder="Nome aluno" value="<?php echo $lista["aluno"]->getNome(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Cota -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtCota">Cota:</label>
                                            <input type="number" class="form-control" id="iptEdtCota" name="iptEdtCota" placeholder="0" value="<?php echo $lista["aluno"]->getCota(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Idade -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtIdade">Idade:</label>
                                            <input type="number" class="form-control" id="iptEdtIdade" name="iptEdtIdade" placeholder="0" value="<?php echo $lista["aluno"]->getIdade(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Data -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtData">Data:</label>
                                            <input type="date" class="form-control" id="iptEdtData" name="iptEdtData" value="<?php echo date("Y-m-d", strtotime($lista["avaliacao"]->getData())); ?>" >
                                        </div>                    
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptEdtEmailAluno">E-mail:</label>
                                            <input type="email" class="form-control" id="iptEdtEmailAluno" name="iptEdtEmailAluno" placeholder="E-mail aluno" value="<?php echo $lista["aluno"]->getEmail(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Sexo -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptEdtSexo">Sexo:</label>
                                            <input type="text" class="form-control" id="iptEdtSexo" name="iptEdtSexo" placeholder="Sexo" value="<?php echo $lista["aluno"]->getSexo(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Estado civil -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptEdtCivil">Estado civil:</label>
                                            <input type="text" class="form-control" id="iptEdtCivil" name="iptEdtCivil" placeholder="Estado civil" value="<?php echo $lista["aluno"]->getEstado_civil(); ?>">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Historico pessoal -->
                                <div class="tab-pane fade" id="historico">
                                    <!-- Tabagista -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtTanagista">Tabagista:</label>
                                            <input type="text" class="form-control" id="iptEdtTanagista" name="iptEdtTanagista" placeholder="Sim/Não" value="<?php echo $lista["avaliacao"]->getTabagista(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Etilista -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtEtilista">Etilista:</label>
                                            <input type="text" class="form-control" id="iptEdtEtilista" name="iptEdtEtilista" placeholder="Sim/Não" value="<?php echo $lista["avaliacao"]->getEtilista(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Profissão -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtProfissao">Profissão:</label>
                                            <input type="text" class="form-control" id="iptEdtProfissao" name="iptEdtProfissao" placeholder="Cargo" value="<?php echo $lista["aluno"]->getProfissao(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Posição de trabalho -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtPosicao">Posição de trabalho:</label>
                                            <input type="text" class="form-control" id="iptEdtPosicao" name="iptEdtPosicao" placeholder="Posição de trabalho" value="<?php echo $lista["aluno"]->getPosicao_trabalho(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Atividade fisica -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtAtividade">Histórico de atividade física:</label>
                                            <textarea class="form-control" id="iptEdtAtividade" name="iptEdtAtividade" placeholder="Atividades físicas" rows="3" ><?php echo $lista["avaliacao"]->getAtividade_fisica(); ?></textarea>
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Dados clinico -->
                                <div class="tab-pane fade" id="clinico">
                                    <!-- Lesão articular -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtLeArt">Lesão articular:</label>
                                            <input type="text" class="form-control" id="iptEdtLeArt" name="iptEdtLeArt" placeholder="Sim/Não" value="<?php echo $lista["clinico"]->getLesao_articular(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Tratamento cardiológico -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtTraCar">Trat. cardiológico:</label>
                                            <input type="text" class="form-control" id="iptEdtTraCar" name="iptEdtTraCar" placeholder="Sim/Não" value="<?php echo $lista["clinico"]->getCardiologico(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Coluna -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtColuna">Coluna:</label>
                                            <input type="text" class="form-control" id="iptEdtColuna" name="iptEdtColuna" placeholder="" value="<?php echo $lista["clinico"]->getColuna(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Varizes -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtVarizes">Varizes:</label>
                                            <input type="text" class="form-control" id="iptEdtVarizes" name="iptEdtVarizes" placeholder="" value="<?php echo $lista["clinico"]->getVarizes(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Cirurgias -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtCirurgias">Cirurgias:</label>
                                            <input type="text" class="form-control" id="iptEdtCirurgias" name="iptEdtCirurgias" placeholder="" value="<?php echo $lista["clinico"]->getCirurgias(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Hérnia -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="iptEdtHernia">Hérnia:</label>
                                            <input type="text" class="form-control" id="iptEdtHernia" name="iptEdtHernia" placeholder="" value="<?php echo $lista["clinico"]->getHernia(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Pulso -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPulso">Pulso:</label>
                                            <input type="text" class="form-control" id="iptEdtPulso" name="iptEdtPulso" placeholder="" value="<?php echo $lista["clinico"]->getPulso(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- P.A -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPa">P.A:</label>
                                            <input type="text" class="form-control" id="iptEdtPa" name="iptEdtPa" placeholder="" value="<?php echo $lista["clinico"]->getPa(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Medicamentos -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtMedicamentos">Medicamentos:</label>
                                            <input type="text" class="form-control" id="iptEdtMedicamentos" name="iptEdtMedicamentos" placeholder="" value="<?php echo $lista["clinico"]->getMedicamentos(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- História familiar -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtHisFam">História familiar:</label>
                                            <textarea class="form-control" id="iptEdtHisFam" name="iptEdtHisFam" placeholder=""><?php echo $lista["clinico"]->getHistoria_familiar(); ?></textarea>
                                        </div>                    
                                    </div>
                                    <!-- Outras informações -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtOutInf">Outras informações:</label>
                                            <input type="text" class="form-control" id="iptEdtOutInf" name="iptEdtOutInf" placeholder="" value="<?php echo $lista["clinico"]->getInformacoes(); ?>">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Exame fisioterapica -->
                                <div class="tab-pane fade" id="fisioterapica">
                                    <!-- Postura geral -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptEdtPostura">Postura geral:</label>
                                            <input type="text" class="form-control" id="iptEdtPostura" name="iptEdtPostura" placeholder="" value="<?php echo $lista["fisioterapico"]->getPostura(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Coluna vertebral -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptEdtColVer">Coluna vertebral:</label>
                                            <input type="text" class="form-control" id="iptEdtColVer" name="iptEdtColVer" placeholder="" value="<?php echo $lista["fisioterapico"]->getColuna_vertebral(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Força muscular -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptEdtForca">Força muscular:</label>
                                            <input type="text" class="form-control" id="iptEdtForca" name="iptEdtForca" placeholder="" value="<?php echo $lista["fisioterapico"]->getForca_muscular(); ?>">
                                        </div>                    
                                    </div>
<!--                                     Repetições 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtRepeticoes">Repetições:</label>
                                            <input type="text" class="form-control" id="iptEdtRepeticoes" name="iptEdtRepeticoes" placeholder="">
                                        </div>                    
                                    </div>-->
                                    <!-- ADM -->
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="iptEdtAdm">ADM:</label>
                                            <input type="text" class="form-control" id="iptEdtAdm" name="iptEdtAdm" placeholder="" value="<?php echo $lista["fisioterapico"]->getAdm(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Atividade física proposta -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtAtFiPro">Atividade física proposta:</label>
                                            <input type="text" class="form-control" id="iptEdtAtFiPro" name="iptEdtAtFiPro" placeholder="" value="<?php echo $lista["fisioterapico"]->getAtividade_proposta(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Objetivo da atividade física -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtObjAtFi">Objetivo da atividade física</label>
                                            <input type="text" class="form-control" id="iptEdtObjAtFi" name="iptEdtObjAtFi" placeholder="" value="<?php echo $lista["fisioterapico"]->getObjetivo_atividade(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Exercícios contra-indicados -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtExConInd">Exercícios contra-indicados </label>
                                            <input type="text" class="form-control" id="iptEdtExConInd" name="iptEdtExConInd" placeholder="" value="<?php echo $lista["fisioterapico"]->getExercicio_contra_indicado(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Conduta -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptEdtConduta">Conduta</label>
                                            <textarea type="text" class="form-control" id="iptEdtConduta" name="iptEdtConduta" placeholder=""><?php echo $lista["fisioterapico"]->getConduta(); ?></textarea>
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Antropometria -->
                                <div class="tab-pane fade" id="antropometria">
                                    <!-- Pescoço -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPescoco">Pescoço:</label>
                                            <input type="number" class="form-control" id="iptEdtPescoco" name="iptEdtPescoco" placeholder="" value="<?php echo $lista["antropometria"]->getPescoco(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Ombros -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtOmbros">Ombros:</label>
                                            <input type="number" class="form-control" id="iptEdtOmbros" name="iptEdtOmbros" placeholder="" value="<?php echo $lista["antropometria"]->getOmbros(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Tórax -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtTorax">Tórax:</label>
                                            <input type="number" class="form-control" id="iptEdtTorax" name="iptEdtTorax" placeholder="" value="<?php echo $lista["antropometria"]->getTorax(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Cintura -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtCintura">Cintura:</label>
                                            <input type="number" class="form-control" id="iptEdtCintura" name="iptEdtCintura" placeholder="" value="<?php echo $lista["antropometria"]->getCintura(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Abdômem -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtAbdomem">Abdômem:</label>
                                            <input type="number" class="form-control" id="iptEdtAbdomem" name="iptEdtAbdomem" placeholder="" value="<?php echo $lista["antropometria"]->getAbdomem(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Quadril -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtQuadril">Quadril:</label>
                                            <input type="number" class="form-control" id="iptEdtQuadril" name="iptEdtQuadril" placeholder="" value="<?php echo $lista["antropometria"]->getQuadril(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Coxa direita -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtCoxaDir">Coxa direita:</label>
                                            <input type="number" class="form-control" id="iptEdtCoxaDir" name="iptEdtCoxaDir" placeholder="" value="<?php echo $lista["antropometria"]->getCoxa_direita(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Coxa esquerda -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtCoxaEsq">Coxa esquerda:</label>
                                            <input type="number" class="form-control" id="iptEdtCoxaEsq" name="iptEdtCoxaEsq" placeholder="" value="<?php echo $lista["antropometria"]->getCoxa_esquerda(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Panturilha direita -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPanDir">Panturilha direita:</label>
                                            <input type="number" class="form-control" id="iptEdtPanDir" name="iptEdtPanDir" placeholder="" value="<?php echo $lista["antropometria"]->getPanturilha_direita(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Panturilha esquerda -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPanEsq">Panturilha esquerda:</label>
                                            <input type="number" class="form-control" id="iptEdtPanEsq" name="iptEdtPanEsq" placeholder="" value="<?php echo $lista["antropometria"]->getPanturilha_esquerda(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Braço direito -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtBraDir">Braço direito:</label>
                                            <input type="number" class="form-control" id="iptEdtBraDir" name="iptEdtBraDir" placeholder="" value="<?php echo $lista["antropometria"]->getBraco_direito(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Braço esquerdo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtBraEsq">Braço esquerdo:</label>
                                            <input type="number" class="form-control" id="iptEdtBraEsq" name="iptEdtBraEsq" placeholder="" value="<?php echo $lista["antropometria"]->getBraco_esquerdo(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Antebraço direito -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtAntBraDir">Antebraço direito:</label>
                                            <input type="number" class="form-control" id="iptEdtAntBraDir" name="iptEdtAntBraDir" placeholder="" value="<?php echo $lista["antropometria"]->getAntebraco_direito(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Antebraço esquerdo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtAntBraEsq">Antebraço esquerdo:</label>
                                            <input type="number" class="form-control" id="iptEdtAntBraEsq" name="iptEdtAntBraEsq" placeholder="" value="<?php echo $lista["antropometria"]->getAntebraco_esquerdo(); ?>">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Bioimpedancia -->
                                <div class="tab-pane fade" id="bioimpedancia">
                                    <!-- Peso -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPeso">Peso (kg):</label>
                                            <input type="number" class="form-control" id="iptEdtPeso" name="iptEdtPeso" placeholder="" value="<?php echo $lista["bioimpedancia"]->getPeso(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Altura -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtAltura">Altura (metros):</label>
                                            <input type="number" class="form-control" id="iptEdtAltura" name="iptEdtAltura" placeholder="" value="<?php echo $lista["bioimpedancia"]->getAltura(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- IMC -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtImc">IMC:</label>
                                            <input type="number" class="form-control" id="iptEdtImc" name="iptEdtImc" placeholder="" value="<?php echo $lista["bioimpedancia"]->getImc(); ?>"> 
                                        </div>                    
                                    </div>
                                    <!-- % Água -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptEdtPorAgua">Água (%):</label>
                                            <input type="number" class="form-control" id="iptEdtPorAgua" name="iptEdtPorAgua" placeholder=""value="<?php echo $lista["bioimpedancia"]->getAgua(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Água (l) -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptEdtAgua">Água (l):</label>
                                            <input type="number" class="form-control" id="iptEdtAgua" name="iptEdtAgua" placeholder="" value="<?php echo $lista["bioimpedancia"]->getAgua_l(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Gordura corporal -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtGorCor">Gordura corporal (%):</label>
                                            <input type="number" class="form-control" id="iptEdtGorCor" name="iptEdtGorCor" placeholder="" value="<?php echo $lista["bioimpedancia"]->getGordura_corporal(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Peso da gordura (kg) -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPesGor">Peso da gordura (kg):</label>
                                            <input type="number" class="form-control" id="iptEdtPesGor" name="iptEdtPesGor" placeholder=""value="<?php echo $lista["bioimpedancia"]->getPeso_gordura(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Porcentagem gordura alvo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPorGorAlv">Gordura alvo (%):</label>
                                            <input type="number" class="form-control" id="iptEdtPorGorAlv" name="iptEdtPorGorAlv" placeholder="" value="<?php echo $lista["bioimpedancia"]->getGordura_alvo(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Porcentagem massa magra -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtPorMasMag">Massa magra (%):</label>
                                            <input type="number" class="form-control" id="iptEdtPorMasMag" name="iptEdtPorMasMag" placeholder="" value="<?php echo $lista["bioimpedancia"]->getMassa_magra(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Massa magra -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtMasMag">Massa magra (kg):</label>
                                            <input type="number" class="form-control" id="iptEdtMasMag" name="iptEdtMasMag" placeholder="" value="<?php echo $lista["bioimpedancia"]->getMassa_magra_kg(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Indice Corporal -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptEdtIndCorporal">Índice corporal:</label>
                                            <input type="number" class="form-control" id="iptEdtIndCorporal" name="iptEdtIndCorporal" placeholder="" value="<?php echo $lista["bioimpedancia"]->getIndice_muscular(); ?>">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Capacidade aerobica -->
                                <div class="tab-pane fade" id="aerobica">
                                    <!-- Frequencia carga maxima -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtFreCarMax">Frequência carga maxima:</label>
                                            <input type="number" class="form-control" id="iptEdtFreCarMax" name="iptEdtFreCarMax" placeholder="" value="<?php echo $lista["aerobica"]->getFreq_cardiaca_max(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Frequencia carga maxima -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtFreRep">Frequência repetição:</label>
                                            <input type="number" class="form-control" id="iptEdtFreRep" name="iptEdtFreRep" placeholder="" value="<?php echo $lista["aerobica"]->getFreq_rep(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Frequencia rep. carga maxima treino -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptEdtFreRepCarMax">Frequência rep. carga maxima treino:</label>
                                            <input type="number" class="form-control" id="iptEdtFreRepCarMax" name="iptEdtFreRepCarMax" placeholder="" value="<?php echo $lista["aerobica"]->getFreq_cardiaca_treino(); ?>">
                                        </div>                    
                                    </div>
                                    <!-- Tabela Velocidade -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                            <div class="panel-group" id="tabelaAccordion" role="tablist" aria-multiselectable="true">

                                                <div class="panel panel-info">
                                                    <div class="panel-heading" role="tab" id="tabelaOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#tabelaAccordion" href="#tabelaCapacidade" aria-expanded="true" aria-controls="tabelaCapacidade">
                                                                Tabela de velocidade <span class="fa fa-angle-down"></span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="tabelaCapacidade" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabelaOne">
                                                        <div class="panel-body">                                                    
                                                            <!-- Tabela teste capacidade aerobica-->
                                                            <div class="col-md-12">
                                                                <table class="table table-condensed table-hover table-responsive">
                                                                    <!-- cabeçalho tabela -->
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Velocidade (km/h)</th>
                                                                            <th class="text-center">Tempo (min)</th>
                                                                            <th class="text-center">Freq. cardiaca</th>
                                                                            <th class="text-center">PSE</th>
                                                                            <th class="text-center">Momento da corrida</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- corpo tabela -->
                                                                    <tbody>
                                                                        <?php foreach ($lista["aerobica_teste"] as $key => $value) { ?>
                                                                        <tr>
                                                                            <td class="hidden"><input type="text" class="form-control input-sm text-center" id="iptEdtTId<?php echo $key; ?>" name="iptEdtTId<?php echo $key; ?>" placeholder="" value="<?php echo $value->getIdaerobica_teste(); ?>"></td>                                                                            
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtTVel<?php echo $key; ?>" name="iptEdtTVel<?php echo $key; ?>" placeholder="" value="<?php echo $value->getVelocidade(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtTTemp<?php echo $key; ?>" name="iptEdtTTemp<?php echo $key; ?>" placeholder="" value="<?php echo $value->getTempo(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtFreCard<?php echo $key; ?>" name="iptEdtFreCard<?php echo $key; ?>" placeholder="" value="<?php echo $value->getFreq_cardiaca(); ?>"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptEdtPse<?php echo $key; ?>" name="iptEdtPse<?php echo $key; ?>" placeholder="" value="<?php echo $value->getPse(); ?>"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptEdtMonCor<?php echo $key; ?>" name="iptEdtMonCor<?php echo $key; ?>" placeholder="" value="<?php echo $value->getMomento_corrida(); ?>"></td>
                                                                        </tr>
                                                                        <?php } ?>                                                                        
                                                                    </tbody>
                                                                </table>
                                                                <span id="helpBlock" class="help-block">O teste de capacidade aeróbica é realizado a 1% de inclinação.</span>
                                                            </div>
                                                        </div> <!-- panel-body -->     
                                                    </div>
                                                </div> <!-- panel-info -->  

                                                <div class="panel panel-info">
                                                    <div class="panel-heading" role="tab" id="tabelaTwo">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#tabelaAccordion" href="#tabelaRecuperacao" aria-expanded="true" aria-controls="tabelaRecuperacao">
                                                                Tabela de recuperaçao <span class="fa fa-angle-down"></span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="tabelaRecuperacao" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabelaTwo">
                                                        <div class="panel-body">                                                    
                                                            <!-- Tabela recuperacao-->
                                                            <div class="col-md-12">
                                                                <table class="table table-condensed table-hover table-responsive">
                                                                    <!-- cabeçalho tabela -->
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Recuperação</th>
                                                                            <th class="text-center">Velocidade</th>
                                                                            <th class="text-center">BPM</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- corpo tabela -->
                                                                    <tbody>
                                                                        <?php foreach ($lista["aerobica_recuperacao"] as $key => $value) { ?>
                                                                        <tr>
                                                                            <td class="hidden"><input type="text" class="form-control input-sm text-center" id="iptEdtRId<?php echo $key; ?>" name="iptEdtRId<?php echo $key; ?>" placeholder="" value="<?php echo $value->getIdaerobica_recuperacao(); ?>"></td> 
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptEdtRec<?php echo $key; ?>" name="iptEdtRec<?php echo $key; ?>" placeholder="" value="<?php echo $value->getRecuperacao(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtVel<?php echo $key; ?>" name="iptEdtVel<?php echo $key; ?>" placeholder="" value="<?php echo $value->getVelocidade(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtBpm<?php echo $key; ?>" name="iptEdtBpm<?php echo $key; ?>" placeholder="" value="<?php echo $value->getBpm(); ?>"></td>
                                                                        </tr>
                                                                        <?php } ?>                                                                
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> <!-- panel-body -->     
                                                    </div>
                                                </div> <!-- panel-info -->  

                                                <div class="panel panel-info">
                                                    <div class="panel-heading" role="tab" id="tabelaTree">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#tabelaAccordion" href="#tabelaTreinamento" aria-expanded="true" aria-controls="tabelaTreinamento">
                                                                Tabela de zona de treinamento <span class="fa fa-angle-down"></span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="tabelaTreinamento" class="panel-collapse collapse" role="tabpanel" aria-labelledby="tabelaTree">
                                                        <div class="panel-body">                                                    
                                                            <!-- Tabela recuperacao-->
                                                            <div class="col-md-12">
                                                                <table class="table table-condensed table-hover table-responsive">
                                                                    <!-- cabeçalho tabela -->
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Zona de treinamento (ZT)</th>
                                                                            <th class="text-center">Porcentagem da ZT</th>
                                                                            <th class="text-center">BPM</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- corpo tabela -->
                                                                    <tbody>
                                                                        <?php foreach ($lista["aerobica_zona_treinamento"] as $key => $value) { ?>
                                                                        <tr>
                                                                            <td class="hidden"><input type="text" class="form-control input-sm text-center" id="iptEdtZTId<?php echo $key; ?>" name="iptEdtZTId<?php echo $key; ?>" placeholder="" value="<?php echo $value->getIdaerobica_zona_treinamento(); ?>"></td> 
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptEdtZT<?php echo $key; ?>" name="iptEdtZT<?php echo $key; ?>" placeholder="" value="<?php echo $value->getZona_treinamento(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtPorZT<?php echo $key; ?>" name="iptEdtPorZT<?php echo $key; ?>" placeholder="" value="<?php echo $value->getPorcentagem(); ?>"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptEdtBpmZT<?php echo $key; ?>" name="iptEdtBpmZT<?php echo $key; ?>" placeholder="" value="<?php echo $value->getBpm(); ?>"></td>
                                                                        </tr> 
                                                                        <?php } ?>                                                                                                                                      
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> <!-- panel-body -->     
                                                    </div>
                                                </div> <!-- panel-info -->  

                                            </div> <!-- panel-group -->
                                        </div> <!-- col -->  
                                    </div><!-- row -->  
                                </div>
                                
                                <!-- Valores de referência -->
                                <div class="tab-pane fade" id="referencia">
                                    <div class="row">
                                        <!-- IMC -->
                                        <div class="col-md-4 col-lg-offset-4">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="3">IMC</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Falta de peso</th>
                                                        <th class="text-center">Peso normal</th>
                                                        <th class="text-center">Excesso</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><18.5</td>
                                                        <td class="text-center"><18.5 - 25</td>
                                                        <td class="text-center">>25</td>
                                                    </tr>                                                               
                                                </tbody>
                                            </table>
                                        </div> 
                                        
                                        <!-- Indice de gordura corporal -->
                                        <!-- Homem -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="5">ÍNDICE DE GORDURA CORPORAL (Homem)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Baixo</th>
                                                        <th class="text-center">Normal</th>
                                                        <th class="text-center">Alto</th>
                                                        <th class="text-center">Muito alto</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 14</td>
                                                        <td class="text-center"><11</td>
                                                        <td class="text-center">11 - 16</td>
                                                        <td class="text-center">16.1 - 21</td>
                                                        <td class="text-center">>21.1</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">15 - 19</td>
                                                        <td class="text-center"><12</td>
                                                        <td class="text-center">12 - 17</td>
                                                        <td class="text-center">17.1 - 22</td>
                                                        <td class="text-center">>22.1</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">20 - 29</td>
                                                        <td class="text-center"><13</td>
                                                        <td class="text-center">13 - 18</td>
                                                        <td class="text-center">18.1 - 23</td>
                                                        <td class="text-center">>23.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">30 - 39</td>
                                                        <td class="text-center"><14</td>
                                                        <td class="text-center">14 - 19</td>
                                                        <td class="text-center">19.1 - 24</td>
                                                        <td class="text-center">>24.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">40 - 49</td>
                                                        <td class="text-center"><15</td>
                                                        <td class="text-center">15 - 20</td>
                                                        <td class="text-center">20.1 - 25</td>
                                                        <td class="text-center">>25.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">50 - 59</td>
                                                        <td class="text-center"><16</td>
                                                        <td class="text-center">16 - 21</td>
                                                        <td class="text-center">21.1 - 26</td>
                                                        <td class="text-center">>26.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 - 69</td>
                                                        <td class="text-center"><17</td>
                                                        <td class="text-center">17 - 22</td>
                                                        <td class="text-center">22.1 - 27</td>
                                                        <td class="text-center">>27.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">70 - 100</td>
                                                        <td class="text-center"><18</td>
                                                        <td class="text-center">18 - 23</td>
                                                        <td class="text-center">23.1 - 28</td>
                                                        <td class="text-center">>28.1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> 
                                        <!-- Mulher -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="5">ÍNDICE DE GORDURA CORPORAL (Mulher)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Baixo</th>
                                                        <th class="text-center">Normal</th>
                                                        <th class="text-center">Alto</th>
                                                        <th class="text-center">Muito alto</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 14</td>
                                                        <td class="text-center"><16</td>
                                                        <td class="text-center">16 - 21</td>
                                                        <td class="text-center">21.1 - 26</td>
                                                        <td class="text-center">>26.1</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">15 - 19</td>
                                                        <td class="text-center"><17</td>
                                                        <td class="text-center">17 - 22</td>
                                                        <td class="text-center">22.1 - 27</td>
                                                        <td class="text-center">>27.1</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">20 - 29</td>
                                                        <td class="text-center"><18</td>
                                                        <td class="text-center">18 - 23</td>
                                                        <td class="text-center">23.1 - 28</td>
                                                        <td class="text-center">>28.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">30 - 39</td>
                                                        <td class="text-center"><19</td>
                                                        <td class="text-center">19 - 24</td>
                                                        <td class="text-center">24.1 - 29</td>
                                                        <td class="text-center">>29.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">40 - 49</td>
                                                        <td class="text-center"><20</td>
                                                        <td class="text-center">20 - 25</td>
                                                        <td class="text-center">25.1 - 30</td>
                                                        <td class="text-center">>30.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">50 - 59</td>
                                                        <td class="text-center"><21</td>
                                                        <td class="text-center">21 - 26</td>
                                                        <td class="text-center">26.1 - 31</td>
                                                        <td class="text-center">>31.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 - 69</td>
                                                        <td class="text-center"><22</td>
                                                        <td class="text-center">22 - 27</td>
                                                        <td class="text-center">27.1 - 32</td>
                                                        <td class="text-center">>32.1</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">70 - 100</td>
                                                        <td class="text-center"><23</td>
                                                        <td class="text-center">23 - 28</td>
                                                        <td class="text-center">28.1 - 33</td>
                                                        <td class="text-center">>33.1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <!-- Índice de Líquido Corporal -->
                                        <!-- Homem -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4">ÍNDICE DE LÍQUIDO CORPORAL (Homem)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Mau</th>
                                                        <th class="text-center">Bom</th>
                                                        <th class="text-center">Muito bom</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 100</td>
                                                        <td class="text-center"><50</td>
                                                        <td class="text-center">50 - 65</td>
                                                        <td class="text-center">>65</td>
                                                    </tr>                                                     
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Mulher -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4">ÍNDICE DE LÍQUIDO CORPORAL (Mulher)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Mau</th>
                                                        <th class="text-center">Bom</th>
                                                        <th class="text-center">Muito bom</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 100</td>
                                                        <td class="text-center"><45</td>
                                                        <td class="text-center">45 - 60</td>
                                                        <td class="text-center">>60</td>
                                                    </tr>                                                     
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <!-- Índice Muscular -->
                                        <!-- Homem -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4">ÍNDICE MUSCULAR (Homem)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Baixo</th>
                                                        <th class="text-center">Normal</th>
                                                        <th class="text-center">Alto</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 14</td>
                                                        <td class="text-center"><44</td>
                                                        <td class="text-center">44 - 57</td>
                                                        <td class="text-center">>57</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">15 - 19</td>
                                                        <td class="text-center"><43</td>
                                                        <td class="text-center">43 - 56</td>
                                                        <td class="text-center">>56</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">20 - 29</td>
                                                        <td class="text-center"><42</td>
                                                        <td class="text-center">42 - 54</td>
                                                        <td class="text-center">>54</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">30 - 39</td>
                                                        <td class="text-center"><41</td>
                                                        <td class="text-center">41 - 52</td>
                                                        <td class="text-center">>52</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">40 - 49</td>
                                                        <td class="text-center"><40</td>
                                                        <td class="text-center">40 - 50</td>
                                                        <td class="text-center">>50</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">50 - 59</td>
                                                        <td class="text-center"><39</td>
                                                        <td class="text-center">39 - 48</td>
                                                        <td class="text-center">>48</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 - 69</td>
                                                        <td class="text-center"><38</td>
                                                        <td class="text-center">38 - 47</td>
                                                        <td class="text-center">>47</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">70 - 100</td>
                                                        <td class="text-center"><37</td>
                                                        <td class="text-center">37 - 46</td>
                                                        <td class="text-center">>46</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Mulher -->
                                        <div class="col-md-6">
                                            <table class="table table-condensed table-hover table-responsive">
                                                <!-- cabeçalho tabela -->
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4">ÍNDICE MUSCULAR (Mulher)</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center">Idade</th>
                                                        <th class="text-center">Baixo</th>
                                                        <th class="text-center">Normal</th>
                                                        <th class="text-center">Alto</th>
                                                    </tr>
                                                </thead>
                                                <!-- corpo tabela -->
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">10 - 14</td>
                                                        <td class="text-center"><36</td>
                                                        <td class="text-center">36 - 43</td>
                                                        <td class="text-center">>43</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">15 - 19</td>
                                                        <td class="text-center"><35</td>
                                                        <td class="text-center">35 - 41</td>
                                                        <td class="text-center">>41</td>
                                                    </tr> 
                                                    <tr>
                                                        <td class="text-center">20 - 29</td>
                                                        <td class="text-center"><34</td>
                                                        <td class="text-center">34 - 39</td>
                                                        <td class="text-center">>39</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">30 - 39</td>
                                                        <td class="text-center"><33</td>
                                                        <td class="text-center">33 - 38</td>
                                                        <td class="text-center">>38</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">40 - 49</td>
                                                        <td class="text-center"><31</td>
                                                        <td class="text-center">31 - 36</td>
                                                        <td class="text-center">>36</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">50 - 59</td>
                                                        <td class="text-center"><29</td>
                                                        <td class="text-center">29 - 34</td>
                                                        <td class="text-center">>34</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 - 69</td>
                                                        <td class="text-center"><28</td>
                                                        <td class="text-center">28 - 33</td>
                                                        <td class="text-center">>33</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">70 - 100</td>
                                                        <td class="text-center"><27</td>
                                                        <td class="text-center">27 - 32</td>
                                                        <td class="text-center">>32</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div> <!-- fim tab-content -->
                        </div>
                    </div>
                </div> <!-- fim row -->  
                <div class="text-right">
                    <!-- OPÇOES -->
                    <div>
                        <!-- Voltar -->                                
                        <div class="avalaicao-op">
                            <a class="btn btn-warning" href="JavaScript: window.history.back();" role="button">
                                <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                                Voltar
                            </a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary carregando">
                        Salvar avaliação
                    </button>
                </div>                
            </form>
            
        </div>
              
    </div> <!-- fim row -->
    <!-- botão voltar --> 
    <div id="back" class="btn voltar-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </div> 
</div>