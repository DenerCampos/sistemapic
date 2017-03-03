<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracao extends CI_Controller {

    /**
     * Admin.
     * @descripition Controlador admin, para administração do sistema.
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index()
    {
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));      
        //Carrega menu
        $this->load->view('admin/menu', array(
            "assetsUrl" => base_url("assets")));
        //Carrega home
        $this->load->view('admin/home', array(
            "assetsUrl" => base_url("assets")));
        //Modal
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
    
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') != '0'){
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Administracao.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Administracao.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Administracao.php");
            redirect(base_url());
        }
    }
}
