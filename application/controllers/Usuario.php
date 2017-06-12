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
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Usuario_model', 'usuario');
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        redirect(base_url());
    }
    
    //Editar Perfil
    public function editar(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
       //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => ""));      
        //Carrega edição de perfil
        $this->load->view('usuario/editar-usuario', array(
            "assetsUrl" => base_url("assets")));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "usuario.js"));
    }


    //Mensagem de erro
    public function erro($msg = NULL, $uri = null){
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
            "msgerro" => $msg,
            "uri" => $uri));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "usuario.js"));
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
        ///Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "usuario.js"));
    }
    
    /*------Funções internas--------*/ 
    //Criar usuario
    public function criar(){
        //recupera dados
        $nome = trim($this->input->post("iptCriNome"));
        $login = trim($this->input->post("iptCriEmail"));
        $senha = trim($this->input->post("iptCriSenha"));
        $rsenha = trim($this->input->post("iptCriRSenha"));
        
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
    
    //Atualiza usuario
    public function atualizaUsuario(){
        $nome; $email; $senha_anterior; $senha_nova; $senha_repete; $foto;
        //recupera dados
        $this->recuperaAtualizaUsuario($nome, $email, $senha_anterior, $senha_nova, $senha_repete, $foto);
        try {
            //verifica se altera senha
            if (($senha_anterior !== "") && ($senha_nova !== "")){
                //verifica senha antiga com o bd
                if ($this->verificaSenha($senha_anterior, $this->usuario->buscaId($this->session->userdata("id"))->getSenha())){
                    //verifica se login existe e senha é valido
                    if ($this->verificaLoginAtualiza($email, $senha_nova, $senha_repete)){
                        //salva dados atualizaUsuarioPerfil($id, $nome, $login, $senha = NULL)
                        $this->usuario->atualizaUsuarioPerfil($this->session->userdata('id'), $nome, $email, $this->geraSenha($senha_nova));
                        $this->salvaImagemPerfil();
                        //carrega nova sessão
                        $this->refazSessao($this->usuario->buscaId($this->session->userdata('id')));
                        //Log
                        $this->gravaLog("edição usuario", "usuario editado: ".$nome." Email: ".$email);
                        //mensagem
                        $this->mensagem("Usuário alterado com sucesso!", 'home');
                    }else {
                        //login ou senha invalidas
                        //mensagem
                        $this->erro("Login ou senha invalida(s).", 'usuario/editar');
                    }
                } else {
                    //senha antiga invalida
                    //Log
                    $this->gravaLog("erro edição usuario", "usuario editado: ".$nome." Email: ".$email);
                    //mensagem
                    $this->erro("Senha atual invalida.", base_url('usuario/editar'));
                }
            } else {
                //não atualiza senhas
                //verifica se login existe e senha é valido
                if ($this->verificaLoginAtualiza($email)){                    
                    //salva dados atualizaUsuarioPerfil($id, $nome, $login, $senha = NULL)
                    $this->usuario->atualizaUsuarioPerfil($this->session->userdata('id'), $nome, $email);
                    $this->salvaImagemPerfil();
                    //carrega nova sessão
                    $this->refazSessao($this->usuario->buscaId($this->session->userdata('id')));
                    //Log
                    $this->gravaLog("edição usuario", "usuario editado: ".$nome." Email: ".$email);
                    //mensagem
                    $this->mensagem("Usuário alterado com sucesso!", 'home');
                } else {
                    //login  invalidas
                    //Log
                    $this->gravaLog("erro edição usuario", "usuario editado: ".$nome." Email: ".$email);
                    //mensagem
                    $this->erro("Login invalido.", 'usuario/editar');
                }
            }
            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }

    //recupera dados do atualiza usuarios
    private function recuperaAtualizaUsuario(&$nome, &$email, &$senha_anterior, &$senha_nova, &$senha_repete, &$foto){
        $nome = trim($this->input->post("iptEdtNome"));
        $email = trim($this->input->post("iptEdtEmail"));
        $senha_anterior = trim($this->input->post("iptEdtSenhaAtual"));
        $senha_nova = trim($this->input->post("iptEdtSenha"));
        $senha_repete = trim($this->input->post("iptEdtRSenha"));
        $foto = $_FILES["iptEdtFoto"];
    }
    
    //salvar imagem do perfil
    private function salvaImagemPerfil(){
        if ($_FILES['iptEdtFoto']['error'] == 0){
            //inicia biblioteca do codeigniter
            $this->load->library('upload');
            //configuração
            $config = array(
                'upload_path' => './document/user/',
                'allowed_types' => 'gif|jpg|png',
                'file_name' => $this->session->userdata("id")
            );
            //inicializa
            $this->upload->initialize($config);
            //verifica se ja tem foto o perfil
            $this->verificaFotoPerfil();
            //salvar e verifica erro
            if ($this->upload->do_upload('iptEdtFoto')){
                return TRUE;
            } else {
                //Log erro foto
                $this->gravaLog("erro foto perfil", "usuario: ".$this->session->userdata("id")."Erro: ".$this->upload->display_errors());
                return FALSE;
            }
        }
        //não houve troca de arquivo
        return TRUE;
    }
    
    //verifica se já tem imagem salva no perfil
    private function verificaFotoPerfil(){
        //extensões permitidas
        $ext = array ('gif', 'jpg', 'png');
        //caminho
        $caminho = "./document/user/";
        //verifica se existe o arquivo
        foreach ($ext as $value) {
            if (file_exists($caminho.$this->session->userdata('id').".".$value)){
                //deleta arquivo
                unlink($caminho.$this->session->userdata('id').".".$value);
                break;
            }
        }
    }
    
    //Refaz sessão
    private function refazSessao($usuario){
        try {
            //dados da sessão
            $dados = array(
                "id" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
                "nivel" => $usuario->getNivel(),
                "area" => $usuario->getIdarea(),
                "foto" => $this->caminhoFoto($usuario)
            );
            //cria sessão
            $this->session->set_userdata($dados);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    //busca caminho da foto perfil
    private function caminhoFoto(&$usuario){
        //extensões permitidas
        $ext = array ('gif', 'jpg', 'png');
        //caminho
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
    
    //verificação de login e senha
    private function verificaLoginAtualiza($login, $senha = NULL, $rsenha = NULL){
        //Verifica se login existe e senha        
        if ($this->usuario->verificaLoginAtualiza($this->session->userdata('id'), $login)){
            return FALSE;
        } elseif (isset ($senha) && isset ($rsenha)){
            if ($senha != $rsenha) {
                return FALSE;
            }else{
                return TRUE;
            }
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
    
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') == '3'){
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Usuario.php");
                redirect(base_url());
            } else {
                //acesso permitido
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Caixa.php");
            redirect(base_url());
        }
    }    
}
