<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Base para controller.
     *
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //carregando modelo
        $this->load->model("Usuario_model", "usuario");
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        redirect("home");
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
            "msg" => $msg,
            "uri" => $uri));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    /*------Funções internas--------*/
    //Efetuar login
    public function logar() {
        //recuperando dados do formulario
        $login = trim($this->input->post("iptEmail"));
        $senha = trim($this->input->post("iptSenha"));       
        try {
            //busca usuario no bd
            $usuario = $this->usuario->buscaUsuario($login);
            if (isset($usuario)) {
                //verifica senha
                if ($this->verificaSenha($senha, $usuario->getSenha()) && ($this->verificaAtivo($usuario->getIdestado()))){
                    //cria sessão
                    $this->criaSessao($usuario);
                    //log
                    $this->gravaLog("login", "usuario ". $login." entrou no sistema");
                    //redireciona para home
                    redirect(base_url('home'));
                }else{
                    //log
                    $this->gravaLog("erro login", "usuario ". $login." tentou entrar no sistema com senha invalida");
                    //erro, senha invalida
                    $this->erro('Senha invalida à conta: '.$login);
                }            
            } else {
                //erro, usuario invalido
                //log
                $this->gravaLog("erro login", "usuario ". $login." tentou entrar no sistema com login invalido");
                //$this->erro("Usuário ou senha inválido.");
                $this->erro('Login não cadastrado: '.$login);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral login", "erro: ".$exc->getTraceAsString());
            $this->erro('Erro geral: '.$exc->getTraceAsString());
        }   
    }
    
    //Logoff
    public function logoff(){
        try {
            //verifica se esta logado
            if ($this->session->has_userdata('nome')){
                //logoff
                $this->session->sess_destroy();
                //log
                $this->gravaLog("logoff", "usuario ". $this->session->userdata('nome')." saiu do sistema");
                redirect('home');
            } else {
                redirect('home');
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral logoff", "erro: ".$exc->getTraceAsString());
            $this->erro('Erro geral: '.$exc->getTraceAsString());
        }  
    }
    
    //verifica usuario ativo
    private function verificaAtivo($estado){
        if ($estado == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //verifica senha
    private function verificaSenha($senha, $senhabanco){
        if (password_verify($senha, $senhabanco)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //cria sessão no navegador
    private function criaSessao(&$usuario){
        //dados da sessão
        $dados = array(
            "id" => $usuario->getIdusuario(),
            "nome" => $usuario->getNome(),
            "login" => $usuario->getLogin(),
            "nivel" => $usuario->getNivel(),
            "area" => $usuario->getIdarea()
        );
        //cria sessão
        $this->session->set_userdata($dados);
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
