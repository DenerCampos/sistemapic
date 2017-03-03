<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    /**
     * Usuario
     * @descripition: Controlador usuario
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //carregando modelo
        $this->load->model('Usuario_model', 'usuario');
    }
    
    
    /*------Carregamento de views--------*/ 
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
    //Criar usuario
    public function criar(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $login = $this->input->post("iptCriEmail");
        $senha = $this->input->post("iptCriSenha");
        $rsenha = $this->input->post("iptCriRSenha");
        
        //verifica dados
        if ($this->verificaLogin($login, $senha, $rsenha)){
            //cria usuario
            $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), 2, 1);
            $this->usuario->addUsuario();
            //Log
            $this->gravaLog("criação usuario", "usuario criado: ".$nome." Email: ". $login);
            redirect(base_url('home'));
        }else{
            //Log
            $this->gravaLog("erro criação usuario", "tentativa de criar usuario: ".$nome." Email: ". $login);
            echo'erro ao criar usuario';
        }
    }
    
    //verificação de login e senha
    private function verificaLogin($login, $senha, $rsenha){
        //Verifica se login existe e senha
        if ($this->usuario->loginExiste($login)){
            return FALSE;
        } elseif ($senha != $rsenha) {
            return FALSE;
        } else{
            return TRUE;
        }
    }
    
    //gera hash senha
    private function geraSenha($senha){
        $novo = password_hash($senha, PASSWORD_DEFAULT);
        return $novo;
    }
    
    //verifica senha
    private function verificaSenha($senha, $senhabanco){
        if (password_verify($senha, $senhabanco)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
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
    
}
