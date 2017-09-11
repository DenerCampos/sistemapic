<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantao extends CI_Controller {

    /**
     * Plantao
     * @descripition Gerar relatórios de plantão por tecnico dos chamados fechados 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Ocorrencia_model", "ocorrencia");
        $this->load->model("Setor_model", "setor");
        $this->load->model("Comentario_model", "comentario");
        $this->load->model("Relatorio_plantao_model", "plantao");
    }
      
    /*------Carregamento de views--------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('plantao/home', array(
            "assetsUrl" => base_url("assets"),
            "plantoes" => $this->plantao->todasPlantoes(10, $this->recuperaOffset()),
            "paginas" => $this->listarPlantao()));
        //Modal
        $this->load->view("plantao/criar-plantao", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("plantao/email-plantao", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "plantao.js"));
    }
    
    //Resultado
    public function resultado($palavra, $usuario = NULL, $data = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('plantao/resultado', array(
            "palavra" => $palavra,
            "data" => $data,
            "usuario" => $usuario
        ));      
        //Modal
        $this->load->view("plantao/criar-plantao", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("plantao/email-plantao", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "plantao.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => $msg));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "plantao.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));     
        //Carrega index
        $this->load->view('mensagens/mensagem', array(
            "assetsUrl" => base_url("assets"),
            "msg" => $msg,
            "uri" => $uri));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "plantao.js"));
    }
    
    //Mensagem de sucesso do relatorio
    public function sucesso($id, $uri, $msg) {
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array(
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array(
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));
        //Carrega index
        $this->load->view('plantao/sucesso', array(
            "assetsUrl" => base_url("assets"),
            "msg" => $msg,
            "uri" => $uri,
            "emitir" => $id));
        //Modal
        $this->load->view("usuario/criar-usuario", array(
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "plantao.js"));
    }

    /*------Funções internas--------*/ 
    
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
    
    //Paginação
    public function listarPlantao(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('plantao'),
            "per_page" => 10,
            "num_links" => 2,
            "uri_segment" => 2,
            "total_rows" => $this->plantao->contarTodos(),
            "full_tag_open" => "<ul class='pagination'>",
            "full_tag_close" => "</ul>",
            "first_link" => FALSE,
            "last_link" => FALSE,
            "first_tag_open" => "<li>",
            "first_tag_close" => "</li>",
            "prev_link" => "<span aria-hidden='true'>&laquo;</span>",
            "prev_tag_open" => "<li class='prev'>",
            "prev_tag_close" => "</li>",
            "next_link" => "<span aria-hidden='true'>&raquo;</span>",
            "next_tag_open" => "<li class='next'>",
            "next_tag_close" => "</li>",
            "last_tag_open" => "<li>",
            "last_tag_close" => "</li>",
            "cur_tag_open" => "<li class='active'> <a href='#'>",
            "cur_tag_close" => "</a></li>",
            "num_tag_open" => "<li>",
            "num_tag_close" => "<li>"
        );
        //Inicializar biblioteca pagination
        $this->pagination->initialize($config);
        //html completo dos links
        $paginas = $this->pagination->create_links();
        return $paginas;
    }
    
    //Paginação usuariao, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(2)){
            return $this->uri->segment(2);
        } else{
            return 0;
        }
    }
 
    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getRelatorio() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso sem permissao", "acesso ao controlador Plantao.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Plantao.php");
            redirect(base_url());
        }
    }
    
    public function gerar(){
        //carregando a biblioteca
        $this->load->library('pdf');
        //recupera datas
        $inicio; $fim;
        $this->recuperaDatas($inicio, $fim);
        //verifica datas validas
        if ($this->verificaDatas($inicio, $fim)){
            //Verifica se contem chamados neste periodo para o usuaruio          
            if ($this->ocorrencia->contem($inicio, $fim, $this->session->userdata("id"))){
                //Gera arquivo
                $resultado = $this->geraArquivoRelatorioPlantao($inicio, $fim);
                //Css do relatorio
                $css = file_get_contents(base_url('assets/css/sistemapic.relatorio.css'));   
                //gerando paginas
                $paginas = $this->geraPaginasRelatorioPlantao($resultado);  
                //grava no bd relatorio plantão
                $idplantao = $this->gravaPlantao($inicio, $fim);
                //gera pdf
                $this->pdf->geraRelatorioPDF($paginas, $css, $idplantao);
                //grava log
                $this->gravaLog("relatorio", "relatorio plantão gerado. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
                $this->sucesso($idplantao, "plantao", "Relatório emitido com <strong>sucesso</strong>.<br/>Desaja vizualiza-lo?");
            } else {
                //grava log
                $this->gravaLog("erro relatorio", "nao existe chamados neste periodo para o usuario. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
                //não existe chamados
                $this->erro('Não existe chamados fechados neste período para o usuário <strong>'.$this->session->userdata("nome")).'.</strong>';
            }
        } else {
            //grava log
            $this->gravaLog("erro relatorio", "Datas invalidas. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
            //erro nas datas
            $this->erro('Datas inválidas');
        }
    }
    
    //Setores com chamados abertos para relatorio de plantão
    private function setoresRelatorio(&$chamados){
        //inicia setor
        $setores;
        foreach ($chamados as $chamado) {
            $setor = $this->setor->buscaId($chamado->getIdsetor());
            if (!$this->verificaSetor($setores, $setor)){
                $setores[] = $setor;
            }
        }
        return $setores;
    }
    
    //verifica se contem setor
    private function verificaSetor(&$setores, &$setor){
        $existe = FALSE;
        if (isset($setores)){
            foreach ($setores as $key) {
                if ($key->getIdsetor() == $setor->getIdsetor()){
                    $existe = TRUE; //existe setor
                    break;
                }
            }
            if ($existe){
                return TRUE; //existe setor
            } else {
                return FALSE; //não existe setor
            }
        } else {
            return FALSE; //não existe setor
        }
    }

    //Recupera datas do post
    private function recuperaDatas(&$inicio, &$fim){
        $inicio = $this->input->post("iptCriDataInicio");
        $fim = $this->input->post("iptCriDataFim");
    }
    
    //Verifica se datas são validas
    private function verificaDatas(&$inicio, &$fim){
        if (isset($inicio) && (isset($fim))){
            if (strtotime($inicio) <= strtotime($fim)){
                //adiciona 1 dia na data fim
                $fim = date("Y-m-d", strtotime($fim) + 86400);
                //$fim = date("Y-m-d", strtotime($fim));
                return TRUE;
            }else {
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    //Gera o relatorio de plantão por data
    private function geraArquivoRelatorioPlantao($inicio, $fim){
        //intervalo de dias
        $datainicio = new DateTime($inicio);
        $datafim = new DateTime($fim);                
        $intervalo = $datainicio->diff($datafim)->days;
        //Gerando arquivo
        for ($i = 0; $i < $intervalo; $i++){
            $chamados = $this->ocorrencia->todasDataFechado($inicio, date("Y-m-d", strtotime($inicio) + 86400), $this->session->userdata("id"));
            if (isset($chamados)){
                $paginas[] = $chamados;
            }
            $inicio = date("Y-m-d", strtotime($inicio) + 86400);
        }
        return $paginas;
    }
    
    //Gera paginas do relatorio de plantão por data
    private function geraPaginasRelatorioPlantao($resultado){
        for ($i = 0; $i < count($resultado); $i++){
            //gerando setores
            $setores = $this->geraSetoresRelatorioPlantao($resultado[$i]);
            //gerando html do relatorio
            $paginas[] = $this->load->view("plantao/relatorio", array( 
                "assetsUrl" => base_url("assets"),
                "chamados" => $resultado[$i],
                "setores" => $setores,
                "data" => $this->geraDataRelatorioPlantao($resultado[$i][0]->getData_fechamento()),
                "comentario" => new Comentario_model()), TRUE);
            $setores = NULL;
        }
        return $paginas;
    }
    
    //Gera os setores sem repetição para o relatorio de plantão
    private function geraSetoresRelatorioPlantao($resultado){
        $setores_id[] = array(); $setores;
        foreach ($resultado as $chamado) {
            //verifica se existe o setor dentro do array (para não repetir setor)
            if (in_array($this->setor->buscaId($chamado->getIdsetor())->getIdsetor(), $setores_id)){
                //existe setor, não faz nada
            } else{
                $setores_id[] = $this->setor->buscaId($chamado->getIdsetor())->getIdsetor();
                $setores[] = $this->setor->buscaId($chamado->getIdsetor());
            }
        }
        return $setores;
    }

    //Gera data para relatrio de plantão
    private function geraDataRelatorioPlantao($data){
        //Dia da semana
        $dia = date("l", strtotime($data));
        switch ($dia) {
            case "Sunday":
                $dia = "Domingo";
                break;
            case "Monday":
                $dia = "Segunda-feira";
                break;
            case "Tuesday":
                $dia = "Terça-feira";
                break;
            case "Wednesday":
                $dia = "Quarta-feira";
                break;
            case "Thursday":
                $dia = "Quinta-feira";
                break;
            case "Friday":
                $dia = "Sexta-feira";
                break;
            case "Saturday":
                $dia = "Sabado";
                break;
            default:
                $dia = "Erro dia";
                break;
        }     
        return date("d/m/Y", strtotime($data))." - ".$dia;
    }
    
    //Grava no bd relatorio de plantão
    private function gravaPlantao($inicio, $fim){
        $ocorrencias = NULL;
        //busca todas ocorrencias no periodo
        $chamados = $this->ocorrencia->todasPeriodoFechados($inicio, $fim, $this->session->userdata("id"));
        for ($i = 0; $i < count($chamados); $i++){
            $numero = $chamados[$i]->getIdocorrencia();
            $ocorrencias = $ocorrencias.$chamados[$i]->getIdocorrencia();
            if ($i < count($chamados)-1){
                $ocorrencias = $ocorrencias.", ";
            } else{
                $ocorrencias = $ocorrencias.".";
            }
        }
        //volta data 
        $fim = date("Y-m-d",strtotime($fim) - 86400);
        //grava no bd
        $data = date('Y-m-d H:i:s');
        $this->plantao->newPlantao($data, $this->session->userdata("nome"), $inicio, $fim, $ocorrencias);
        return $this->plantao->addPlantao();
    }
    
    //Busca por ocorrencia
    public function buscar(){
        //recupera dados da busca
        $busca = strtolower(trim($this->input->post("iptBusca")));
        try {
            //verifica se foi digitado algo
            if (isset($busca) && $busca != ""){
                //busca por data do plantão todasPorBuscaData($data, $limite = NULL, $ponteiro = NULL)
                //$data = $this->plantao->todasPorBuscaData($busca);
                //busca por usuario do plantão todasPorBuscaUsuario($usuario, $limite = NULL, $ponteiro = NULL)
                $usuario = $this->plantao->todasPorBuscaUsuario($busca);
                // view resultado($palavra, $data = NULL, $usuario = NULL)
                $this->resultado($busca, $usuario);
            } else {
                $this->resultado("'vazio'");
            }                       
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca. Favor tentar novamente.");
        }
    }
    
   //Enviar email AJAX
    public function enviarEmailPlantao(){
        //Recupera Id manutencao
        $id = trim($this->input->post("idplantao"));
        $plantao = $this->plantao->buscaId($id);
        
        //datas
        $hoje = date("d/m/Y");
        $ontem = date("d/m/Y", mktime (0, 0, 0, date("m")  , date("d")-1, date("Y")));
        
        if (isset($plantao)){
            $msg = array(
                "idrelatorio" => $plantao->getIdrelatorio_plantao(),
                "data" => date("d/m/Y", strtotime($plantao->getData())),
                "usuario" => $plantao->getUsuario(),
                "para" => "ricardo.souza@pic-clube.com.br",
                "copia" => "ti@pic-clube.com.br",
                "assunto" => "Relatório final de semana (".$ontem." à ".$hoje.").",
                "corpo" => "Prezados, boa tarde! \n\nSegue em anexo o relatório do final de semana. \n\nAtt. \n".$this->session->userdata("nome"),
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Manutencao não encontrada"
            );
            echo json_encode($msg);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Recupera dados do email
    private function recuperaEnviarEmail(&$id, &$para, &$copia, &$assunto, &$texto){
        $id = trim($this->input->post("iptEmlId"));
        $para = trim($this->input->post("iptEmlPara"));
        $copia = trim($this->input->post("iptEmlCopia"));
        $assunto = trim($this->input->post("iptEmlAssunto"));
        $texto = trim($this->input->post("iptEmlCorpo"));
    }

    //Enviar email
    public function enviarEmail(){
        //recupera dados
        $id; $para; $copia; $assunto; $texto;
        
        try {
            //recupera dados do post
            $this->recuperaEnviarEmail($id, $para, $copia, $assunto, $texto);
            //verificar se existe relatorio de plantão
            if ($this->plantao->existe($id)){
                //anexo
                $anexo = $this->anexo($id);
                if ($this->envioEmail($para, $copia, $assunto, $texto, $anexo)){
                    $this->gravaLog("enviar email plantao", "relatorio id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->mensagem("E-mail enviado com <strong>sucesso</strong>!", "plantao");
                }else {
                    $this->gravaLog("erro enviar email plantao", "relatorio id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->erro("Erro ao enviar e-mail, <strong>tente novamente</strong>.");
                }
            }else{
                //erro, não existe plantão
                $this->gravaLog("erro enviar email plantao", "o relatorio não existe. id: ".$id);
                $this->erro("Não existe o relatório de número: <strong>".$id.".</strong>. <br>Tente novamente.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro para enviar e-mail. Favor tentar novamente.");
        }
    } 
    
    //Busca anexo 
    private function anexo($id){
        //caminho do documento
        $anexo = "./document/relatorio/".$id.".pdf";
        //verifica se existe o documento
        if (file_exists($anexo)){
            return $anexo;
        } else{
            return NULL;      
        }       
    }


    //enviar email
    private function envioEmail($para, $copia, $assunto, $texto, $anexo = NULL){
        try {
            //carregando biblioteca de email
            $this->load->library("email");
            //pegando configuração
            $this->load->model("email_conf_model", "configuracao");
            $config = $this->configuracao->busca("text");
            //preparando o email
            $this->email->initialize($config);
            $this->email->from($config["smtp_user"], $this->session->userdata("nome"));
            $this->email->to($para);
            $this->email->cc($copia);
            $this->email->subject($assunto);
            $this->email->message($texto);
            //anexo
            if (isset($anexo)){
                $this->email->attach($anexo);
            }
            if ($this->email->send()) {
                //email enviado com sucesso
                return TRUE;
            } else {
                $head = $this->email->print_debugger(array('headers'));
                $subject = $this->email->print_debugger(array('subject'));;
                $body = $this->email->print_debugger(array('body'));
                $this->gravaLog("erro enviar email plantao", "Usuario: ".$this->session->userdata("id").". Erro: ".$head." - ".$subject." - ".$body);
                //$this->erro($teste);
                return FALSE;
            }
            //enviando email
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
}
