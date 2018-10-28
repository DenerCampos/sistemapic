<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_checklist_admin extends CI_Controller {

    /**
     * Grupo_checklist_admin.
     * @descripition Grupo de checklist, como se fosse setor a ser checado
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Grupo_checklist_model', 'grupo');        
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
            "ativo" => "grupo"));
        //Carrega setores
        $this->load->view('admin/checklist/grupo', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "grupos" => $this->grupo->todosGruposAdmin(7, $this->recuperaOffset()),
            "paginas" => $this->listarGrupo()));
        //Modal
        $this->load->view('admin/checklist/criar-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/editar-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/remover-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/ativar-grupo', array(
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
            "ativo" => "setores"));
        //Carrega setores
        $this->load->view('admin/checklist/grupo', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/checklist/criar-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/editar-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/remover-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/ativar-grupo', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*------Requisições--------*/
    //Criar 
    public function criarGrupo(){
        //recupera dados
        $nome = trim($this->input->post("iptCriNome"));
        $estado = trim($this->input->post("selCriEstado"));
        $uri = "admin/grupo_checklist_admin";
        
        //verifica dados
        if (!$this->grupo->existe($nome)){
            //cria novo($nome, $idestado)
            $this->grupo->novo($nome, $this->geraEstado($estado));
            $this->grupo->adiciona();
            //Log
            $this->gravaLog("ADMIN criação grupo checklist", "grupo criado: ".$nome);
            $this->mensagem("Grupo <strong>".$nome."</strong> criado.", $uri);
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação grupo checklist", "tentativa de criar grupo: ".$nome);
            $this->erro("Erro ao criar o grupo de nome: <strong>".$nome."</strong>.");
        }
    }
    
    //Paginação 
    public function listarGrupo(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/grupo_checklist_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->grupo->contarTodos(),
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
    
    //Atualiza setor
    public function atualizaGrupo(){
        //recuperando dados do setor
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $estado = trim($this->input->post("selEdtEstado"));
        $uri = trim($this->input->post("iptEdtUrl"));
        
        //verifica dados
        if (!$this->grupo->verificaAtualiza($id, $nome)){ 
            //atualiza grupo atualiza($id, $nome, $idestado)
            $this->grupo->atualiza($id, $nome, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração grupo", "grupo alterado: ".$nome);
            $this->mensagem("Grupo <strong>".$nome."</strong> alterado.", $uri);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração grupo", "tentativa de alterar grupo: ".$nome);
            $this->erro("Erro ao alterar o grupo de nome: <strong>".$nome."</strong>.");
        }            
    }
    
    //remove grupo caso não tenha dependcia
    public function removeGrupo(){
        //recupera id 
        $id = trim($this->input->post("iptRmvId"));
        $uri = trim($this->input->post("iptRmvUrl"));
        
        //busca grupo
        $grupo = $this->grupo->buscaId($id);
        //verifica se existe e esta ativo
        if ($this->grupo->verificaRemover($id)){            
            //remove 
            $this->grupo->remove($id);
            //Log
            $this->gravaLog("ADMIN remover grupo", "grupo removido id: ".$id." Nome: ".$grupo->getNome());
            $this->mensagem("Grupo <strong>".$grupo->getNome()."</strong> removido.", $uri);
        }else {
            //Log
            $this->gravaLog("ADMIN erro remover grupo", "tentativa de remover grupo id: ".$id);
            $this->erro("Não pode remover o grupo de nome: <strong>".$grupo->getNome()."</strong>, ele já esta sendo usado.");
        }
    }
    
    //Ativar setor
    public function ativaGrupo(){
        //recupera id setor
        $id = trim($this->input->post("iptAtvId"));
        $uri = trim($this->input->post("iptAtvUrl"));
        
        //verifica se setor existe e esta ativo
        if ($this->grupo->verificaDesativo($id)){
            //desativa setor
            $this->grupo->ativa($id);
            //Log
            $this->gravaLog("ADMIN ativa grupo checklist", "grupo ativado id: ".$id);
            $this->mensagem("Grupo <strong>".$this->grupo->buscaId($id)->getNome()."</strong> ativado.", $uri);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar setor", "tentativa de ativar setor id: ".$id);
            $this->erro("Erro ao ativar o grupo de id: <strong>".$id."</strong>.");
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->grupo->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->grupo->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de grupos: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>: ".$exc);
        }
    }
    /*----------------Funções AJAX---------------*/
    //Editar ajax
    public function editarGrupo(){
        //Recupera Id 
        $id = $this->input->post("idgrupo");
        $grupo = $this->grupo->buscaId($id);
        
        if (isset($grupo)){
            $estado = $this->estado->buscaId($grupo->getIdestado());
            $mgs = array(
                "idgrupo" => $grupo->getIdgrupo_checklist(),
                "nome" => $grupo->getNome(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Grupo checklist não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover setor ajax
    public function removerGrupo(){
        //Recupera Id 
        $id = $this->input->post("idgrupo");
        $grupo = $this->grupo->buscaId($id);
        
        if (isset($grupo)){
            $mgs = array(
                "idgrupo" => $grupo->getIdgrupo_checklist(),
                "nome" => $grupo->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Grupo não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarGrupo(){
        //Recupera Id 
        $id = $this->input->post("idgrupo");
        $grupo = $this->grupo->buscaId($id);
        
        if (isset($grupo)){
            $mgs = array(
                "idgrupo" => $grupo->getIdgrupo_checklist(),
                "nome" => $grupo->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Grupo não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
        
    /*------Funções internas--------*/ 
    //Paginação , recupera offset
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
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Grupo_checklist_admin.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Grupo_checklist_admin.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Grupo_checklist_admin.php");
            redirect(base_url());
        }
    }
}
