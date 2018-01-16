<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exibir extends CI_Controller {

    /**
     * Exibir 
     * Exibe dados para todos os usuarios.
     * @descripition 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //carregando modelo
        $this->load->model('local_model', 'local');
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('home', array(
            "assetsUrl" => base_url("assets")));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "home.js"));
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "home.js"));
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "home.js"));
    }
    
    //Exibir maquinas
    public function maquina(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('exibir/maquinas', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->maquinas(),
            "local" => new Local_model()));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "exibir.js"));
    }
    
    //Exibir pinpads
    public function pinpad(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('exibir/pinpad', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->pinpads(),
            "local" => new Local_model()));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "exibir.js"));
    }
    
    //Exibir pos
    public function pos(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('exibir/pos', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->poss(),
            "local" => new Local_model()));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "exibir.js"));
    }
    
    //Exibir fiscal
    public function fiscal(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('exibir/fiscal', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->impressoraFiscal(),
            "local" => new Local_model()));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "exibir.js"));
    }
    
    //Exibir pos
    public function impressora(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));     
        //Carrega index
        $this->load->view('exibir/impressora', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->impressoras(),
            "local" => new Local_model()));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "exibir.js"));
    }
    
    /*------------------Funções------------------*/   


    /*----------------Funções AJAX---------------*/
    
        
    /*------------Funções internas---------------*/ 
    //Maquinas
    private function maquinas(){
        //carregando modelo
        $this->load->model('maquina_model', 'maquina');
        return $this->ordenaPorIP($this->maquina->buscaTodas());
    }
    
    //PinPads
    private function pinpads(){
        //carregando modelo
        $this->load->model('pinpad_model', 'pinpad');
        return $this->ordenarPorNome($this->pinpad->todos());
    }
    
    //Pos
    private function poss(){
        //carregando modelo
        $this->load->model('pos_model', 'pos');
        return $this->ordenarPorNome($this->pos->todos());
    }
    
    //Impressora fiscal
    private function impressoraFiscal(){
        //carregando modelo
        $this->load->model('Impressora_fiscal_model', 'fiscal');
        return $this->ordenarPorCaixa($this->fiscal->todos());
    }
    
    //Impressora
    private function impressoras(){
        //carregando modelo
        $this->load->model('Impressora_model', 'impressora');
        return $this->ordenarPorNome($this->impressora->todos());
    }
    
    //Ordena a lista de maquinas por ip
    private function ordenaPorIP($lista){
        //Ordena um array pelos valores utilizando uma função de comparação definida pelo usuário
        usort($lista, function ($a, $b){
            //Comparação de strings usando o algoritmo "natural order"
            return strnatcmp($a->getIp(), $b->getIp());
        });
        return $lista;
    }
    
    //Ordena a lista de objetos por nome
    private function ordenarPorNome($lista){
        //verifica se lista vazia
        if (isset($lista)){
            //Ordena um array pelos valores utilizando uma função de comparação definida pelo usuário
            usort($lista, function ($a, $b){
                //Comparação de strings usando o algoritmo "natural order"
                return strnatcmp($a->getNome(), $b->getNome());
            });
            return $lista;
        } else {
            return $lista;
        }
    }
    
    //Ordena a lista de objetos por nome
    private function ordenarPorCaixa($lista){
        //verifica se lista vazia
        if (isset($lista)){
            //Ordena um array pelos valores utilizando uma função de comparação definida pelo usuário
            usort($lista, function ($a, $b){
                //Comparação de strings usando o algoritmo "natural order"
                return strnatcmp($a->getCaixa(), $b->getCaixa());
            });
            return $lista;
        } else {
            return $lista;
        }
    }
}
