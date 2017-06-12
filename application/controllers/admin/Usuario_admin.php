<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_admin extends CI_Controller {

    /**
     * Usuario_admin.
     * @descripition Controlador usuario da area de administraçao do sistema
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
        $this->load->model('estado_model', 'estado');
        $this->load->model("Area_model", "area");
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
            "ativo" => "usuarios"));
        //Carrega usuarios
        $this->load->view('admin/usuarios/usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "area" => new Area_model(),
            "usuarios" => $this->usuario->todosUsuarios(7, $this->recuperaOffset()),
            "paginas" => $this->listarUsuarios()));
        //Modal
        $this->load->view('admin/usuarios/criar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados(),
            "areas" => $this->area->todasAreas()));
        $this->load->view('admin/usuarios/editar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/remover-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/ativar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "admin"));     
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
            "arquivoJS" => "administracao.js"));
    }
    
    //Mensagem sucesso
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
            "uri" => $uri
                ));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    //resultado da busca
    public function resultado($resultados, $palavra){
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
            "ativo" => "usuarios"));
        //Carrega usuarios
        $this->load->view('admin/usuarios/usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "area" => new Area_model(),
            "palavra" => $palavra,
            "resultados" => $resultados));
        //Modal
        $this->load->view('admin/usuarios/criar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados(),
            "areas" => $this->area->todasAreas()));
        $this->load->view('admin/usuarios/editar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/remover-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/ativar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*-------------Funções---------------*/
    //Criar usuario
    public function criarUsuario(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $login = $this->input->post("iptCriEmail");
        $senha = $this->input->post("iptCriSenha");
        $rsenha = $this->input->post("iptCriRSenha");
        $nivel = $this->input->post("selCriNivel");
        $estado = $this->input->post("selCriEstado");
        //recupera area - somente tecnico
        $area = $this->input->post("selCriArea");
        
        //verifica dados
        if ($this->verificaLogin($login, $senha, $rsenha)){
            //verifica usuario tecnico
            if ($this->verificaTecnico($nivel)){
                //cria usuario tecnico
                $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));
            } else {
                //cria usuario
                $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado));                
            }
            $this->usuario->addUsuario();
            //Log
            $this->gravaLog("ADMIN criação usuario", "usuario criado: ".$nome." Email: ". $login);
            redirect(base_url('admin/usuario_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação usuario", "tentativa de criar usuario: ".$nome." Email: ". $login);
            echo'erro ao criar usuario';
        }
    }
    
    //Paginação usuario
    public function listarUsuarios(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/usuario_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->usuario->contarTodos(),
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
    
    //Atualiza usuario
    public function atualizaUsuario(){
        //recuperando dados do usuario
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $login = $this->input->post("iptEdtEmail");
        $senha = $this->input->post("iptEdtSenha");
        $rsenha = $this->input->post("iptEdtRSenha");
        $nivel = $this->input->post("selEdtNivel");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        //recupera area - somente tecnico
        $area = $this->input->post("selEdtArea");
        
        if ($senha == ""){
            $senha = NULL;
        }
        //verifica dados
        if ($this->atualizaLogin($id, $login, $senha, $rsenha)){
            //atualiza usuario
            //verifica se é tecnico
            if ($this->verificaTecnico($nivel)){
                if (isset($senha)){
                    $this->usuario->atualizaUsuario($id, $nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));            
                } else {
                    $usuario = $this->usuario->buscaId($id);
                    $this->usuario->atualizaUsuario($id, $nome, $login, $usuario->getSenha(), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));
                }
            } else {
                //Não é tecnico
                if (isset($senha)){
                    $this->usuario->atualizaUsuario($id, $nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado));            
                } else {
                    $usuario = $this->usuario->buscaId($id);
                    $this->usuario->atualizaUsuario($id, $nome, $login, $usuario->getSenha(), $this->geraNivel($nivel), $this->geraEstado($estado));
                }
            }           
            //Log
            $this->gravaLog("ADMIN alteração usuario", "usuario alterado: ".$nome." Email: ". $login);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração usuario", "tentativa de alterar usuario: ".$nome." Email: ". $login);
            echo'erro ao alterar usuario';
        }            
    }
    
    //Desabilitar usuario
    public function desabilitaUsuario(){
        //recupera id usuario
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se usuario existe e esta ativo
        if ($this->usuario->verificaAtivo($id)){
            //desativa usuario
            $this->usuario->desativaUsuario($id);
            //Log
            $this->gravaLog("ADMIN desabilita usuario", "usuario desabilitado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar usuario", "tentativa de desabilitar usuario id: ".$id);
            echo'erro ao desabilitar usuario';
        }
    }
    
    //Ativar usuario
    public function ativaUsuario(){
        //recupera id usuario
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se usuario existe e esta ativo
        if ($this->usuario->verificaDesativo($id)){
            //ativar usuario
            $this->usuario->ativaUsuario($id);
            //Log
            $this->gravaLog("ADMIN ativar usuario", "usuario ativado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar usuario", "tentativa de ativar usuario id: ".$id);
            echo'erro ao ativar usuario';
        }
    }
        
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->usuario->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->usuario->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de usuario: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar usuario ajax
    public function editarUsuario(){
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        
        if (isset($usuario)){
            $estado = $this->estado->buscaId($usuario->getIdestado());
            //verifica area de atendimento usuario
            if ($usuario->getIdarea() != NULL){
                $area = $this->area->buscaId($usuario->getIdarea())->getNome();
            }else{
                $area = "Nenhuma";
            }
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
                "nivel" =>  $this->buscaNivel($usuario->getNivel()),
                "estado" => $estado->getNome(),
                "area" => $area
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar usuario ajax
    public function ativarUsuario(){
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        
        if (isset($usuario)){
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover usuario ajax
    public function removerUsuario(){
        //Recupera Id usuario
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        
        if (isset($usuario)){
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }    
    
    /*------Funções internas--------*/      
    //Paginação usuariao, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else{
            return 0;
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
    
    //verifica nivel 
    private function geraNivel($nivel){
       
        switch ($nivel) {
            case "Administrador":
                return 0;
            case "Técnico":
                return 1;
            default:
                return 2;
        }
    }
    
    //busca nivel 
    private function buscaNivel($nivel){
       
        switch ($nivel) {
            case 0:
                return "Administrador";
            case 1:
                return "Técnico";
            default:
                return "Usuário";
        }
    }

    //busca estado
    private function geraEstado($estado){
        return $this->estado->buscaNome($estado)->getIdestado();
    }
    
    //busca area
    private function geraArea($area){
        return $this->area->buscaPorNome($area)->getIdarea();
    }
    
    //verifica se é tecnico
    private function verificaTecnico($nivel){
        if ($this->geraNivel($nivel) == 1){
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
    
    //verifica senha e email para atualizar login
    private function atualizaLogin($id, $login, $senha = NULL, $rsenha = NULL){
        //Verifica se login existe e senha
        if ($this->usuario->verificaLoginAtualiza($id, $login)){
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
    
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') != '0'){
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Usuario_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Usuario_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Usuario_adim.php");
            redirect(base_url());
        }
    }
}
