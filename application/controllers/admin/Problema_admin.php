<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problema_admin extends CI_Controller {

    /**
     * Problema_admin.
     * @descripition Controlador problemas da area de administraçao do sistema (EX: impressora, rede)
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Problema_model', 'problema');
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
            "ativo" => "problemas"));
        //Carrega usuarios
        $this->load->view('admin/problemas/problemas', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "problemas" => $this->problema->todosProblemas(7, $this->recuperaOffset()),
            "paginas" => $this->listarProblemas()));
        //Modal
        $this->load->view('admin/problemas/criar-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/editar-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/remover-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/ativar-problemas', array(
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
    
    //Busca
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
            "ativo" => "problemas"));
        //Carrega usuarios
        $this->load->view('admin/problemas/problemas', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/problemas/criar-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/editar-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/remover-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/problemas/ativar-problemas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*------Funções--------*/
    //Criar usuario
    public function criarProblema(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $descricao = $this->input->post("iptCriDesc");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->problema->problemaExiste($nome)){
            //cria problema
            $this->problema->newProblema($nome, $descricao, $this->geraEstado($estado));
            $this->problema->addProblema();
            //Log
            $this->gravaLog("ADMIN criação problema", "problema criado: ".$nome." Descrição: ". $descricao);
            redirect(base_url('admin/problema_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação problema", "tentativa de criar problema: ".$nome." Descrição: ". $descricao);
            echo'erro ao criar problema';
        }
    }
    
    //Paginação usuario
    public function listarProblemas(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/problema_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->problema->contarTodos(),
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
    
    //Atualiza problema
    public function atualizaProblema(){
        //recuperando dados do problema
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $descricao = $this->input->post("iptEdtDesc");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->problema->verificaProblemaAtualiza($id, $nome)){
            //atualiza 
            $this->problema->atualizaProblema($id, $nome, $descricao, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração problema", "problema alterado: ".$nome." Descrição: ". $descricao);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração problema", "tentativa de alterar problema: ".$nome." Descrição: ". $descricao);
            echo'erro ao alterar problema';
        }            
    }
    
    //Desabilitar problema
    public function desabilitaProblema(){
        //recupera id
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se existe e esta ativo
        if ($this->problema->verificaAtivo($id)){
            //desativa 
            $this->problema->desativaProblema($id);
            //Log
            $this->gravaLog("ADMIN desabilita problema", "problema desabilitado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar problema", "tentativa de desabilitar problema id: ".$id);
            echo'erro ao desabilitar problema';
        }
    }
    
    //Ativar problema
    public function ativaProblema(){
        //recupera id 
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se existe e esta ativo
        if ($this->problema->verificaDesativo($id)){
            //desativa
            $this->problema->ativaProblema($id);
            //Log
            $this->gravaLog("ADMIN ativa problema", "problema ativado id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar problema", "tentativa de ativar problema id: ".$id);
            echo'erro ao ativar problema';
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->problema->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->problema->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de problema: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar ajax
    public function editarProblema(){
        //Recupera Id problema
        $id = $this->input->post("idproblema");
        $problema = $this->problema->buscaId($id);
        
        if (isset($problema)){
            $estado = $this->estado->buscaId($problema->getIdestado());
            $mgs = array(
                "idproblema" => $problema->getIdproblema(),
                "nome" => $problema->getNome(),
                "descricao" => $problema->getDescricao(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Problema não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerProblema(){
        //Recupera Id problema
        $id = $this->input->post("idproblema");
        $problema = $this->problema->buscaId($id);
        
        if (isset($problema)){
            $mgs = array(
                "idproblema" => $problema->getIdproblema(),
                "nome" => $problema->getNome(),
                "descricao" => $problema->getDescricao()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Problema não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar  ajax
    public function ativarProblema(){
        //Recupera Id problema
        $id = $this->input->post("idproblema");
        $problema = $this->problema->buscaId($id);
        
        if (isset($problema)){
            $mgs = array(
                "idproblema" => $problema->getIdproblema(),
                "nome" => $problema->getNome(),
                "descricao" => $problema->getDescricao()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Problema não encontrada"
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Problema_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Problema_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Problema_adim.php");
            redirect(base_url());
        }
    }
}
