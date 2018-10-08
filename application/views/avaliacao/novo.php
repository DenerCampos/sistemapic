<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- alaviacao  -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 titulo-nova-avaliacao">
            <h3>Nova avaliação funcional</h3>
        </div>
        
        <!-- Mensagem de erro -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="alert alert-danger text-center" id="erro-nova-avaliacao" hidden="" ></div>
        </div>
        <!-- Mensagem para buscar dados do aluno -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="alert alert-danger text-center" id="buscar-dados-avaliacao" hidden="" >
                <span></span>
                <a class="btn btn-danger" role="button" href="#"
                   onclick="buscaDadosAluno()">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Buscar dados
                </a>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <!-- Formulario nova avaliação -->
            <form class="" id="frmCriAvaliacao" method="post" action="<?php echo base_url("avaliacao/criar") ?>">
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
                                    <!-- Nome -->
                                    <div class="col-md-6">
                                        <div class="ui-widget form-group">
                                            <label for="iptCriNomeAluno">Nome:</label>
                                            <input type="text" class="form-control" id="iptCriNomeAluno" name="iptCriNomeAluno" placeholder="Nome aluno">
                                        </div>                    
                                    </div>
                                    <!-- Cota -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriCota">Cota:</label>
                                            <input type="number" class="form-control" id="iptCriCota" name="iptCriCota" placeholder="0">
                                        </div>                    
                                    </div>
                                    <!-- Idade -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriIdade">Idade:</label>
                                            <input type="number" class="form-control" id="iptCriIdade" name="iptCriIdade" placeholder="0">
                                        </div>                    
                                    </div>
                                    <!-- Data -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriData">Data:</label>
                                            <input type="date" class="form-control" id="iptCriData" name="iptCriData" value="<?php echo date("Y-m-d");?>" >
                                        </div>                    
                                    </div>
                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptCriEmailAluno">E-mail:</label>
                                            <input type="email" class="form-control" id="iptCriEmailAluno" name="iptCriEmailAluno" placeholder="E-mail aluno">
                                        </div>                    
                                    </div>
                                    <!-- Sexo -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptCriSexo">Sexo:</label>
                                            <input type="text" class="form-control" id="iptCriSexo" name="iptCriSexo" placeholder="Sexo">
                                        </div>                    
                                    </div>
                                    <!-- Estado civil -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptCriCivil">Estado civil:</label>
                                            <input type="text" class="form-control" id="iptCriCivil" name="iptCriCivil" placeholder="Estado civil">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Historico pessoal -->
                                <div class="tab-pane fade" id="historico">
                                    <!-- Tabagista -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriTanagista">Tabagista:</label>
                                            <input type="text" class="form-control" id="iptCriTanagista" name="iptCriTanagista" placeholder="Sim/Não">
                                        </div>                    
                                    </div>
                                    <!-- Etilista -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriEtilista">Etilista:</label>
                                            <input type="text" class="form-control" id="iptCriEtilista" name="iptCriEtilista" placeholder="Sim/Não">
                                        </div>                    
                                    </div>
                                    <!-- Profissão -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriProfissao">Profissão:</label>
                                            <input type="text" class="form-control" id="iptCriProfissao" name="iptCriProfissao" placeholder="Cargo">
                                        </div>                    
                                    </div>
                                    <!-- Posição de trabalho -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriPosicao">Posição de trabalho:</label>
                                            <input type="text" class="form-control" id="iptCriPosicao" name="iptCriPosicao" placeholder="Posição de trabalho">
                                        </div>                    
                                    </div>
                                    <!-- Atividade fisica -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriAtividade">Histórico de atividade física:</label>
                                            <textarea class="form-control" id="iptCriAtividade" name="iptCriAtividade" placeholder="Atividades físicas" rows="4" ></textarea>
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Dados clinico -->
                                <div class="tab-pane fade" id="clinico">
                                    <!-- Lesão articular -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriLeArt">Lesão articular:</label>
                                            <input type="text" class="form-control" id="iptCriLeArt" name="iptCriLeArt" placeholder="Lesões">
                                        </div>                    
                                    </div>
                                    <!-- Tratamento cardiológico -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriTraCar">Trat. cardiológico:</label>
                                            <input type="text" class="form-control" id="iptCriTraCar" name="iptCriTraCar" placeholder="Tratamentos">
                                        </div>                    
                                    </div>
                                    <!-- Coluna -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriColuna">Coluna:</label>
                                            <input type="text" class="form-control" id="iptCriColuna" name="iptCriColuna" placeholder="Coluna">
                                        </div>                    
                                    </div>
                                    <!-- Varizes -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriVarizes">Varizes:</label>
                                            <input type="text" class="form-control" id="iptCriVarizes" name="iptCriVarizes" placeholder="Varizes">
                                        </div>                    
                                    </div>
                                    <!-- Cirurgias -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriCirurgias">Cirurgias:</label>
                                            <input type="text" class="form-control" id="iptCriCirurgias" name="iptCriCirurgias" placeholder="Cirurgias">
                                        </div>                    
                                    </div>
                                    <!-- Hérnia -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="iptCriHernia">Hérnia:</label>
                                            <input type="text" class="form-control" id="iptCriHernia" name="iptCriHernia" placeholder="Hérnia">
                                        </div>                    
                                    </div>
                                    <!-- Pulso -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPulso">Pulso:</label>
                                            <input type="text" class="form-control" id="iptCriPulso" name="iptCriPulso" placeholder="Pulso">
                                        </div>                    
                                    </div>
                                    <!-- P.A -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPa">P.A:</label>
                                            <input type="text" class="form-control" id="iptCriPa" name="iptCriPa" placeholder="P.A">
                                        </div>                    
                                    </div>
                                    <!-- Medicamentos -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriMedicamentos">Medicamentos:</label>
                                            <input type="text" class="form-control" id="iptCriMedicamentos" name="iptCriMedicamentos" placeholder="Medicamentos">
                                        </div>                    
                                    </div>
                                    <!-- História familiar -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriHisFam">História familiar:</label>
                                            <textarea class="form-control" id="iptCriHisFam" name="iptCriHisFam" placeholder="História familiar" rows="3"></textarea>
                                        </div>                    
                                    </div>
                                    <!-- Outras informações -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriOutInf">Outras informações:</label>
                                            <input type="text" class="form-control" id="iptCriOutInf" name="iptCriOutInf" placeholder="Outras informações">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Exame fisioterapica -->
                                <div class="tab-pane fade" id="fisioterapica">
                                    <!-- Postura geral -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptCriPostura">Postura geral:</label>
                                            <input type="text" class="form-control" id="iptCriPostura" name="iptCriPostura" placeholder="Postura geral">
                                        </div>                    
                                    </div>
                                    <!-- Coluna vertebral -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="iptCriColVer">Coluna vertebral:</label>
                                            <input type="text" class="form-control" id="iptCriColVer" name="iptCriColVer" placeholder="Coluna vertebral">
                                        </div>                    
                                    </div>
                                    <!-- Força muscular -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptCriForca">Força muscular:</label>
                                            <input type="text" class="form-control" id="iptCriForca" name="iptCriForca" placeholder="Força muscular">
                                        </div>                    
                                    </div>
