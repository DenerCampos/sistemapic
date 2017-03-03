<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_admin extends CI_Controller {

    /**
     * Area_admin.
     * @descripition Controlador area de atendimentos da area de administraçao do sistema (EX: ti-pp, eletrica)
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Area_model', 'area');
        $this->load->model('Estado_model', 'estado');
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
            "ativo" => "areas"));
        //Carrega usuarios
        $this->load->view('admin/areas/areas', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "areas" => $this->area->todasAreas(7, $this->recuperaOffset()),
            "paginas" => $this->listarAreas()));
        //Modal
        $this->load->view('admin/areas/criar-areas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/areas/editar-areas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/areas/remover-areas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/areas/ativar-areas', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    /*------Funções internas--------*/ 
    //Criar usuario
    public function criarArea(){
        //recupera dados
        $nome = $this->input->post("iptCriNome");
        $email = $this->input->post("iptCriEmail");
        $estado = $this->input->post("selCriEstado");
        
        //verifica dados
        if (!$this->area->areaExiste($nome)){
            //cria area
            $this->area->newArea($nome, $email, $this->geraEstado($estado));
            $this->area->addArea();
            //Log
            $this->gravaLog("ADMIN criação area", "area criada: ".$nome." Email: ". $email);
            redirect(base_url('admin/area_admin'));
        }else{
            //Log
            $this->gravaLog("ADMIN erro criação area", "tentativa de criar area: ".$nome." Email: ". $email);
            echo'erro ao criar area';
        }
    }
    
    //Paginação usuario
    public function listarAreas(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/area_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->area->contarTodos(),
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
      
    //Editar area ajax
    public function editarArea(){
        //Recupera Id area
        $id = $this->input->post("idarea");
        $area = $this->area->buscaId($id);
        
        if (isset($area)){
            $estado = $this->estado->buscaId($area->getIdestado());
            $mgs = array(
                "idarea" => $area->getIdarea(),
                "nome" => $area->getNome(),
                "email" => $area->getEmail(),
                "estado" => $estado->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Área não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover area ajax
    public function removerArea(){
        //Recupera Id area
        $id = $this->input->post("idarea");
        $area = $this->area->buscaId($id);
        
        if (isset($area)){
            $estado = $this->estado->buscaId($area->getIdestado());
            $mgs = array(
                "idarea" => $area->getIdarea(),
                "nome" => $area->getNome(),
                "email" => $area->getEmail(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Área não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar area ajax
    public function ativarArea(){
        //Recupera Id area
        $id = $this->input->post("idarea");
        $area = $this->area->buscaId($id);
        
        if (isset($area)){
            $estado = $this->estado->buscaId($area->getIdestado());
            $mgs = array(
                "idarea" => $area->getIdarea(),
                "nome" => $area->getNome(),
                "email" => $area->getEmail(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Área não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Atualiza 
    public function atualizaArea(){
        //recuperando dados da area
        $id = $this->input->post("iptEdtId");
        $nome = $this->input->post("iptEdtNome");
        $email = $this->input->post("iptEdtEmail");
        $estado = $this->input->post("selEdtEstado");
        $url = $this->input->post("iptEdtUrl");
        
        //verifica dados
        if (!$this->area->verificaAreaAtualiza($id, $nome)){
            //atualiza area
            $this->area->atualizaArea($id, $nome, $email, $this->geraEstado($estado));
            //Log
            $this->gravaLog("ADMIN alteração area", "area alterada: ".$nome." Email: ". $email);
            redirect($url);
        }else{
            //Log
            $this->gravaLog("ADMIN erro alteração area", "tentativa de alterar area: ".$nome." Email: ". $email);
            echo'erro ao alterar area';
        }            
    }
    
    //Desabilitar 
    public function desabilitaArea(){
        //recupera id 
        $id = $this->input->post("iptRmvId");
        $url = $this->input->post("iptRmvUrl");
        
        //verifica se  existe e esta ativo
        if ($this->area->verificaAtivo($id)){
            //desativa 
            $this->area->desativaArea($id);
            //Log
            $this->gravaLog("ADMIN desabilita area", "area desabilitada id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro desabilitar area", "tentativa de desabilitar area id: ".$id);
            echo'erro ao desabilitar area';
        }
    }
    
    //Ativar 
    public function ativaArea(){
        //recupera id 
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica se  existe e esta ativo
        if ($this->area->verificaDesativo($id)){
            //desativa 
            $this->area->ativaArea($id);
            //Log
            $this->gravaLog("ADMIN ativa area", "area ativada id: ".$id);
            redirect($url);
        }else {
            //Log
            $this->gravaLog("ADMIN erro ativar area", "tentativa de ativar area id: ".$id);
            echo'erro ao ativar area';
        }
    }
    
    //verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('nivel')){
            //verifica nivel de acesso
            if ($this->session->userdata('nivel') != '0'){
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Area_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Area_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Area_adim.php");
            redirect(base_url());
        }
    }
}
