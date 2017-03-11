<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantao extends CI_Controller {

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
            "ativo" => "plantao"));      
        //Carrega index
        $this->load->view('plantao/home', array(
            "assetsUrl" => base_url("assets"),
            "plantoes" => $this->plantao->todasPlantoes(10, $this->recuperaOffset()),
            "paginas" => $this->listarPlantao()));
        //Modal
        $this->load->view("plantao/criar-plantao", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
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
            "msgerro" => 'teste de ero'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
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
            "msg" => 'teste de mensagem',
            "uri" => 'home'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
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
 
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') == '2'){
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Plantao.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Plantao.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Plantao.php");
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
                $this->gravaPlantao($inicio, $fim);
                //gera pdf
                $this->pdf->geraRelatorioPDF($paginas, $css);
                //grava log
                $this->gravaLog("relatorio", "relatorio plantão gerado. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
                redirect("plantao");
            } else {
                //grava log
                $this->gravaLog("erro relatorio", "nao existe chamados neste periodo para o usuario. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
                //não existe chamados
                echo 'Não existe chamados neste periodo para o usuario '.$this->session->userdata("nome");
            }
        } else {
            //grava log
            $this->gravaLog("erro relatorio", "Datas invalidas. data: ".$inicio." a ".$fim." usuario: ".$this->session->userdata("id"));
            //erro nas datas
            echo 'Datas invalidas';
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
        $this->plantao->addPlantao();
    }
}
