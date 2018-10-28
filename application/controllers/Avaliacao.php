<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao extends CI_Controller {

    /**
     * Base para controller.
     * @descripition 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Aluno_model", "aluno");
        $this->load->model("Avaliacao_model", "avaliacao");
        $this->load->model("Aerobica_model", "aerobica");
        $this->load->model("Aerobica_teste_model", "aerobicat");
        $this->load->model("Aerobica_recuperacao_model", "aerobicar");
        $this->load->model("Aerobica_zona_treinamento_model", "aerobicazt");
        $this->load->model("Antropometria_model", "antropometria");
        $this->load->model("Clinico_model", "clinico");
        $this->load->model("Fisioterapico_model", "fisioterapico");        
        $this->load->model("Bioimpedancia_model", "bioimpedancia");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "avaliacao"));      
        //Carrega index
        $this->load->view('avaliacao/avaliacao', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->recuperaUltimasAvaliações()));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    public function novo(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "avaliacao"));      
        //Carrega index
        $this->load->view('avaliacao/novo', array(
            "assetsUrl" => base_url("assets")));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => $msg));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('mensagens/mensagem', array(
            "assetsUrl" => base_url("assets"),
            "msg" => $msg,
            "uri" => $uri));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "avaliacao"));
        //Carrega
        $this->load->view('avaliacao/resultado', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $resultado,
            "palavra" => $texto,
            "contador" => count($resultado)));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    //Visualizar de avaliações por aluno
    public function visualiza($lista){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "avaliacao"));
        //Carrega
        $this->load->view('avaliacao/visualizar', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $lista, 
            "ultimo_lista" => count($lista)-1));
        //Modal
        $this->load->view("avaliacao/email-avaliacao", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    //Visualizar de avaliações por aluno
    public function edita($lista){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "avaliacao"));
        //Carrega
        $this->load->view('avaliacao/editar', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $lista));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "avaliacao.js"));
    }
    
    /*------------------Funções------------------*/ 
    //Buscar
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBuscar($texto);
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
            if (empty($texto)){
                //recupera o terceiro seguimento da url avaliacao/buscar/XXXXXX
                $texto = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("avaliacao/buscar/".urlencode($texto)));
            }
            //Bucar
            $resultado = $this->recuperaBusca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca de alunos ou cotas. Tente novamente.");
        }
    }
    
    //Cria
    function criar(){
        //variaveis
        //Dados Pessoas
        $nome; $cota; $idade; $data; $email; $sexo; $civil; 
        //Historico pessoal
        $tabagista; $etilista; $profissao; $postrabalho; $historicoatv;
        //Dados clinicos
        $lesao; $tracardiologico; $coluna; $varizes; $cirurgias; $hernia; $pulso; $pa; $medicamentos; $hisfamiliar; $outinformacoes;
        //Exame fisioterapico
        $posgeral; $colvertebral; $formuscular; $adm; $atvfisproposta; $objatvfisica; $execntindicados; $conduta;
        //Antropometria
        $pescoco; $ombro; $torax; $cintura; $abdomem; $quadril; $coxadir; $coxaesq; $pandir; $panesq; $bracodir; $bracoesq; $antebracodir; $antebracoesq;
        //Bioimpedancia
        $peso; $altura; $imc; $aguapor; $agual; $gorcorporal; $pesogordura; $gorduraalvo; $massamagrapor; $massamagrakg; $indicecop;
        //Capacidade aerobica
        $freqcarga; $freqrep; $freqrepcarga;
        //Tabela velocidade (arrays)
        $tvelocidade = array();
        //Tabela recuperacao (arrays)
        $trecuperacao = array();
        //Tabela zona treinamento (arrays)
        $tzt = array();
        
        try {
            //recupera dados post
            $this->recuperaCriarDadosPessoais($nome, $cota, $idade, $data, $email, $sexo, $civil);
            $this->recuperaCriarHistoricoPessoal($tabagista, $etilista, $profissao, $postrabalho, $historicoatv);
            $this->recuperaCriarDadosClinicos($lesao, $tracardiologico, $coluna, $varizes, $cirurgias, $hernia, $pulso, $pa, $medicamentos, $hisfamiliar, $outinformacoes);
            $this->recuperaCriarExameFisioterapico($posgeral, $colvertebral, $formuscular, $adm, $atvfisproposta, $objatvfisica, $execntindicados, $conduta);
            $this->recuperaCriarAntropometria($pescoco, $ombro, $torax, $cintura, $abdomem, $quadril, $coxadir, $coxaesq, $pandir, $panesq, $bracodir, $bracoesq, $antebracodir, $antebracoesq);
            $this->recuperaCriarBioimpedancia($peso, $altura, $imc, $aguapor, $agual, $gorcorporal, $pesogordura, $gorduraalvo, $massamagrapor, $massamagrakg, $indicecop);
            $this->recuperaCriarCapacidadeAerobica($freqcarga, $freqrep, $freqrepcarga);
            
            //verifica se ja existe o aluno no BD pelo nome
            if ($this->aluno->verificaNome($nome)){
                //busca aluno e salva nova avaliação
                //recupera id do aluno
                $idaluno = $this->aluno->buscaPorNome($nome)->getIdaluno();                
            } else{
                //salva novo aluno e nova avaliação
                //Adiciona aluno e recebe id aluno
                $idaluno = $this->insereRecuperaIdAluno($nome, $email, $idade, $sexo, $cota, $civil, $profissao, $postrabalho);              
            }
            //adiciona avaliaçao e recebe id avaliação
            $idavaliacao = $this->insereRecuperaIdAvaliacao($data, $tabagista, $etilista, $historicoatv, $idaluno);
            //Adiciona antropmetria, fisioterapico, clinico e bioimpedancia
            $this->antropometria->novo($pescoco, $ombro, $torax, $cintura, $abdomem, $quadril, $coxadir, $coxaesq, $pandir, $panesq, $bracodir, $bracoesq, $antebracodir, $antebracoesq, $idavaliacao);
            $this->antropometria->adiciona();
            $this->fisioterapico->novo($posgeral, $colvertebral, $formuscular, $adm, $atvfisproposta, $objatvfisica, $execntindicados, $conduta, $idavaliacao);
            $this->fisioterapico->adiciona();
            $this->clinico->novo($lesao, $coluna, $tracardiologico, $varizes, $cirurgias, $hernia, $pulso, $pa, $hisfamiliar, $medicamentos, $outinformacoes, $idavaliacao);
            $this->clinico->adiciona();
            $this->bioimpedancia->novo($peso, $altura, $imc, $aguapor, $agual, $gorcorporal, $pesogordura, $gorduraalvo, $massamagrapor, $massamagrakg, $indicecop, $idavaliacao);
            $this->bioimpedancia->adiciona();
            //Adiciona aerobico
            $this->aerobica->novo($freqcarga, $freqrep, $freqrepcarga, $idavaliacao);
            $idaerobica = $this->aerobica->adiciona();
            //Adiciona outras dependencias da aerobica
            $this->recuperaCriarTabelasAerobica($tvelocidade, $trecuperacao, $tzt, $idaerobica);  
            $this->insereDadosTabelasAerobicas($tvelocidade, $trecuperacao, $tzt);
            //log e msg
            $this->gravaLog("criação avaliacao", "avaliação criada: ".$idavaliacao." aluno: ". $idaluno);
            $this->mensagem("Avaliação criada com sucesso. </br><strong>".$nome."</strong>", "avaliacao");           
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de patrimonio. Tentar novamente.");
        }
    }
    
    //Atualizar
    function atualizar(){
        //variaveis
        $idavaliacao;
        //Dados Pessoas
        $nome; $cota; $idade; $data; $email; $sexo; $civil; 
        //Historico pessoal
        $tabagista; $etilista; $profissao; $postrabalho; $historicoatv;
        //Dados clinicos
        $lesao; $tracardiologico; $coluna; $varizes; $cirurgias; $hernia; $pulso; $pa; $medicamentos; $hisfamiliar; $outinformacoes;
        //Exame fisioterapico
        $posgeral; $colvertebral; $formuscular; $adm; $atvfisproposta; $objatvfisica; $execntindicados; $conduta;
        //Antropometria
        $pescoco; $ombro; $torax; $cintura; $abdomem; $quadril; $coxadir; $coxaesq; $pandir; $panesq; $bracodir; $bracoesq; $antebracodir; $antebracoesq;
        //Bioimpedancia
        $peso; $altura; $imc; $aguapor; $agual; $gorcorporal; $pesogordura; $gorduraalvo; $massamagrapor; $massamagrakg; $indicecop;
        //Capacidade aerobica
        $freqcarga; $freqrep; $freqrepcarga;
        //Tabela velocidade (arrays)
        $tvelocidade = array();
        //Tabela recuperacao (arrays)
        $trecuperacao = array();
        //Tabela zona treinamento (arrays)
        $tzt = array();
        try {
            //recupera dados post
            $this->recuperaEditarDadosPessoais($nome, $cota, $idade, $data, $email, $sexo, $civil, $idavaliacao);
            $this->recuperaEditarHistoricoPessoal($tabagista, $etilista, $profissao, $postrabalho, $historicoatv);
            $this->recuperaEditarDadosClinicos($lesao, $tracardiologico, $coluna, $varizes, $cirurgias, $hernia, $pulso, $pa, $medicamentos, $hisfamiliar, $outinformacoes);
            $this->recuperaEditarExameFisioterapico($posgeral, $colvertebral, $formuscular, $adm, $atvfisproposta, $objatvfisica, $execntindicados, $conduta);
            $this->recuperaEditarAntropometria($pescoco, $ombro, $torax, $cintura, $abdomem, $quadril, $coxadir, $coxaesq, $pandir, $panesq, $bracodir, $bracoesq, $antebracodir, $antebracoesq);
            $this->recuperaEditarBioimpedancia($peso, $altura, $imc, $aguapor, $agual, $gorcorporal, $pesogordura, $gorduraalvo, $massamagrapor, $massamagrakg, $indicecop);
            $this->recuperaEditarCapacidadeAerobica($freqcarga, $freqrep, $freqrepcarga);
            
            //verifica se existe avaliação
            if ($this->avaliacao->existeAvaliacao($idavaliacao)){
                //verifica se existe aluno ou foi trocado
                if (!$this->aluno->existeNomeAlunoId($nome, $this->avaliacao->buscaPorId($idavaliacao)->getIdaluno())){
                    //atualiza dados                    
                    $this->aluno->atualiza($this->avaliacao->buscaPorId($idavaliacao)->getIdaluno(), $nome, $email, $idade, $sexo, $cota, $civil, $profissao, $postrabalho);
                    $this->avaliacao->atualiza($idavaliacao, $data, $tabagista, $etilista, $historicoatv);
                    $this->antropometria->atualiza($pescoco, $ombro, $torax, $cintura, $abdomem, $quadril, $coxadir, $coxaesq, $pandir, $panesq, $bracodir, $bracoesq, $antebracodir, $antebracoesq, $idavaliacao);
                    $this->fisioterapico->atualiza($posgeral, $colvertebral, $formuscular, $adm, $atvfisproposta, $objatvfisica, $execntindicados, $conduta, $idavaliacao);
                    $this->clinico->atualiza($lesao, $coluna, $tracardiologico, $varizes, $cirurgias, $hernia, $pulso, $pa, $hisfamiliar, $medicamentos, $outinformacoes, $idavaliacao);
                    $this->bioimpedancia->atualiza($peso, $altura, $imc, $aguapor, $agual, $gorcorporal, $pesogordura, $gorduraalvo, $massamagrapor, $massamagrakg, $indicecop, $idavaliacao);
                    $this->aerobica->atualiza($freqcarga, $freqrep, $freqrepcarga, $idavaliacao);
                    //pega id aerobica
                    $idaerobica = $this->aerobica->BuscarPorIdavaliacao($idavaliacao)->getIdaerobica();
                    $this->recuperaEditarTabelasAerobica($tvelocidade, $trecuperacao, $tzt, $idaerobica);
                    $this->atualizaDadosTabelasAerobicas($tvelocidade, $trecuperacao, $tzt);
                    //log e msg
                    $this->gravaLog("atualização avaliacao", "avaliação criada: ".$idavaliacao." aluno: ".$this->avaliacao->buscaPorId($idavaliacao)->getIdaluno());
                    $this->mensagem("Avaliação atualizada com sucesso. </br><strong>".$nome."</strong>", "avaliacao");
                } else{
                    //não atualiza dados, aluno ja existe no sistema
                    $this->gravaLog("erro atualização avaliacao", "tentativa de atualizar nome/cota aluno repetido: ".$nome." cota: ". $cota);
                    $this->erro("Erro na atualização da avaliação </br><strong>Nome ou cota já exite no sistema.</strong>");
                }                
            } else {
                //Não existe a avaliação
                $this->gravaLog("erro atualização avaliacao", "tentativa de atualar a avaliação que não existe. ID: ".$idavaliacao);
                $this->erro("Erro na atualização da avaliação </br><strong>Avaliação não existe.</strong>");
            }
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de patrimonio. Tentar novamente.");
        }
    }
    
    //Visualizar todas avaliações de um aluno
    public function visualizar(){
        try {
            $idaluno = urldecode(trim($this->uri->segment(3)));
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
            if (!empty($idaluno)){
                //recupera o terceiro seguimento da url avaliacao/edita/XXXXXX
                $idaluno = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("avaliacao/visualizar/".urlencode($idaluno)));
            }
            //Bucar
            $lista = $this->recuperaVisualizar($idaluno);
            //verifica se existe dados
            if (!empty($lista)){
                $this->visualiza($lista);
            } else{
                $this->erro("Aluno não existe. Tente novamente.");
            }
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca de alunos ou cotas. Tente novamente.");
        }
    }
    
    //Editar avaliação especifica
    public function editar(){
        try {
            $idavaliacao = urldecode(trim($this->uri->segment(3)));
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3
            if (!empty($idavaliacao)){
                //recupera o terceiro seguimento da url avaliacao/editar/XXXXXX
                $idavaliacao = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("avaliacao/editar/".urlencode($idavaliacao)));
            }
            //Bucar
            $lista = $this->recuperaEditar($idavaliacao);
            //verifica se existe dados
            if (!empty($lista)){
                $this->edita($lista);
            } else{
                $this->erro("Avaliação não existe. Tente novamente.");
            }            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao editar a avaliação, tente novamente.");
        }
    }
    
    //Enviar email
    public function enviarEmail(){
        //recupera dados
        $id; $data; $para; $copia; $assunto; $texto; $url;
        
        try {
            //recupera dados do post
            $this->recuperaEnviarEmail($id, $data, $para, $copia, $assunto, $texto, $url);
            //verificar se id avaliacao
            if ($this->avaliacao->existeAvaliacao($id)){
                //anexo criar pdf
                $this->gerarPdf($id);
                //teste
                //$this->geraPaginasAvaliacao($id);
                //busca aquivo pdf para colocar como anexo
                $anexo = $this->anexo($id);
                if ($this->envioEmail($para, $data, $copia, $assunto, $texto, $anexo)){
                    $this->gravaLog("enviar email avaliacao", "avaliacao id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->mensagem("E-mail enviado com <strong>sucesso</strong>!", $url);
                }else {
                    $this->gravaLog("erro enviar email avaliacao", "relatorio id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->erro("Erro ao enviar e-mail, <strong>tente novamente</strong>.");
                }
            }else{
                //erro, não existe plantão
                $this->gravaLog("erro enviar email avaliacao", "a avaliação não existe. id: ".$id);
                $this->erro("Não existe a avaliação de número: <strong>".$id.".</strong>. <br>Tente novamente.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro para enviar e-mail. Favor tentar novamente.");
        }
    } 
    
    //PDF
    public function pdf(){
        //recupera dados
        $idavaliacao;
        
        try {
            $idavaliacao = urldecode(trim($this->uri->segment(3)));
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3
            if (!empty($idavaliacao)){
                //recupera o terceiro seguimento da url avaliacao/pdf/XXXXXX
                $idavaliacao = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("avaliacao/pdf/".urlencode($idavaliacao)));
            }
            //verificar se id avaliacao
            if ($this->avaliacao->existeAvaliacao($idavaliacao)){
                //anexo criar pdf
                $this->gerarPdf($idavaliacao);                
                //visualizar pdf
                redirect(base_url('document/avaliacao/'.$idavaliacao.'.pdf'));
            }else{
                //erro, não existe plantão
                $this->gravaLog("erro gerar pdf avaliacao", "a avaliação não existe. id: ".$idavaliacao);
                $this->erro("Não existe a avaliação de número: <strong>".$idavaliacao.".</strong>. <br>Tente novamente.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao gerar o PDF da avaliação. Favor tentar novamente.");
        }
    } 


    /*----------------Funções AJAX---------------*/
    //Verifica se existe o nome do aluno cadastrado
    public function verificaNomeAluno(){
        $nome = trim($this->input->get_post("nome"));
        //verifica se existe
        if ($this->aluno->existeNomeAluno($nome)){
            $msg = array(
                "nome" => "Aluno <strong>".$nome."</strong> já possui avaliação no sistema."
            );
            echo json_encode($msg); //não exite
        }else {
            $msg = array(
                "erro" => "O aluno <strong>".$nome."</strong> não possui avaliações cadastradas no sistema."
            );
            echo json_encode($msg); //existe
        }
        exit();
    }    
    
    //Buscar todos alunos AJAX
    public function buscarAluno(){
        //Recupera letras
        $termo = $this->input->get("termo");
        $alunos = $this->aluno->buscaAlunoTermo($termo);
        //Gera json
        foreach ($alunos as $aluno){
            $resultado[] = $aluno->getNome();
        }
        //$teste = json_encode($resultado);
        echo json_encode($resultado);
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Verifica se existe o nome do aluno cadastrado
    public function verificaCota(){
        $cota = trim($this->input->get_post("iptCriCota"));
        //verifica se existe
        if (!$this->aluno->existeCota($cota)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
        exit();
    }
    
    //Enviar email AJAX
    public function enviarEmailAvaliacao(){
        //Recupera Id manutencao
        $id = trim($this->input->post("id"));
                
        if ($this->avaliacao->existeAvaliacao($id)){
            $msg = array(
                "idavaliacao" => $id,
                "data" => date("d/m/Y", strtotime($this->avaliacao->buscaPorId($id)->getData())),
                "usuario" => $this->aluno->buscaPorId($this->avaliacao->buscaPorId($id)->getIdaluno())->getNome(),
                "para" => $this->aluno->buscaPorId($this->avaliacao->buscaPorId($id)->getIdaluno())->getEmail(),
                "copia" => "",
                "assunto" => "Avaliação funcional ".$this->aluno->buscaPorId($this->avaliacao->buscaPorId($id)->getIdaluno())->getNome(),
                "corpo" => "Prezado ".$this->aluno->buscaPorId($this->avaliacao->buscaPorId($id)->getIdaluno())->getNome().", boa dia! \n\nSegue em anexo a sua avaliação funcional. \n\nAtt. \n".$this->session->userdata("nome").".\n"
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Avaliação não encontrada. (".$id.")."
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    public function buscarDadosAluno(){
        //Recupera nome do aluno
        $nome = trim($this->input->get("nome"));
                
        if ($this->aluno->verificaPorNome($nome)){
            //recupera aluno
            $aluno = $this->aluno->buscaPorNome($nome);
            //busca ultima avalição do aluno
            $avaliacao = $this->avaliacao->buscaUltimaAvaliacaoAluno($aluno->getIdaluno());
            $clinico = $this->clinico->BuscarPorIdavaliacao($avaliacao->getIdavaliacao());
            $bioimpedancia = $this->bioimpedancia->BuscarPorIdavaliacao($avaliacao->getIdavaliacao());
            $antropometria = $this->antropometria->BuscarPorIdavaliacao($avaliacao->getIdavaliacao());
            $fisioterapico = $this->fisioterapico->BuscarPorIdavaliacao($avaliacao->getIdavaliacao());
            $aerobica = $this->aerobica->BuscarPorIdavaliacao($avaliacao->getIdavaliacao());
            $aerobicat = $this->aerobicat->BuscarPorIdaerobica($aerobica->getIdaerobica());
            $aerobicar = $this->aerobicar->BuscarPorIdaerobica($aerobica->getIdaerobica());
            $aerobicazt = $this->aerobicazt->BuscarPorIdaerobica($aerobica->getIdaerobica());            
            
            $msg = $this->gerarDadosAluno($aluno, $avaliacao, $clinico, $bioimpedancia, $antropometria, $fisioterapico, $aerobica, $aerobicat, $aerobicar, $aerobicazt);
            
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "O aluno <strong>".$nome."</strong> não possui avaliações anteriores."
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Salvar imagem no servidor
    public function salvaGrafico(){
        //Recupera Id manutencao
        $grafico = trim($this->input->post("grafico"));
        $id = trim($this->input->post("id"));
        
        $dir = "./document/avaliacao/chart/";
        if (isset($id)){
            $nome = $id.".png";
        } else {
            $nome = "errochart.png";
        }        
        //remove informações do arquivo deixando somente a imagem
        $dados = explode(",", $grafico);
        if(count($dados) == 2){
            //decodifica para base64
            $file = base64_decode($dados[1]);
            //Verifica se existe o arquivo e apaga caso existir
            if(file_exists($dir.$nome)){
                unlink($dir.$nome);
            }
            //salvando arquivo
            if (!file_put_contents($dir.$nome, $file)){
                $msg = array(
                    "erro" => "Não foi possivel gerar imagem do grafico"
                );
            } else{
                $msg = array(
                "arquivo" => $grafico,
                "id" =>$id
                );
            }
        }
        
        echo json_encode($msg);
        
        exit();
        
    }




    /*------------Funções internas---------------*/ 
    
    //Grava log no BD
    private function gravaLog($nome, $descricao){
        //dados
        $data = date('Y-m-d H:i:s');
        $ip =  $this->input->ip_address();
        if ($this->session->has_userdata("nome")){
            $idusuario = $this->session->userdata("id");
        } else {
            $idusuario = 0;
        }
        //carrega model
        $this->load->model("Log_model", "registro");
        $this->registro->newLog($nome, $descricao, $data, $ip, $idusuario);
        $this->registro->addLog();
    }
    
    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getAvaliacao() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("acesso negado", "acesso ao controlador Avaliacao.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Avaliacao.php");
            redirect(base_url());
        }
    }
    
    //insere e recupera id aluno novo
    private function insereRecuperaIdAluno($nome, $email, $idade, $sexo, $cota, $civil, $profissao, $postrabalho){
        //aluno novo($nome, $email, $idade, $sexo, $cota, $estado_civil, $profissao, $posicao_trabalho){
        $this->aluno->novo($nome, $email, $idade, $sexo, $cota, $civil, $profissao, $postrabalho);
        $this->aluno->adiciona();
        $aluno = $this->aluno->buscaPorNome($nome);
        
        if(isset($aluno)){
            return $aluno->getIdaluno();
        } else {
            $this->erro("Erro ao cadastrar o aluno <strong>".$nome."</strong>.</br>Favor avisar o TI.");
        }
    }
    
    //insere e recupera id avalição novo
    private function insereRecuperaIdAvaliacao($data, $tabagista, $etilista, $atividade_fisica, $idaluno){
        //aluno novo($nome, $email, $idade, $sexo, $cota, $estado_civil, $profissao, $posicao_trabalho){
        $this->avaliacao->novo($data, $tabagista, $etilista, $atividade_fisica, $idaluno);
        $id = $this->avaliacao->adiciona();
        
        return $id;
    }
    
    //insere dados tabelas aerobicas CRIAR
    private function insereDadosTabelasAerobicas(&$tvelocidade, &$trecuperacao, &$tzt){
        foreach ($tvelocidade as $key => $value) {
            $this->aerobicat->novo($value["velocidade"], $value["tempo"], $value["freq_cardiaca"], $value["pse"], $value["momento_corrida"], $value["idaerobica"]);
            $this->aerobicat->adiciona();
        }
        
        foreach ($trecuperacao as $key => $value) {
            $this->aerobicar->novo($value["recuperacao"], $value["velocidade"], $value["bpm"], $value["idaerobica"]);
            $this->aerobicar->adiciona();
        }
        
        
        foreach ($tzt as $key => $value) {
            $this->aerobicazt->novo($value["zona_treinamento"], $value["porcentagem"], $value["bpm"], $value["idaerobica"]);
            $this->aerobicazt->adiciona();
        }
    }
    
    //insere dados tabelas aerobicas EDITAR (ATUALIZAR)
    private function atualizaDadosTabelasAerobicas(&$tvelocidade, &$trecuperacao, &$tzt){
        foreach ($tvelocidade as $key => $value) {
            //atualiza($id, $velocidade, $tempo, $freq_cardiaca, $pse, $momento_corrida, $idaerobica)
            $this->aerobicat->atualiza($value["idaerobica_teste"], $value["velocidade"], $value["tempo"], $value["freq_cardiaca"], $value["pse"], $value["momento_corrida"], $value["idaerobica"]);
        }
        
        foreach ($trecuperacao as $key => $value) {
            //atualiza($id, $recuperacao, $velocidade, $bpm, $idaerobica)
            $this->aerobicar->atualiza($value["idaerobica_recuperacao"], $value["recuperacao"], $value["velocidade"], $value["bpm"], $value["idaerobica"]);
        }        
        
        foreach ($tzt as $key => $value) {
            //atualiza($id, $zona_treinamento, $porcentagem, $bpm, $idaerobica)
            $this->aerobicazt->atualiza($value["idaerobica_zona_treinamento"], $value["zona_treinamento"], $value["porcentagem"], $value["bpm"], $value["idaerobica"]);
        }
    }

    //recupera dados post CRIAR DADOS PESSOAIS
    private function recuperaCriarDadosPessoais(&$nome, &$cota, &$idade, &$data, &$email, &$sexo, &$civil){
        $nome = trim($this->input->post("iptCriNomeAluno"));
        $cota = trim($this->input->post("iptCriCota"));
        $idade = trim($this->input->post("iptCriIdade"));
        $data = trim($this->input->post("iptCriData"));
        $email = trim($this->input->post("iptCriEmailAluno"));
        $sexo = trim($this->input->post("iptCriSexo"));
        $civil = trim($this->input->post("iptCriCivil"));
    }
    
    //recupera dados post CRIAR HISTORICO PESSOAL
    private function recuperaCriarHistoricoPessoal(&$tabagista, &$etilista, &$profissao, &$postrabalho, &$historicoatv){
        $tabagista = trim($this->input->post("iptCriTanagista"));
        $etilista = trim($this->input->post("iptCriEtilista"));
        $profissao = trim($this->input->post("iptCriProfissao"));
        $postrabalho = trim($this->input->post("iptCriPosicao"));
        $historicoatv = trim($this->input->post("iptCriAtividade"));
    }
    
    //recupera dados post CRIAR DADOS CLINICOS
    private function recuperaCriarDadosClinicos(&$lesao, &$tracardiologico, &$coluna, &$varizes, &$cirurgias, &$hernia, 
            &$pulso, &$pa, &$medicamentos, &$hisfamiliar, &$outinformacoes){
        $lesao = trim($this->input->post("iptCriLeArt"));
        $tracardiologico = trim($this->input->post("iptCriTraCar"));
        $coluna = trim($this->input->post("iptCriColuna"));
        $varizes = trim($this->input->post("iptCriVarizes"));
        $cirurgias = trim($this->input->post("iptCriCirurgias"));
        $hernia = trim($this->input->post("iptCriHernia"));
        $pulso = trim($this->input->post("iptCriPulso"));
        $pa = trim($this->input->post("iptCriPa"));
        $medicamentos = trim($this->input->post("iptCriMedicamentos"));
        $hisfamiliar = trim($this->input->post("iptCriHisFam"));
        $outinformacoes = trim($this->input->post("iptCriOutInf"));
    }
    
    //recupera dados post CRIAR EXAME FIFIOTERAPICO
    private function recuperaCriarExameFisioterapico(&$posgeral, &$colvertebral, &$formuscular, &$adm, 
            &$atvfisproposta, &$objatvfisica, &$execntindicados, &$conduta){
        $posgeral = trim($this->input->post("iptCriPostura"));
        $colvertebral = trim($this->input->post("iptCriColVer"));
        $formuscular = trim($this->input->post("iptCriForca"));
        //$repeticao = trim($this->input->post("iptCriRepeticoes"));
        $adm = trim($this->input->post("iptCriAdm"));
        $atvfisproposta = trim($this->input->post("iptCriAtFiPro"));
        $objatvfisica = trim($this->input->post("iptCriObjAtFi"));
        $execntindicados = trim($this->input->post("iptCriExConInd"));
        $conduta = trim($this->input->post("iptCriConduta"));
    }
    
    //recupera dados post CRIAR ANTROPOMETRIA
    private function recuperaCriarAntropometria(&$pescoco, &$ombro, &$torax, &$cintura, &$abdomem, &$quadril, &$coxadir, 
            &$coxaesq, &$pandir, &$panesq, &$bracodir, &$bracoesq, &$antebracodir, &$antebracoesq){
        $pescoco = trim($this->input->post("iptCriPescoco"));
        $ombro = trim($this->input->post("iptCriOmbros"));
        $torax = trim($this->input->post("iptCriTorax"));
        $cintura = trim($this->input->post("iptCriCintura"));
        $abdomem = trim($this->input->post("iptCriAbdomem"));
        $quadril = trim($this->input->post("iptCriQuadril"));
        $coxadir = trim($this->input->post("iptCriCoxaDir"));
        $coxaesq = trim($this->input->post("iptCriCoxaEsq"));
        $pandir = trim($this->input->post("iptCriPanDir"));
        $panesq = trim($this->input->post("iptCriPanEsq"));
        $bracodir = trim($this->input->post("iptCriBraDir"));
        $bracoesq = trim($this->input->post("iptCriBraEsq"));
        $antebracodir = trim($this->input->post("iptCriAntBraDir"));
        $antebracoesq = trim($this->input->post("iptCriAntBraEsq"));
    }
    
    //recupera dados post CRIAR BIOIMPEDANCIA
    private function recuperaCriarBioimpedancia(&$peso, &$altura, &$imc, &$aguapor, &$agual, &$gorcorporal, &$pesogordura, 
            &$gorduraalvo, &$massamagrapor, &$massamagrakg, &$indicecop){
        $peso = trim($this->input->post("iptCriPeso"));
        $altura = trim($this->input->post("iptCriAltura"));
        $imc = trim($this->input->post("iptCriImc"));
        $aguapor = trim($this->input->post("iptCriPorAgua"));
        $agual = trim($this->input->post("iptCriAgua"));
        $gorcorporal = trim($this->input->post("iptCriGorCor"));
        $pesogordura = trim($this->input->post("iptCriPesGor"));
        $gorduraalvo = trim($this->input->post("iptCriPorGorAlv"));
        $massamagrapor = trim($this->input->post("iptCriPorMasMag"));
        $massamagrakg = trim($this->input->post("iptCriMasMag"));
        $indicecop = trim($this->input->post("iptCriIndCorporal"));
    }
    
    //recupera dados post CRIAR HISTORICO PESSOAL
    private function recuperaCriarTabelasAerobica(&$tvelocidade, &$trecuperacao, &$tzt, &$idaerobica){
        //Tabela  valocidade
        $tv = 21;
        for ($i = 0; $i < $tv; $i++){
            $tvelocidade[$i] = array(
                "velocidade" => trim($this->input->post("iptCriTVel".$i)),
                "tempo" => trim($this->input->post("iptCriTTemp".$i)),
                "freq_cardiaca" => trim($this->input->post("iptCriFreCard".$i)),
                "pse" => trim($this->input->post("iptCriPse".$i)),
                "momento_corrida" => trim($this->input->post("iptCriMonCor".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
        //Tabela  recuperaçao
        $tr = 2;
        for ($i = 0; $i < $tr; $i++){
            $trecuperacao[$i] = array(
                "recuperacao" => trim($this->input->post("iptCriRec".$i)),
                "velocidade" => trim($this->input->post("iptCriVel".$i)),
                "bpm" => trim($this->input->post("iptCriBpm".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
        //Tabela  zona treinamento
        $tz = 4;
        for ($i = 0; $i < $tz; $i++){
            $tzt[$i] = array(
                "zona_treinamento" => trim($this->input->post("iptCriZT".$i)),
                "porcentagem" => trim($this->input->post("iptCriPorZT".$i)),
                "bpm" => trim($this->input->post("iptCriBpmZT".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
    }
    
    //recupera dados post CRIAR CAPACIDADE AEROBICA
    private function recuperaCriarCapacidadeAerobica(&$freqcarga, &$freqrep, &$freqrepcarga){
        $freqcarga = trim($this->input->post("iptCriFreCarMax"));
        $freqrep = trim($this->input->post("iptCriFreRep"));
        $freqrepcarga = trim($this->input->post("iptCriFreRepCarMax"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) DADOS PESSOAIS
    private function recuperaEditarDadosPessoais(&$nome, &$cota, &$idade, &$data, &$email, &$sexo, &$civil, &$idavaliacao){
        $nome = trim($this->input->post("iptEdtNomeAluno"));
        $cota = trim($this->input->post("iptEdtCota"));
        $idade = trim($this->input->post("iptEdtIdade"));
        $data = trim($this->input->post("iptEdtData"));
        $email = trim($this->input->post("iptEdtEmailAluno"));
        $sexo = trim($this->input->post("iptEdtSexo"));
        $civil = trim($this->input->post("iptEdtCivil"));
        $idavaliacao = trim($this->input->post("iptEdtIdAvaliacao"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) HISTORICO PESSOAL
    private function recuperaEditarHistoricoPessoal(&$tabagista, &$etilista, &$profissao, &$postrabalho, &$historicoatv){
        $tabagista = trim($this->input->post("iptEdtTanagista"));
        $etilista = trim($this->input->post("iptEdtEtilista"));
        $profissao = trim($this->input->post("iptEdtProfissao"));
        $postrabalho = trim($this->input->post("iptEdtPosicao"));
        $historicoatv = trim($this->input->post("iptEdtAtividade"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) DADOS CLINICOS
    private function recuperaEditarDadosClinicos(&$lesao, &$tracardiologico, &$coluna, &$varizes, &$cirurgias, &$hernia, 
            &$pulso, &$pa, &$medicamentos, &$hisfamiliar, &$outinformacoes){
        $lesao = trim($this->input->post("iptEdtLeArt"));
        $tracardiologico = trim($this->input->post("iptEdtTraCar"));
        $coluna = trim($this->input->post("iptEdtColuna"));
        $varizes = trim($this->input->post("iptEdtVarizes"));
        $cirurgias = trim($this->input->post("iptEdtCirurgias"));
        $hernia = trim($this->input->post("iptEdtHernia"));
        $pulso = trim($this->input->post("iptEdtPulso"));
        $pa = trim($this->input->post("iptEdtPa"));
        $medicamentos = trim($this->input->post("iptEdtMedicamentos"));
        $hisfamiliar = trim($this->input->post("iptEdtHisFam"));
        $outinformacoes = trim($this->input->post("iptEdtOutInf"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) EXAME FIFIOTERAPICO
    private function recuperaEditarExameFisioterapico(&$posgeral, &$colvertebral, &$formuscular, &$adm, 
            &$atvfisproposta, &$objatvfisica, &$execntindicados, &$conduta){
        $posgeral = trim($this->input->post("iptEdtPostura"));
        $colvertebral = trim($this->input->post("iptEdtColVer"));
        $formuscular = trim($this->input->post("iptEdtForca"));
        //$repeticao = trim($this->input->post("iptEdtRepeticoes"));
        $adm = trim($this->input->post("iptEdtAdm"));
        $atvfisproposta = trim($this->input->post("iptEdtAtFiPro"));
        $objatvfisica = trim($this->input->post("iptEdtObjAtFi"));
        $execntindicados = trim($this->input->post("iptEdtExConInd"));
        $conduta = trim($this->input->post("iptEdtConduta"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) ANTROPOMETRIA
    private function recuperaEditarAntropometria(&$pescoco, &$ombro, &$torax, &$cintura, &$abdomem, &$quadril, &$coxadir, 
            &$coxaesq, &$pandir, &$panesq, &$bracodir, &$bracoesq, &$antebracodir, &$antebracoesq){
        $pescoco = trim($this->input->post("iptEdtPescoco"));
        $ombro = trim($this->input->post("iptEdtOmbros"));
        $torax = trim($this->input->post("iptEdtTorax"));
        $cintura = trim($this->input->post("iptEdtCintura"));
        $abdomem = trim($this->input->post("iptEdtAbdomem"));
        $quadril = trim($this->input->post("iptEdtQuadril"));
        $coxadir = trim($this->input->post("iptEdtCoxaDir"));
        $coxaesq = trim($this->input->post("iptEdtCoxaEsq"));
        $pandir = trim($this->input->post("iptEdtPanDir"));
        $panesq = trim($this->input->post("iptEdtPanEsq"));
        $bracodir = trim($this->input->post("iptEdtBraDir"));
        $bracoesq = trim($this->input->post("iptEdtBraEsq"));
        $antebracodir = trim($this->input->post("iptEdtAntBraDir"));
        $antebracoesq = trim($this->input->post("iptEdtAntBraEsq"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) BIOIMPEDANCIA
    private function recuperaEditarBioimpedancia(&$peso, &$altura, &$imc, &$aguapor, &$agual, &$gorcorporal, &$pesogordura, 
            &$gorduraalvo, &$massamagrapor, &$massamagrakg, &$indicecop){
        $peso = trim($this->input->post("iptEdtPeso"));
        $altura = trim($this->input->post("iptEdtAltura"));
        $imc = trim($this->input->post("iptEdtImc"));
        $aguapor = trim($this->input->post("iptEdtPorAgua"));
        $agual = trim($this->input->post("iptEdtAgua"));
        $gorcorporal = trim($this->input->post("iptEdtGorCor"));
        $pesogordura = trim($this->input->post("iptEdtPesGor"));
        $gorduraalvo = trim($this->input->post("iptEdtPorGorAlv"));
        $massamagrapor = trim($this->input->post("iptEdtPorMasMag"));
        $massamagrakg = trim($this->input->post("iptEdtMasMag"));
        $indicecop = trim($this->input->post("iptEdtIndCorporal"));
    }
    
    //recupera dados post ATUALIZAR (EDITAR) HISTORICO PESSOAL
    private function recuperaEditarTabelasAerobica(&$tvelocidade, &$trecuperacao, &$tzt, &$idaerobica){
        //Tabela  valocidade
        $tv = 21;
        for ($i = 0; $i < $tv; $i++){
            $tvelocidade[$i] = array(
                "idaerobica_teste" => trim($this->input->post("iptEdtTId".$i)),
                "velocidade" => trim($this->input->post("iptEdtTVel".$i)),
                "tempo" => trim($this->input->post("iptEdtTTemp".$i)),
                "freq_cardiaca" => trim($this->input->post("iptEdtFreCard".$i)),
                "pse" => trim($this->input->post("iptEdtPse".$i)),
                "momento_corrida" => trim($this->input->post("iptEdtMonCor".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
        //Tabela  recuperaçao
        $tr = 2;
        for ($i = 0; $i < $tr; $i++){
            $trecuperacao[$i] = array(
                "idaerobica_recuperacao" => trim($this->input->post("iptEdtRId".$i)),
                "recuperacao" => trim($this->input->post("iptEdtRec".$i)),
                "velocidade" => trim($this->input->post("iptEdtVel".$i)),
                "bpm" => trim($this->input->post("iptEdtBpm".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
        //Tabela  zona treinamento
        $tz = 4;
        for ($i = 0; $i < $tz; $i++){
            $tzt[$i] = array(
                "idaerobica_zona_treinamento" => trim($this->input->post("iptEdtZTId".$i)),
                "zona_treinamento" => trim($this->input->post("iptEdtZT".$i)),
                "porcentagem" => trim($this->input->post("iptEdtPorZT".$i)),
                "bpm" => trim($this->input->post("iptEdtBpmZT".$i)),
                "idaerobica" => $idaerobica
            ); 
        }
    }
    
    //recupera dados post ATUALIZAR (EDITAR) CAPACIDADE AEROBICA
    private function recuperaEditarCapacidadeAerobica(&$freqcarga, &$freqrep, &$freqrepcarga){
        $freqcarga = trim($this->input->post("iptEdtFreCarMax"));
        $freqrep = trim($this->input->post("iptEdtFreRep"));
        $freqrepcarga = trim($this->input->post("iptEdtFreRepCarMax"));
    }
        
    //recupera as 10 ultimas avaliações para o index
    private function recuperaUltimasAvaliações(){
        //Pega o id e data da tabela avalicao e o objeto aluno
        $dados = array();
        $avaliacao = $this->avaliacao->buscaUltimos(6,0);
        foreach ($avaliacao as $key => $value) {
            array_push($dados, array(
                "avaliacao" => $value,
                "aluno" => $this->aluno->buscaPorId($value->getIdaluno())
            ));
        }        
        return $dados;
    }
    
    //recupera dados post BUSCAR
    private function recuperaBuscar(&$texto){
        $texto = trim($this->input->post("iptBusca"));
    }
    
    //recupera busca de alunos ou cotas
    private function recuperaBusca($texto){
        //Pega o id e data da tabela avalicao e o objeto aluno
        $dados = array();
        $alunos = $this->aluno->busca($texto);
        foreach ($alunos as $key => $value) {
            array_push($dados, array(
                "aluno" => $value,
                "avaliacao" => $this->avaliacao->buscaUltimaAvaliacaoAluno($value->getIdaluno())
            ));
        }        
        return $dados;
    }
    
    //recupera todas as avaliações de um determinado aluno
    private function recuperaVisualizar($idaluno){
        //Pega o id e data da tabela avalicao e o objeto aluno
        $dados = array();
        //Verifica se existe aluno
        if ($this->aluno->existeId($idaluno)){
            $lista = $this->avaliacao->buscaTodasPorAluno($idaluno);
            foreach ($lista as $key => $value) {
                array_push($dados, array(
                    "aluno" => $this->aluno->buscaPorId($idaluno),
                    "avaliacao" => $value,
                    "clinico" => $this->clinico->BuscarPorIdavaliacao($value->getIdavaliacao()),
                    "bioimpedancia" => $this->bioimpedancia->BuscarPorIdavaliacao($value->getIdavaliacao()),
                    "antropometria" => $this->antropometria->BuscarPorIdavaliacao($value->getIdavaliacao()),
                    "fisioterapico" => $this->fisioterapico->BuscarPorIdavaliacao($value->getIdavaliacao()),
                    "aerobica" => $this->aerobica->BuscarPorIdavaliacao($value->getIdavaliacao()),
                    "aerobica_teste" => $this->aerobicat->BuscarPorIdaerobica($this->retornaIdAerobica($value->getIdavaliacao())),
                    "aerobica_recuperacao" => $this->aerobicar->BuscarPorIdaerobica($this->retornaIdAerobica($value->getIdavaliacao())),
                    "aerobica_zona_treinamento" => $this->aerobicazt->BuscarPorIdaerobica($this->retornaIdAerobica($value->getIdavaliacao()))
                ));
            }  
        }
               
        return $dados;
    }
    
    //recupera uma avaliação por id para edição
    private function recuperaEditar($idavaliacao){        
        $dados = array();
        //Verifica se existe aluno
        if ($this->avaliacao->existeAvaliacao($idavaliacao)){
            $avaliacao = $this->avaliacao->buscaPorId($idavaliacao);
            $dados = array(
                "aluno" => $this->aluno->buscaPorId($avaliacao->getIdaluno()),
                "avaliacao" => $avaliacao,
                "clinico" => $this->clinico->BuscarPorIdavaliacao($avaliacao->getIdavaliacao()),
                "bioimpedancia" => $this->bioimpedancia->BuscarPorIdavaliacao($avaliacao->getIdavaliacao()),
                "antropometria" => $this->antropometria->BuscarPorIdavaliacao($avaliacao->getIdavaliacao()),
                "fisioterapico" => $this->fisioterapico->BuscarPorIdavaliacao($avaliacao->getIdavaliacao()),
                "aerobica" => $this->aerobica->BuscarPorIdavaliacao($avaliacao->getIdavaliacao()),
                "aerobica_teste" => $this->aerobicat->BuscarPorIdaerobica($this->retornaIdAerobica($avaliacao->getIdavaliacao())),
                "aerobica_recuperacao" => $this->aerobicar->BuscarPorIdaerobica($this->retornaIdAerobica($avaliacao->getIdavaliacao())),
                "aerobica_zona_treinamento" => $this->aerobicazt->BuscarPorIdaerobica($this->retornaIdAerobica($avaliacao->getIdavaliacao()))
            );              
        }
               
        return $dados;
    }
    
    //Retorna idaerobica por idavaliacao
    private function retornaIdAerobica($idavaliacao){
        $id = $this->aerobica->buscaPorIdAva($idavaliacao)->getIdaerobica();
        if (isset($id)){
            return $id;
        } else {
            return NULL;
        }
    }
    
    //Recupera dados do email
    private function recuperaEnviarEmail(&$id, &$data, &$para, &$copia, &$assunto, &$texto, &$url){
        $id = trim($this->input->post("iptEmlId"));
        $data = trim($this->input->post("iptEmlData"));
        $para = trim($this->input->post("iptEmlPara"));
        $copia = trim($this->input->post("iptEmlCopia"));
        $assunto = trim($this->input->post("iptEmlAssunto"));
        $texto = trim($this->input->post("iptEmlCorpo"));
        $url = trim($this->input->post("iptEmlUrl"));
        
        if (empty($url)){
            $url = "avaliacao";
        }
    }
        
    //Busca anexo 
    private function anexo($id){
        //caminho do documento
        $anexo = "./document/avaliacao/".$id.".pdf";
        //verifica se existe o documento
        if (file_exists($anexo)){
            return $anexo;
        } else{
            return NULL;      
        }       
    }
    
    //enviar email
    private function envioEmail($para, $data, $copia, $assunto, $texto, $anexo = NULL){
        try {
            //carregando biblioteca de email
            $this->load->library("email");
            //pegando configuração
            $this->load->model("email_conf_model", "configuracao");
            $config = $this->configuracao->busca("html");
            //preparando o email
            $this->email->initialize($config);            
            $this->email->from($config["smtp_user"], $this->session->userdata("nome"));
            $this->email->to($para);
            $this->email->cc($copia);
            $this->email->subject($assunto);
            //$this->email->message($texto);
            $this->email->message($this->geraTextoEmail($texto));
            //anexo
            if (isset($anexo)){
                $this->email->attach($anexo);
            }
            if ($this->email->send()) {
                //email enviado com sucesso
                return TRUE;
            } else {
                $head = $this->email->print_debugger(array('headers'));
                $subject = $this->email->print_debugger(array('subject'));
                $body = $this->email->print_debugger(array('body'));
                $this->gravaLog("erro enviar email avaliacao", "Usuario: ".$this->session->userdata("id").". Erro: ".$head." - ".$subject." - ".$body);
                //$this->erro($teste);
                return FALSE;
            }
            //enviando email
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
    
     //gera html da mensagem para enviar por email
    private function geraTextoEmail($texto){
        //substitui o enter por quebra de linha no html
        $texto = str_replace("\n", "<br/>", $texto);
        //gera html da mensagem
        $email = $this->load->view("avaliacao/email", array( 
                "assetsUrl" => base_url("assets"),
                "texto" => $texto), TRUE);
        
        return $email;
    }
    
    //gera html da mensagem para enviar por email
    private function gerarDadosAluno(&$aluno, &$avaliacao, &$clinico, &$bioimpedancia, &$antropometria, &$fisioterapico,
            &$aerobica, &$aerobicat, &$aerobicar, &$aerobicazt){
        
        $msg = array(
            "idaluno" => $aluno->getIdaluno(),
            "nome" => $aluno->getNome(),
            "email" => $aluno->getEmail(),
            "idade" => $aluno->getIdade(),
            "sexo" => $aluno->getSexo(),
            "cota" => $aluno->getCota(),
            "estadocivil" => $aluno->getEstado_civil(),
            "profissao" => $aluno->getProfissao(),
            "posicaotrabalho" => $aluno->getPosicao_trabalho(),
            
            "idavaliacao" => $avaliacao->getIdavaliacao(),
            "data" => $avaliacao->getData(),
            "tabagista" => $avaliacao->getTabagista(),
            "etilista" => $avaliacao->getEtilista(),
            "atividadefisica" => $avaliacao->getAtividade_fisica(),
            
            "idclinico" => $clinico->getIdclinico(),
            "lesaoarticular" => $clinico->getLesao_articular(),
            "coluna" => $clinico->getColuna(),
            "cardiologico" => $clinico->getCardiologico(),
            "varizes" => $clinico->getVarizes(),
            "cirurgias" => $clinico->getCirurgias(),
            "hernia" => $clinico->getHernia(),
            "pulso" => $clinico->getPulso(),
            "pa" => $clinico->getPa(),
            "historiafamiliar" => $clinico->getHistoria_familiar(),
            "medicamentos" => $clinico->getMedicamentos(),
            "informacoes" => $clinico->getInformacoes(),
            
            "idbioimpedancia" => $bioimpedancia->getIdbioimpedancia(),
            "peso" => $bioimpedancia->getPeso(),
            "altura" => $bioimpedancia->getAltura(),
            "imc" => $bioimpedancia->getImc(),
            "agua" => $bioimpedancia->getAgua(),
            "agual" => $bioimpedancia->getAgua_l(),
            "gorduracorporal" => $bioimpedancia->getGordura_corporal(),
            "pesogordura" => $bioimpedancia->getPeso_gordura(),
            "gorduraalvo" => $bioimpedancia->getGordura_alvo(),
            "massamagra" => $bioimpedancia->getMassa_magra(),
            "massamagrakg" => $bioimpedancia->getMassa_magra_kg(),
            "indicemuscular" => $bioimpedancia->getIndice_muscular(),
            
            "idantropometria" => $antropometria->getIdantropometria(),
            "pescoco" => $antropometria->getPescoco(),
            "ombros" => $antropometria->getOmbros(),
            "torax" => $antropometria->getTorax(),
            "cintura" => $antropometria->getCintura(),
            "abdomem" => $antropometria->getAbdomem(),
            "quadril" => $antropometria->getQuadril(),
            "coxadireita" => $antropometria->getCoxa_direita(),
            "coxaesquerda" => $antropometria->getCoxa_esquerda(),
            "panturilhadireita" => $antropometria->getPanturilha_direita(),
            "panturilhaesquerda" => $antropometria->getPanturilha_esquerda(),
            "bracodireito" => $antropometria->getBraco_direito(),
            "bracoesquerdo" => $antropometria->getBraco_esquerdo(),
            "antebracodireito" => $antropometria->getAntebraco_direito(),
            "antebracoesquerdo" => $antropometria->getAntebraco_esquerdo(),
            
            "idfisioterapico" => $fisioterapico->getIdfisioterapico(),
            "postura" => $fisioterapico->getPostura(),
            "colunavertebral" => $fisioterapico->getColuna_vertebral(),
            "forcamuscular" => $fisioterapico->getForca_muscular(),
            "adm" => $fisioterapico->getAdm(),
            "atividadeproposta" => $fisioterapico->getAtividade_proposta(),
            "objetivoatividade" => $fisioterapico->getObjetivo_atividade(),
            "exerciciocontraindicado" => $fisioterapico->getExercicio_contra_indicado(),
            "conduta" => $fisioterapico->getConduta(),
            
            "idaerobica" => $aerobica->getIdaerobica(),
            "freqcardiacamax" => $aerobica->getFreq_cardiaca_max(),
            "freqrep" => $aerobica->getFreq_rep(),
            "freqcardiacatreino" => $aerobica->getFreq_cardiaca_treino(),
            
            );
        
            $this->geraMsgAerobicaTabelas($msg, $aerobicat, $aerobicar, $aerobicazt);
        
        return $msg;
    }
    
    //Adiciona do array de msg do AJAX as tabelas dependentes da aerobica
    private function geraMsgAerobicaTabelas(&$msg, &$aerobicat, &$aerobicar, &$aerobicazt){
        
        if (is_array($aerobicat) && is_array($aerobicar) && is_array($aerobicazt)){
            foreach ($aerobicat as $key => $value) {
                $msg["idaerobicateste".$key] = $value->getIdaerobica_teste();
                $msg["velocidade".$key] = $value->getVelocidade();
                $msg["tempo".$key] = $value->getTempo();
                $msg["freqcardiaca".$key] = $value->getFreq_cardiaca();
                $msg["pse".$key] = $value->getPse();
                $msg["momentocorrida".$key] = $value->getMomento_corrida();
            }

            foreach ($aerobicar as $key => $value) {
                $msg["idaerobicarecuperacao".$key] = $value->getIdaerobica_recuperacao();
                $msg["recuperacao".$key] = $value->getRecuperacao();
                $msg["velocidadear".$key] = $value->getVelocidade();
                $msg["bpm".$key] = $value->getBpm();
            }

            foreach ($aerobicazt as $key => $value) {
                $msg["idaerobicazonatreinamento".$key] = $value->getIdaerobica_zona_treinamento();
                $msg["zonatreinamento".$key] = $value->getZona_treinamento();
                $msg["porcentagem".$key] = $value->getPorcentagem();
                $msg["bpmazt".$key] = $value->getBpm();
            }        
        }        
    }

    //Gerar pdf avaliação
    public function gerarPdf($idavaliacao){
        //carregando a biblioteca
        $this->load->library('pdf');
        //verifica se avaliação existe
        if ($this->avaliacao->existeAvaliacao($idavaliacao)){
            //Gera paginas HTML
            $paginas = $this->geraPaginasAvaliacao($idavaliacao);
            //Css do relatorio
            $css = file_get_contents(base_url('assets/css/sistemapic.relatorio.css')); 
            //gera valores de referencia
            $referencia = $this->geraPaginasReferencia();
            //gera pdf
            $this->pdf->geraAvaliacaoPDF($paginas, $css, $idavaliacao, $referencia);
            //grava log
            $this->gravaLog("avaliaxao", "relatorio avaliação gerado. Usuario: ".$this->session->userdata("id")."Id avaliação: ".$idavaliacao);
            //$this->sucesso($idplantao, "plantao", "Relatório emitido com <strong>sucesso</strong>.<br/>Desaja vizualiza-lo?");
        } else{
            //não existe avaliação
        }
    }
    
    //Gera pagina da avaliação
    private function geraPaginasAvaliacao($idavaliacao){
        //Paginas da avaliação
        $paginas;
        //Verifica se existe avaliação
        if ($this->avaliacao->existeAvaliacao($idavaliacao)){
            //recupera avaliação
            $avaliação = $this->avaliacao->buscaPorId($idavaliacao);
            //gerando html do relatorio
            $paginas = $this->load->view("avaliacao/relatorio", array( 
            "assetsUrl" => base_url("assets"),
            "grafico" => "./document/avaliacao/chart/".$idavaliacao.".png",
            "avaliacao" => $avaliação,
            "aluno" => $this->aluno->buscaPorId($avaliação->getIdaluno()),
            "clinico" => $this->clinico->BuscarPorIdavaliacao($idavaliacao),
            "bioimpedancia" => $this->bioimpedancia->BuscarPorIdavaliacao($idavaliacao),
            "antropometria" => $this->antropometria->BuscarPorIdavaliacao($idavaliacao),
            "fisioterapico" => $this->fisioterapico->BuscarPorIdavaliacao($idavaliacao),
            "aerobica" => $this->aerobica->BuscarPorIdavaliacao($idavaliacao),
            "aerobicat" => $this->aerobicat->BuscarPorIdaerobica($this->aerobica->BuscarPorIdavaliacao($idavaliacao)->getIdaerobica()),
            "aerobicar" => $this->aerobicar->BuscarPorIdaerobica($this->aerobica->BuscarPorIdavaliacao($idavaliacao)->getIdaerobica()),
            "aerobicazt" => $this->aerobicazt->BuscarPorIdaerobica($this->aerobica->BuscarPorIdavaliacao($idavaliacao)->getIdaerobica())
                ), TRUE);  
        }
        return $paginas;
    }
    
    //Gera pagina da avaliação
    private function geraPaginasReferencia(){
        //Paginas da avaliação
        $paginas;
        //gerando html do relatorio
        $paginas = $this->load->view("avaliacao/referencia", array( 
        "assetsUrl" => base_url("assets")
            ), TRUE);  
        
        //var_export($paginas);
        return $paginas;
    }
       
}