<!--                                     Repetições 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriRepeticoes">Repetições:</label>
                                            <input type="text" class="form-control" id="iptCriRepeticoes" name="iptCriRepeticoes" placeholder="">
                                        </div>                    
                                    </div>-->
                                    <!-- ADM -->
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="iptCriAdm">ADM:</label>
                                            <input type="text" class="form-control" id="iptCriAdm" name="iptCriAdm" placeholder="ADM">
                                        </div>                    
                                    </div>
                                    <!-- Atividade física proposta -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriAtFiPro">Atividade física proposta:</label>
                                            <input type="text" class="form-control" id="iptCriAtFiPro" name="iptCriAtFiPro" placeholder="Atividade física proposta">
                                        </div>                    
                                    </div>
                                    <!-- Objetivo da atividade física -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriObjAtFi">Objetivo da atividade física</label>
                                            <input type="text" class="form-control" id="iptCriObjAtFi" name="iptCriObjAtFi" placeholder="Objetivo da atividade física">
                                        </div>                    
                                    </div>
                                    <!-- Exercícios contra-indicados -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriExConInd">Exercícios contra-indicados </label>
                                            <input type="text" class="form-control" id="iptCriExConInd" name="iptCriExConInd" placeholder="Exercícios contra-indicados">
                                        </div>                    
                                    </div>
                                    <!-- Conduta -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="iptCriConduta">Conduta</label>
                                            <textarea class="form-control" id="iptCriConduta" name="iptCriConduta" placeholder="Conduta" rows="3"></textarea>
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Antropometria -->
                                <div class="tab-pane fade" id="antropometria">
                                    <!-- Pescoço -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPescoco">Pescoço:</label>
                                            <input type="number" class="form-control" id="iptCriPescoco" name="iptCriPescoco" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Ombros -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriOmbros">Ombros:</label>
                                            <input type="number" class="form-control" id="iptCriOmbros" name="iptCriOmbros" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Tórax -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriTorax">Tórax:</label>
                                            <input type="number" class="form-control" id="iptCriTorax" name="iptCriTorax" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Cintura -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriCintura">Cintura:</label>
                                            <input type="number" class="form-control" id="iptCriCintura" name="iptCriCintura" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Abdômem -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriAbdomem">Abdômem:</label>
                                            <input type="number" class="form-control" id="iptCriAbdomem" name="iptCriAbdomem" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Quadril -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriQuadril">Quadril:</label>
                                            <input type="number" class="form-control" id="iptCriQuadril" name="iptCriQuadril" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Coxa direita -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriCoxaDir">Coxa direita:</label>
                                            <input type="number" class="form-control" id="iptCriCoxaDir" name="iptCriCoxaDir" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Coxa esquerda -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriCoxaEsq">Coxa esquerda:</label>
                                            <input type="number" class="form-control" id="iptCriCoxaEsq" name="iptCriCoxaEsq" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Panturilha direita -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPanDir">Panturilha direita:</label>
                                            <input type="number" class="form-control" id="iptCriPanDir" name="iptCriPanDir" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Panturilha esquerda -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPanEsq">Panturilha esquerda:</label>
                                            <input type="number" class="form-control" id="iptCriPanEsq" name="iptCriPanEsq" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Braço direito -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriBraDir">Braço direito:</label>
                                            <input type="number" class="form-control" id="iptCriBraDir" name="iptCriBraDir" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Braço esquerdo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriBraEsq">Braço esquerdo:</label>
                                            <input type="number" class="form-control" id="iptCriBraEsq" name="iptCriBraEsq" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Antebraço direito -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriAntBraDir">Antebraço direito:</label>
                                            <input type="number" class="form-control" id="iptCriAntBraDir" name="iptCriAntBraDir" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Antebraço esquerdo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriAntBraEsq">Antebraço esquerdo:</label>
                                            <input type="number" class="form-control" id="iptCriAntBraEsq" name="iptCriAntBraEsq" placeholder="">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Bioimpedancia -->
                                <div class="tab-pane fade" id="bioimpedancia">
                                    <!-- Peso -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPeso">Peso (kg):</label>
                                            <input type="number" class="form-control" id="iptCriPeso" name="iptCriPeso" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Altura -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriAltura">Altura (metros):</label>
                                            <input type="text" class="form-control" id="iptCriAltura" name="iptCriAltura" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- IMC -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriImc">IMC:</label>
                                            <input type="number" class="form-control" id="iptCriImc" name="iptCriImc" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- % Água -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptCriPorAgua">Água (%):</label>
                                            <input type="number" class="form-control" id="iptCriPorAgua" name="iptCriPorAgua" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Água (l) -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="iptCriAgua">Água (l):</label>
                                            <input type="number" class="form-control" id="iptCriAgua" name="iptCriAgua" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Gordura corporal -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriGorCor">Gordura corporal (%):</label>
                                            <input type="number" class="form-control" id="iptCriGorCor" name="iptCriGorCor" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Peso da gordura (kg) -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPesGor">Peso da gordura (kg):</label>
                                            <input type="number" class="form-control" id="iptCriPesGor" name="iptCriPesGor" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Porcentagem gordura alvo -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPorGorAlv">Gordura alvo (%):</label>
                                            <input type="number" class="form-control" id="iptCriPorGorAlv" name="iptCriPorGorAlv" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Porcentagem massa magra -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriPorMasMag">Massa magra (%):</label>
                                            <input type="number" class="form-control" id="iptCriPorMasMag" name="iptCriPorMasMag" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Massa magra -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriMasMag">Massa magra (kg):</label>
                                            <input type="number" class="form-control" id="iptCriMasMag" name="iptCriMasMag" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Indice Corporal -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="iptCriIndCorporal">Índice corporal:</label>
                                            <input type="number" class="form-control" id="iptCriIndCorporal" name="iptCriIndCorporal" placeholder="">
                                        </div>                    
                                    </div>
                                </div>

                                <!-- Capacidade aerobica -->
                                <div class="tab-pane fade" id="aerobica">
                                    <!-- Frequencia carga maxima -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriFreCarMax">Frequência carga maxima:</label>
                                            <input type="number" class="form-control" id="iptCriFreCarMax" name="iptCriFreCarMax" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Frequencia carga maxima -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriFreRep">Frequência repetição:</label>
                                            <input type="number" class="form-control" id="iptCriFreRep" name="iptCriFreRep" placeholder="">
                                        </div>                    
                                    </div>
                                    <!-- Frequencia rep. carga maxima treino -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="iptCriFreRepCarMax">Frequência rep. carga maxima treino:</label>
                                            <input type="number" class="form-control" id="iptCriFreRepCarMax" name="iptCriFreRepCarMax" placeholder="">
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
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel0" name="iptCriTVel0" placeholder="" value="0"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp0" name="iptCriTTemp0" placeholder="" value="0"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard0" name="iptCriFreCard0" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse0" name="iptCriPse0" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor0" name="iptCriMonCor0" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel1" name="iptCriTVel1" placeholder="" value="5"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp1" name="iptCriTTemp1" placeholder="" value="1"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard1" name="iptCriFreCard1" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse1" name="iptCriPse1" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor1" name="iptCriMonCor1" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel2" name="iptCriTVel2" placeholder="" value="5"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp2" name="iptCriTTemp2" placeholder="" value="2"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard2" name="iptCriFreCard2" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse2" name="iptCriPse2" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor2" name="iptCriMonCor2" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel3" name="iptCriTVel3" placeholder="" value="5"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp3" name="iptCriTTemp3" placeholder="" value="3"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard3" name="iptCriFreCard3" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse3" name="iptCriPse3" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor3" name="iptCriMonCor3" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel4" name="iptCriTVel4" placeholder="" value="6"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp4" name="iptCriTTemp4" placeholder="" value="4"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard4" name="iptCriFreCard4" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse4" name="iptCriPse4" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor4" name="iptCriMonCor4" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel5" name="iptCriTVel5" placeholder="" value="6"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp5" name="iptCriTTemp5" placeholder="" value="5"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard5" name="iptCriFreCard5" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse5" name="iptCriPse5" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor5" name="iptCriMonCor5" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel6" name="iptCriTVel6" placeholder="" value="7"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp6" name="iptCriTTemp6" placeholder="" value="6"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard6" name="iptCriFreCard6" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse6" name="iptCriPse6" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor6" name="iptCriMonCor6" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel7" name="iptCriTVel7" placeholder="" value="7"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp7" name="iptCriTTemp7" placeholder="" value="7"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard7" name="iptCriFreCard7" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse7" name="iptCriPse7" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor7" name="iptCriMonCor7" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel8" name="iptCriTVel8" placeholder="" value="8"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp8" name="iptCriTTemp8" placeholder="" value="8"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard8" name="iptCriFreCard8" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse8" name="iptCriPse8" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor8" name="iptCriMonCor8" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel9" name="iptCriTVel9" placeholder="" value="8"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp9" name="iptCriTTemp9" placeholder="" value="9"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard9" name="iptCriFreCard9" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse9" name="iptCriPse9" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor9" name="iptCriMonCor9" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel10" name="iptCriTVel10" placeholder="" value="9"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp10" name="iptCriTTemp10" placeholder="" value="10"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard10" name="iptCriFreCard10" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse10" name="iptCriPse10" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor10" name="iptCriMonCor10" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel11" name="iptCriTVel11" placeholder="" value="9"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp11" name="iptCriTTemp11" placeholder="" value="11"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard11" name="iptCriFreCard11" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse11" name="iptCriPse11" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor11" name="iptCriMonCor11" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel12" name="iptCriTVel12" placeholder="" value="10"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp12" name="iptCriTTemp12" placeholder="" value="12"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard12" name="iptCriFreCard12" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse12" name="iptCriPse12" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor12" name="iptCriMonCor12" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel13" name="iptCriTVel13" placeholder="" value="10"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp13" name="iptCriTTemp13" placeholder="" value="13"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard13" name="iptCriFreCard13" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse13" name="iptCriPse13" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor13" name="iptCriMonCor13" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel14" name="iptCriTVel14" placeholder="" value="11"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp14" name="iptCriTTemp14" placeholder="" value="14"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard14" name="iptCriFreCard14" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse14" name="iptCriPse14" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor14" name="iptCriMonCor14" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel15" name="iptCriTVel15" placeholder="" value="11"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp15" name="iptCriTTemp15" placeholder="" value="15"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard15" name="iptCriFreCard15" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse15" name="iptCriPse15" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor15" name="iptCriMonCor15" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel16" name="iptCriTVel16" placeholder="" value="12"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp16" name="iptCriTTemp16" placeholder="" value="16"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard16" name="iptCriFreCard16" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse16" name="iptCriPse16" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor16" name="iptCriMonCor16" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel17" name="iptCriTVel17" placeholder="" value="12"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp17" name="iptCriTTemp17" placeholder="" value="17"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard17" name="iptCriFreCard17" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse17" name="iptCriPse17" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor17" name="iptCriMonCor17" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel18" name="iptCriTVel18" placeholder="" value="13"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp18" name="iptCriTTemp18" placeholder="" value="18"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard18" name="iptCriFreCard18" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse18" name="iptCriPse18" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor18" name="iptCriMonCor18" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel19" name="iptCriTVel19" placeholder="" value="13"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp19" name="iptCriTTemp19" placeholder="" value="19"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard19" name="iptCriFreCard19" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse19" name="iptCriPse19" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor19" name="iptCriMonCor19" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel20" name="iptCriTVel20" placeholder="" value="14"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp20" name="iptCriTTemp20" placeholder="" value="20"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard20" name="iptCriFreCard20" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse20" name="iptCriPse20" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor20" name="iptCriMonCor20" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTVel21" name="iptCriTVel21" placeholder="" value="14"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriTTemp21" name="iptCriTTemp21" placeholder="" value="21"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriFreCard21" name="iptCriFreCard21" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriPse21" name="iptCriPse21" placeholder="" value="0"></td>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriMonCor21" name="iptCriMonCor21" placeholder="" value="0"></td>
                                                                        </tr>
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
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriRec0" name="iptCriRec0" placeholder="" value="1 minuto"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriVel0" name="iptCriVel0" placeholder="" value="0"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpm0" name="iptCriBpm0" placeholder="" value="0"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriRec1" name="iptCriRec1" placeholder="" value="2 minutos"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriVel1" name="iptCriVel1" placeholder="" value="0"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpm1" name="iptCriBpm1" placeholder="" value="0"></td>
                                                                        </tr>                                                                
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
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriZT0" name="iptCriZT0" placeholder="" value="ZT 1"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriPorZT0" name="iptCriPorZT0" placeholder="" value="65"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpmZT0" name="iptCriBpmZT0" placeholder="" value="0"></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriZT1" name="iptCriZT1" placeholder="" value="ZT 2"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriPorZT1" name="iptCriPorZT1" placeholder="" value="75"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpmZT1" name="iptCriBpmZT1" placeholder="" value="0"></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriZT2" name="iptCriZT2" placeholder="" value="ZT 3"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriPorZT2" name="iptCriPorZT2" placeholder="" value="85"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpmZT2" name="iptCriBpmZT2" placeholder="" value="0"></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td><input type="text" class="form-control input-sm text-center" id="iptCriZT3" name="iptCriZT3" placeholder="" value="ZT 4"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriPorZT3" name="iptCriPorZT3" placeholder="" value="92"></td>
                                                                            <td><input type="number" class="form-control input-sm text-center" id="iptCriBpmZT3" name="iptCriBpmZT3" placeholder="" value="0"></td>
                                                                        </tr>                                                               
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
                    <button type="submit" class="btn btn-primary carregando">
                        Salvar avaliação
                    </button>
                </div>                
            </form>
            
        </div>
    </div>
    <!-- botão voltar --> 
    <div id="back" class="btn voltar-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </div>    
        
</div>