<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_maquina_admin extends CI_Controller {

    /**
     * Tipo_maquina_admin.
     * @descripition Controlador de tipos das maquinas (ex: SERVIDOR, CAIXAS, USUARIOS, IMPRESSORAS) 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('tipo_model', 'tipo');
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
            "ativo" => "tipomaquinas"));
        //Carrega usuarios
        $this->load->view('admin/tipo-maquina/tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "tipos" => $this->tipo->todosTipos(7, $this->recuperaOffset()),
            "paginas" => $this->listarLocais()));
        //Modal
        $this->load->view('admin/tipo-maquina/criar-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/editar-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/remover-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/ativar-tipos-maquina', array(
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
    public function resultado($resultado, $palavra){
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
            "ativo" => "tipomaquinas"));
        //Carrega usuarios
        $this->load->view('admin/tipo-maquina/tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/tipo-maquina/criar-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/editar-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/remover-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/tipo-maquina/ativar-tipos-maquina', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*-------------Funções---------------*/
    //Criar
    public function criarTipo(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->tipo->tipoExiste($nome)){
            //cria area
            $this->tipo->newTipo($nome, $this->geraEstado($estado));
            $this->tipo->addTipo();
            //Log
            $this->gravaLog("ADMIN criação tipo", "tipo criado: ".$nome);
            redirect(base_url('admin/tipo_maquina_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação tipo", "tentativa de criar tipo: ".$nome);
            echo'erro ao criar tipo';
        }
    }
    
    //Paginação
    public function listarLocais(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/tipo_maquina_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->tipo->contarTodos(),
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
    
    //Atualiza
    public function atualizaTipo(){
        //recuperando dados
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->tipo->verificaTipoAtualiza($id, $nome)){
            //atualiza
            $this->tipo->atualizaTipo($id, $nome, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração tipo", "tipo alterado: ".$nome);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração tipo", "tentativa de alterar tipo: ".$nome);
            echo'erro ao alterar tipo';
        }            
    }
    
    //Desabilitar 
    public function desabilitaTipo(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se existe e esta ativo
        if ($this->tipo->verificaAtivo($id)){
            //desativa 
            $this->tipo->desativaTipo($id);
            //Log
            $this->gravaLog("ADMIN desabilita tipo", "tipo desabilitado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar tipo", "tentativa de desabilitar tipo id: ".$id);
            echo'erro ao desabilitar tipo';
        }
    }
    
    //Ativar 
    public function ativaTipo(){
        //recupera id 
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se existe e esta ativo
        if ($this->tipo->verificaDesativo($id)){
            //desativa 
            $this->tipo->ativaTipo($id);
            //Log
            $this->gravaLog("ADMIN ativa tipo", "tipo ativado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar tipo", "tentativa de ativar tipo id: ".$id);
            echo'erro ao ativar tipo';
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->tipo->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->tipo->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de tipo de maquina: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar area ajax
    public function editarTipo(){
        //Recupera Id 
        $id = $this->input->post("idtipo");
        $tipo = $this->tipo->buscaId($id);
        
        if (isset($tipo)){
            $estado = $this->estado->buscaId($tipo->getIdestado());
            $mgs = array(
                "idtipo" => $tipo->getIdtipo(),
                "nome" => $tipo->getNome(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Tipo não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover area ajax
    public function removerTipo(){
        //Recupera Id 
        $id = $this->input->post("idtipo");
        $tipo = $this->tipo->buscaId($id);
        
        if (isset($tipo)){
            $mgs = array(
                "idtipo" => $tipo->getIdtipo(),
                "nome" => $tipo->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Tipo não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarTipo(){
        //Recupera Id 
        $id = $this->input->post("idtipo");
        $tipo = $this->tipo->buscaId($id);
        
        if (isset($tipo)){
            $mgs = array(
                "idtipo" => $tipo->getIdtipo(),
                "nome" => $tipo->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Tipo não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
       
    /*------Funções internas--------*/ 
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
      
//verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') != '0'){
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Tipo_maquina_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Tipo_maquina_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Tipo_maquina_adim.php");
            redirect(base_url());
        }
    }
}
