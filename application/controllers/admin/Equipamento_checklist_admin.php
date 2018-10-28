<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamento_checklist_admin extends CI_Controller {

    /**
     * Equipamento_checklist_admin.
     * @descripition Equipamentos a serem estados no checklist que pertence a algum grupo
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Equipamento_checklist_model', 'equipamento');   
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
            "ativo" => "equipamento"));
        //Carrega equipamento
        $this->load->view('admin/checklist/equipamento', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "grupo" => new Grupo_checklist_model(),
            "lista" => $this->equipamento->todosEquipamentoAdmin(7, $this->recuperaOffset()),
            "paginas" => $this->listarEquipamento()));
        //Modal
        $this->load->view('admin/checklist/criar-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "grupo" => $this->grupo->todosGrupos(),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/editar-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "grupo" => $this->grupo->todosGrupos(),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/remover-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/ativar-equipamento', array(
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
            "ativo" => "equipamento"));
        //Carrega equipamento
        $this->load->view('admin/checklist/equipamento', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "grupo" => new Grupo_checklist_model(),
            "palavra" => $palavra,
            "resultados" => $resultado));
        //Modal
        $this->load->view('admin/checklist/criar-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "grupo" => $this->grupo->todosGrupos(),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/editar-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "grupo" => $this->grupo->todosGrupos(),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/remover-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/checklist/ativar-equipamento', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*------Requisições--------*/
    //Criar 
    public function criarEquipamento(){
        //recupera dados
        //aqui
        $nome = trim($this->input->post("iptCriNome"));
        $estado = trim($this->input->post("selCriEstado"));
        $grupo = trim($this->input->post("selCriGrupo"));
        $uri = "admin/equipamento_checklist_admin";
        
        //verifica dados
        if (!$this->equipamento->existe($nome)){
            //cria novo($nome, $idgrupo_checklist, $idestado)
            $this->equipamento->novo($nome, $this->geraGrupo($grupo), $this->geraEstado($estado));
            $this->equipamento->adiciona();
            //Log
            $this->gravaLog("ADMIN criação equipamento checklist", "equipamento criado: ".$nome);
            $this->mensagem("Equipamento <strong>".$nome."</strong> criado.", $uri);
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação equipamento checklist", "tentativa de criar equipamento: ".$nome);
            $this->erro("Erro ao criar o equipamento de nome: <strong>".$nome."</strong>.");
        }
    }
    
    //Paginação 
    public function listarEquipamento(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/equipamento_checklist_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->equipamento->contarTodos(),
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
    public function atualizaEquipamento(){
        //recuperando dados do setor
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $estado = trim($this->input->post("selEdtEstado"));
        $grupo = trim($this->input->post("selEdtGrupo"));
        $uri = trim($this->input->post("iptEdtUrl"));
        
        //verifica dados
        if (!$this->equipamento->verificaAtualiza($id, $nome)){ 
            //atualiza atualiza($id, $nome, $idgrupo_checklist, $idestado)
            $this->equipamento->atualiza($id, $nome, $this->geraGrupo($grupo), $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração equipamento", "equipamento alterado: ".$nome);
            $this->mensagem("Grupo <strong>".$nome."</strong> alterado.", $uri);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração equipamento", "tentativa de alterar equipamento: ".$nome);
            $this->erro("Erro ao alterar o equipamento de nome: <strong>".$nome."</strong>.");
        }            
    }
    
    //remove grupo caso não tenha dependcia
    public function removeEquipamento(){
        //recupera id setor
        $id = trim($this->input->post("iptRmvId"));
        $uri = trim($this->input->post("iptRmvUrl"));
        
        //busca grupo
        $grupo = $this->equipamento->buscaId($id);        
        //verifica se pode ser removido
        if ($this->equipamento->verificaRemover($id)){            
            //remove 
            $this->equipamento->remove($id);
            //Log
            $this->gravaLog("ADMIN remover equipamento", "equipamento removido id: ".$id." Nome: ".$grupo->getNome());
            $this->mensagem("Equipamento <strong>".$grupo->getNome()."</strong> removido.", $uri);
        }else {
            //Log
            $this->gravaLog("ADMIN erro remover equipamento", "tentativa de remover equipamento id: ".$id);
            $this->erro("Não pode remover o equipamento de nome: <strong>".$grupo->getNome()."</strong>, ele já esta sendo usado.");
        }
    }
    
    //Ativar setor
    public function ativaEquipamento(){
        //recupera id setor
        $id = trim($this->input->post("iptAtvId"));
        $uri = trim($this->input->post("iptAtvUrl"));
        
        //verifica se existe e esta ativo
        if ($this->equipamento->verificaDesativo($id)){
            //desativa 
            $this->equipamento->ativa($id);
            //Log
            $this->gravaLog("ADMIN ativa equipamento checklist", "equipamento ativado id: ".$id);
            $this->mensagem("Equipamento <strong>".$this->equipamento->buscaId($id)->getNome()."</strong> ativado.", $uri);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar equipamento", "tentativa de ativar equipamento id: ".$id);
            $this->erro("Erro ao ativar o equipamento de id: <strong>".$id."</strong>.");
        }
    }
    
    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->equipamento->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->equipamento->busca($texto, 100), $texto);
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
    public function editarEquipamento(){
        //Recupera Id 
        $id = $this->input->post("idequipamento");
        $equipamento = $this->equipamento->buscaId($id);
        
        if (isset($equipamento)){
            $estado = $this->estado->buscaId($equipamento->getIdestado());
            $grupo = $this->grupo->buscaId($equipamento->getIdgrupo_checklist());
            $mgs = array(
                "idequipamento" => $equipamento->getIdequipamento_checklist(),
                "nome" => $equipamento->getNome(),
                "grupo" => $grupo->getNome(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Equipamento checklist não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover setor ajax
    public function removerEquipamento(){
        //Recupera Id 
        $id = $this->input->post("idequipamento");
        $equipamento = $this->equipamento->buscaId($id);
        
        if (isset($equipamento)){
            $mgs = array(
                "idequipamento" => $equipamento->getIdequipamento_checklist(),
                "nome" => $equipamento->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Equipamento não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarEquipamento(){
       //Recupera Id 
        $id = $this->input->post("idequipamento");
        $equipamento = $this->equipamento->buscaId($id);
        
        if (isset($equipamento)){
            $mgs = array(
                "idequipamento" => $equipamento->getIdequipamento_checklist(),
                "nome" => $equipamento->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Equipamento não encontrado"
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
    
    //busca estado
    private function geraGrupo($grupo){
        return $this->grupo->buscaNome($grupo)->getIdgrupo_checklist();
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
