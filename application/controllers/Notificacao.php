<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacao extends CI_Controller {

    /**
     * Notificação.
     * @descripition: classe funções de notificações
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Usuario_model", "usuario");
        $this->load->model("Ocorrencia_model", "ocorrencia");    
        $this->load->model("Notificacao_model", "notificacao");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //não tem index
        redirect(base_url("ocorrencia"));
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
            "arquivoJS" => NULL));
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
            "arquivoJS" => NULL));
    }
    
    /*------------------Funções------------------*/   
    
    
    
    /*----------------Funções AJAX---------------*/
    
    //Quantiddade de notificação ajax
    public function notifQtdChamado(){
        //Recupera Id usuario 
        $id = $this->session->userdata("id");
        
        if (isset($id)){
            $mgs = array(
                "quantidade" => $this->notificacao->contarPorIdDestinatario($id)
            );
            //entregue($destinatario)
            $this->notificacao->entregue($id);
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "X"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    // Notificação entregue ajax
    public function notifEntregue(){
        //Recupera Id usuario 
        $id = $this->session->userdata("id");
        //verifica se tem id
        if (isset($id)){
            //entregue($destinatario)
            $this->notificacao->entregue($id);
        } else {            
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Notificação lida ajax
    public function notifLida(){
        //Recupera Id usuario 
        $id = $this->session->userdata("id");
        //verifica se tem id
        if (isset($id)){
            //lida($destinatario)
            $this->notificacao->lida($id);
        } else {            
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Notificações para exibição
    public function buscaNotificacao(){
        //Recupera Id usuario 
        $id = $this->session->userdata("id");
        
        if (isset($id)){
            //todosNaoLidos($destinatario)
            //todosLidos($destinatario)
            $mgs = array(
                "novos" => $this->notificacao->todosNaoLidos($id),
                "anteriores" => $this->notificacao->todosLidos($id)
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Erro, não foi possível exibir as notificações. Tente novamente"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }


    /*------------Funções internas---------------*/ 
    
    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getOcorrencia() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Notificacao.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Notificacao.php");
            redirect(base_url());
        }
    }
}
