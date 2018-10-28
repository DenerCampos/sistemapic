<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Login.
     * Cria usuario padrão, com acesso ao helpdesk e usuario.
     * Realiza login e logoff
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //carregando modelo
        $this->load->model("Usuario_model", "usuario");
    }
    
    
    /*------Carregamento de views----------*/ 
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "login.js"));
    }
    
    //Mensagem
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
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "login.js"));
    }
    
    /*----------------Funções -------------*/
    //Criar usuario
    public function criar() {
        //recupera dados
        $nome; $login; $senha; $rsenha; $url;

        try {
            //recupera dados
            $this->recuperaCriarUsuario($nome, $login, $senha, $rsenha, $url);
            //verifica dados
            if ($this->verificaLogin($login, $senha, $rsenha)) {
                //cria usuario
                $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), 2, 1);
                $this->usuario->addUsuario();
                //cria acesso padrão novo($ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $patrimonio, $idusuario)
                $this->acesso->novo(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, $this->usuario->buscaUsuario($login)->getIdusuario());
                $this->acesso->adiciona();
                //Log
                $this->gravaLog("criação usuario", "usuario criado: " . $nome . " Email: " . $login);
                //loga automatico
                $this->login($login);
            } else {
                //Log
                $this->gravaLog("erro criação usuario", "tentativa de criar usuario: " . $nome . " Email: " . $login);
                $this->erro("Erro ao criar o usuario, favor tentar novamente.");
            }
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral", "erro criação de usuario: " . $login . " erro:" . $exc->getTraceAsString());
            $this->erro('Erro geral: '.$exc->getTraceAsString());
        }
    }

    //Efetuar login
    public function logar() {        
        $login; $senha; $url;
        try {
            //recuperando dados do formulario
            $this->recuperaLogarUsuario($login, $senha, $url);
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
                    $this->erro('Senha inválida para o login: '.$login);
                }            
            } else {
                //erro, usuario invalido
                //log
                $this->gravaLog("erro login", "usuario ". $login." tentou entrar no sistema com login invalido");
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
    
    //Recuperar senha
    public function recuperarSenha(){
        $login; $url; $senha;
        try {
            //recuperar dados post
            $this->recuperaRecuperarSenha($login, $url);
            //gerar nova senha
            $senha = $this->gerarSenhaLogin($login);
            //verifica se usuario existe
            if ($this->usuario->verificaEmailAtivo($login)){
                //altera no bd
                $this->usuario->atualizaSenhaRecuperar($login, $this->geraSenha($senha));
                //envia por e-mail
                //criando corpo email
                $texto = $this->emailRecuperarSenha($login, $senha);
                $assunto = "Nova senha do Sistema PIC";
                if ($this->envioEmail($login, $assunto, $texto)){
                    //log
                    $this->gravaLog("recuperacao de senha", "usuario ".$login." senha gerada: ".$senha);
                    //mensagem ok
                    $this->mensagem("Solicitação se nova senha OK. Você receberá um e-mail com a nova senha", $url);
                } else{
                    //log
                    $this->gravaLog("erro recuperacao de senha", "erro ao enviar email usuario ".$login." senha gerada: ".$senha);
                    //msg erro
                    $this->erro("Não foi possivel enviar e-mail para: ".$login." Favor tentar novamente.");
                }                
            }
            //mensagem de erro
            //log
            $this->gravaLog("erro recuperacao de senha", "erro ao verificar usuario existe ou ativo. usuario ".$login." senha gerada: ".$senha);

        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral recuperar senha", "erro: ".$exc->getTraceAsString());
            $this->erro('Erro geral: '.$exc->getTraceAsString());
        }
    }


    /*------------Funções AJAX-------------*/ 
    
    //Verifica se existe o email cadastrado
    public function verificaEmail(){
        $email = trim($this->input->get_post("iptEmail"));
        //verifica se existe
        if ($this->usuario->loginExiste($email)){
            echo json_encode(TRUE);
        }else {
            echo json_encode(FALSE);
        }
            exit();
    }
    
    //Verifica se existe o email cadastrado
    public function verificaEmailCriar(){
        $email = trim($this->input->get_post("iptCriEmail"));
        //verifica se existe
        if ($this->usuario->loginExiste($email)){
            echo json_encode(FALSE);
        }else {
            echo json_encode(TRUE);
        }
            exit();
    }
    
    //Verifica se existe o email cadastrado
    public function verificaEsqueciSenha(){
        $email = trim($this->input->get_post("iptEsqueciSenhaEmail"));
        //verifica se existe
        if ($this->usuario->verificaEmailAtivo($email)){
            echo json_encode(TRUE);
        }else {
            echo json_encode(FALSE);
        }
            exit();
    }
    
    /*-----------Funções internas----------*/    
    //Efetua login apos cadastrar o usuario corretamente
    private function login($login) {
        try {
            //busca usuario no bd
            $usuario = $this->usuario->buscaUsuario($login);
            if (isset($usuario)) {
                //cria sessão
                $this->criaSessao($usuario);
                //log
                $this->gravaLog("login", "usuario " . $login . " entrou no sistema");
                //redireciona para home
                redirect(base_url('home'));
            } else {
                //erro, usuario invalido
                //log
                $this->gravaLog("erro login", "usuario " . $login . " tentou entrar no sistema com login invalido");
                $this->erro('Login não cadastrado: ' . $login);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral login", "erro: " . $exc->getTraceAsString());
            $this->erro('Erro geral: ' . $exc->getTraceAsString());
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
            "area" => $usuario->getIdarea(),
            "foto" => $this->caminhoFoto($usuario),
            "acesso" => serialize($this->acesso->buscaIdUsuario($usuario->getIdusuario()))
        );
        //cria sessão
        $this->session->set_userdata($dados);
    }
    
    //busca caminho da foto perfil
    private function caminhoFoto(&$usuario){
        //extensões permitidas
        $ext = array ('gif', 'jpg', 'png');
        //caminho da foto
        $caminho = './document/user/';
        //verifica se existe o arquivo
        foreach ($ext as $value) {
            if (file_exists($caminho.$usuario->getIdusuario().".".$value)){
                //retorna caminho completo
                return base_url('document/user/'.$usuario->getIdusuario().".".$value);
            }
        }
        return base_url('document/user/0.png');
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
    
    //Recupera dados post criar usuario
    private function recuperaCriarUsuario(&$nome, &$login, &$senha, &$rsenha, &$url){
        //recupera dados
        $nome = ucwords(trim($this->input->post("iptCriNome")));
        $login = strtolower(trim($this->input->post("iptCriEmail")));
        $senha = trim($this->input->post("iptCriSenha"));
        $rsenha = trim($this->input->post("iptCriRSenha"));
        $url = $this->input->post("iptCriUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "home";
        }
    }
    
    //recupera dados post logar usuario
    private function recuperaLogarUsuario(&$login, &$senha, &$url){
        //recuperando dados do formulario
        $login = strtolower(trim($this->input->post("iptEmail")));
        $senha = trim($this->input->post("iptSenha")); 
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "home";
        }
    }
    
    //recupera dados post recuperar senha
    private function recuperaRecuperarSenha(&$login, &$url){
        //recuperando dados do formulario
        $login = strtolower(trim($this->input->post("iptEsqueciSenhaEmail")));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "home";
        }
    }
    
    //gerar senha aleatorio por login (recuperar senha)
    private function gerarSenhaLogin($login){
        if (isset($login)){
            $nome = explode("@", $login);
            $numero = rand(strlen($nome[0])*1024, strlen($nome[0])*2131);
            $senha = $nome[0].$numero;
            
            return $senha;
        }
    }
    
    //Corpo do e-mail para recuperar senha
    private function emailRecuperarSenha($login, $senha){
        //recupera ocorrencia
        $usuario = $this->usuario->buscaUsuario($login);
        //gera dados para view
        if (isset($usuario)){
            $dados['assetsUrl'] = base_url("assets");
            $dados['nome'] = $usuario->getNome();
            $dados['email'] = $usuario->getLogin();
            $dados['senha'] = $senha;
        } else{
            return "Erro ao gerar e-mail para recuperar senha, usuário não existe!";
        }
        //Carrega view
        return $this->load->view("usuario/email/mensagem-email-recuperar-senha", $dados, TRUE);
    }
    
    //enviar email
    private function envioEmail($para, $assunto, $texto, $anexo = NULL){
        try {
            //carregando biblioteca de email
            $this->load->library("email");
            //pegando configuração
            $this->load->model("email_conf_model", "configuracao");
            $config = $this->configuracao->busca("text");
            //preparando o email
            $this->email->initialize($config);
            $this->email->from($config["smtp_user"], "Sistema PIC (Recuperação de senha)");
            $this->email->to($para);
            $this->email->subject($assunto);
            $this->email->message($texto);
            $this->email->set_mailtype("html");
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
