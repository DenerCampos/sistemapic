<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ocorrencia_estado_admin extends CI_Controller {

    /**
     * Ocorrencia_estado_admin
     * @descripition Controlador dos estados das ocorrencias do pic (EX: em aberto, em atendimento e fechado)
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Ocorrencia_estado_model', 'estado');
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
            "ativo" => "estado ocorrencia"));
        //Carrega estadoes
        $this->load->view('admin/ocorrencia/ocorrencia', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados(7, $this->recuperaOffset()),
            "paginas" => $this->listarEstados()));
        //Modal
        $this->load->view('admin/ocorrencia/criar-ocorrencia', array(
            "assetsUrl" => base_url("assets")));
        $this->load->view('admin/ocorrencia/editar-ocorrencia', array(
            "assetsUrl" => base_url("assets")));
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
            "ativo" => "estado ocorrencia"));
        //Carrega estadoes
        $this->load->view('admin/ocorrencia/ocorrencia', array(
            "assetsUrl" => base_url("assets"),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/ocorrencia/criar-ocorrencia', array(
            "assetsUrl" => base_url("assets")));
        $this->load->view('admin/ocorrencia/editar-ocorrencia', array(
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*-------------Funções---------------*/
    //Criar
    public function criarEstado(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $descricao = $this->input->post("iptCriDesc");
        
        //verifica dados
        if (!$this->estado->estadoExiste($nome)){
            //cria
            $this->estado->newEstado($nome, $descricao);
            $this->estado->addEstado();
            //Log
            $this->gravaLog("ADMIN criação estado de ocorrencia", "estado criado: ".$nome);
            redirect(base_url('admin/ocorrencia_estado_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação de estado de ococrrencia", "tentativa de criar estado: ".$nome);
            echo'erro ao criar estado de ocorrencia';
        }
    }
    
    //Paginação usuario
    public function listarEstados(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/ocorrencia_estado_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->estado->contarTodos(),
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
    
    //Atualiza estado
    public function atualizaEstado(){
        //recuperando dados do estado
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $descricao = $this->input->post("iptEdtDesc");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->estado->verificaEstadoAtualiza($id, $nome)){
            //atualiza estado
            $this->estado->atualizaEstado($id, $nome, $descricao);
            //Log
            $this->gravaLog("ADMIN alteração estado de ocorrencia", "estado alterado: ".$nome);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração estado de ocorrencia", "tentativa de alterar estado: ".$nome);
            echo'erro ao alterar estado';
        }            
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->estado->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->estado->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de estado de ocorrencia: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar estado ajax
    public function editarEstado(){
        //Recupera Id estado
        $id = $this->input->post("idestado");
        $estado = $this->estado->buscaId($id);
        
        if (isset($estado)){
            $mgs = array(
                "idestado" => $estado->getIdocorrencia_estado(),
                "nome" => $estado->getNome(),
                "descricao" => $estado->getDescricao()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Estado de ocorrencia não encontrado"
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Ocorrencia_estado_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Ocorrencia_estado_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Ocorrencia_estado_adim.php");
            redirect(base_url());
        }
    }
}
