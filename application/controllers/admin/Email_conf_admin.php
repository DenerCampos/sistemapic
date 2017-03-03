<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_conf_admin extends CI_Controller {

    /**
     * Email_conf_admin.
     * @descripition Controlador de configuração de conta do email, para enviar emails pelo sistema.
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Email_conf_model', 'emailconf');
        $this->load->model('estado_model', 'estado');
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));      
        //Carrega menu
        $this->load->view('admin/menu', array(
            "assetsUrl" => base_url("assets"),
            "ativo" => "email"));
        //Carrega usuarios
        $this->load->view('admin/email-conf/email-conf', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "emailconf" => $this->emailconf->todosEmailConf(7, $this->recuperaOffset()),
            "paginas" => $this->listarEmailConf()));
        //Modal
        $this->load->view('admin/email-conf/criar-email-conf', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/email-conf/editar-email-conf', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/email-conf/remover-email-conf', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/email-conf/ativar-email-conf', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    /*------Funções internas--------*/ 
    //Criar
    public function criarEmailConf(){
        //recupera dados
        $useragent = $this->input->post("iptCriUserName");
        $protocol = $this->input->post("selCriProtocol");
        $smtp_host = $this->input->post("iptCriHost");
        $smtp_user = $this->input->post("iptCriUser");
        $smtp_pass = $this->input->post("iptCriPass");
        $smtp_port = $this->input->post("iptCriPort");
        $smtp_crypto = $this->input->post("selCriCryp");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->emailconf->emailConfExiste($useragent)){
            //cria area
            $this->emailconf->newEmailConf($useragent, $protocol, $smtp_host, $smtp_user, $smtp_pass, $smtp_port, $smtp_crypto, $this->geraEstado($estado));
            $this->emailconf->addEmailConf();
            //Log
            $this->gravaLog("ADMIN criação email conf", "email conf criada: ".$useragent);
            redirect(base_url('admin/email_conf_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação area", "tentativa de criar area: ".$nome." Email: ". $email);
            echo'erro ao criar area';
        }
    }
    
    //Paginação
    public function listarEmailConf(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/email_conf_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->emailconf->contarTodos(),
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
    
    //Paginação, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else{
            return 0;
        }
    }
    
    //busca estado
    private function geraEstado($estado){
        return $this->estado->buscaNome($estado)->getIdestado();
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
      
    //Editar ajax
    public function editarEmailConf(){
        //Recupera Id
        $id = $this->input->post("idemailconf");
        $emailconf = $this->emailconf->buscaId($id);
        
        if (isset($emailconf)){
            $estado = $this->estado->buscaId($emailconf->getIdestado());
            $mgs = array(
                "idemailconf" => $emailconf->getIdemail_conf(),
                "username" => $emailconf->getUseragent(),
                "protocol" => $emailconf->getProtocol(),
                "host" => $emailconf->getSmtp_host(),
                "user" => $emailconf->getSmtp_user(),
                "pass" => $emailconf->getSmtp_pass(),
                "port" => $emailconf->getSmtp_port(),
                "cryp" => $emailconf->getSmtp_crypto(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Configuração não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover area ajax
    public function removerEmailConf(){
        //Recupera Id 
        $id = $this->input->post("idemailconf");
        $emailconf = $this->emailconf->buscaId($id);
        
        if (isset($emailconf)){
            $mgs = array(
                "idemailconf" => $emailconf->getIdemail_conf(),
                "username" => $emailconf->getUseragent(),
                "host" => $emailconf->getSmtp_host(),
                "user" => $emailconf->getSmtp_user(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Configuração não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar ajax
    public function ativarEmailConf(){
        //Recupera Id area
        $id = $this->input->post("idemailconf");
        $emailconf = $this->emailconf->buscaId($id);
        
        if (isset($emailconf)){
            $mgs = array(
                "idemailconf" => $emailconf->getIdemail_conf(),
                "username" => $emailconf->getUseragent(),
                "host" => $emailconf->getSmtp_host(),
                "user" => $emailconf->getSmtp_user(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Configuração não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Atualiza
    public function atualizaEmailConf(){
        //recupera dados
        $id = $this->input->post("iptEdtId");
        $useragent = $this->input->post("iptEdtUserName");
        $protocol = $this->input->post("selEdtProtocol");
        $smtp_host = $this->input->post("iptEdtHost");
        $smtp_user = $this->input->post("iptEdtUser");
        $smtp_pass = $this->input->post("iptEdtPass");
        $smtp_port = $this->input->post("iptEdtPort");
        $smtp_crypto = $this->input->post("selEdtCryp");
        $estado = $this->input->post("selEdtEstado");
        
        //verifica dados
        if (!$this->emailconf->verificaEmailConfAtualiza($id, $useragent)){
            //atualiza
            $this->emailconf->atualizaEmailConf($id, $useragent, $protocol, $smtp_host, $smtp_user, $smtp_pass, $smtp_port, $smtp_crypto, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração email conf", "email alterado: ".$useragent);
            redirect(base_url('admin/email_conf_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração email conf", "tentativa de alterar email: ".$useragent);
            echo'erro ao alterar email conf';
        }            
    }
    
    //Desabilitar
    public function desabilitaEmailConf(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        
        //verifica se existe e esta ativo
        if ($this->emailconf->verificaAtivo($id)){
            //desativa usuario
            $this->emailconf->desativaEmailConf($id);
            //Log
            $this->gravaLog("ADMIN desabilita email conf", "email desabilitado id: ".$id);
            redirect(base_url('admin/email_conf_admin'));
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar email conf", "tentativa de desabilitar email id: ".$id);
            echo'erro ao desabilitar email conf';
        }
    }
    
    //Ativar usuario
    public function ativaEmailConf(){
        //recupera id 
        $id = $this->input->post("iptAtvId");
        
        //verifica se existe e esta ativo
        if ($this->emailconf->verificaDesativo($id)){
            //desativa 
            $this->emailconf->ativaEmailConf($id);
            //Log
            $this->gravaLog("ADMIN ativa email conf", "email ativado id: ".$id);
            redirect(base_url('admin/email_conf_admin'));
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar email conf", "tentativa de ativar email id: ".$id);
            echo'erro ao ativar email conf';
        }
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Email_conf_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Email_conf_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Email_conf_adim.php");
            redirect(base_url());
        }
    }
}
