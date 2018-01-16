<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinpad extends CI_Controller {

    /**
     * Maquina.
     * @descripition Visualização dos pinpads no PIC Pampulha
     * @author Dener Junio
     * 
     */

    /*----------------Construtor------------*/
    
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('pinpad_model', 'pinpad');
        $this->load->model('local_model', 'local');
    }
    
    
    /*-----------Carregamento de views---------*/
    
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));   
        //Carrega
        $this->load->view('pinpad/pinpad', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            //"lista" => $this->pinpad->todos(6, $this->recuperaOffset()),
            "lista" => $this->ordenarPorNome($this->pinpad->todos()),
            //"paginas" => $this->listar()));
            "paginas" => NULL));
        //Modal
        $this->load->view('pinpad/criar-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('pinpad/editar-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('pinpad/remover-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "pinpad.js"));
    }
    
    //Mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));     
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
            "arquivoJS" => "maquina.js"));
    }
    
    //Mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));     
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
            "arquivoJS" => "maquina.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "equipamento"));   
        //Carrega
        $this->load->view('pinpad/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
        $this->load->view('pinpad/criar-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('pinpad/editar-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        $this->load->view('pinpad/remover-pinpad', array(
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocais()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "pinpad.js"));
    }
    
    /*----------------Funções---------------*/
    
    //Paginação
    public function listar(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('pinpad'),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 2,
            "total_rows" => $this->pinpad->contarTodos(),
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
    
    //Criar
    public function criar(){
        try {
            $nome; $modelo; $serial; $descricao; $local; $url;
            //recupera dados
            $this->recuperaCriar($nome, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->pinpad->existe($serial)){
                //cria novo($modelo, $serial, $nome, $descricao, $local)
                $this->pinpad->novo($modelo, $serial, $nome, $descricao, $this->geraLocal($local));
                $this->pinpad->adiciona();
                //Log
                $this->gravaLog("criação pinpad", "pinpad criado: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("PinPad <strong>".$modelo."</strong> criado.", $url);
            }else{
                //Log
                $this->gravaLog("erro criação pinpad", "tentativa de criar pinpad: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O nome <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de pinpad. Tentar novamente.");
        }  
    }
    
    //Atualizar
    public function atualizar(){
        try {
            $id; $nome; $modelo; $serial; $descricao; $local; $url;
            //Recuperando dados
            $this->recuperaEditar($id, $nome, $modelo, $serial, $descricao, $local, $url);
            //verifica dados
            if (!$this->pinpad->existeAtualiza($id, $serial)){
                //atualiza  atualiza($id, $modelo, $serial, $nome, $descricao, $local)
                $this->pinpad->atualiza($id, $modelo, $serial, $nome, $descricao, $this->geraLocal($local));
                //Log
                $this->gravaLog("alteração pinpad", "pinpad alterado: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("Alteração salva.", $url);
            }else{
                //Log
                $this->gravaLog("erro alteração pinpad", "tentativa de alterar pinpad: ".$modelo." serial: ".$serial." usuario: ".$this->session->userdata("id"));
                $this->mensagem("O nome <strong>".$serial."</strong> já existe. Tente outro serial ou apague o antigo", $url);
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na alteração de pinpad. Tentar novamente.");
        }           
    }
    
    //Remove maquina
    public function remove(){ 
        try {
            $id; $url;
            $this->recuperaRemover($id, $url);
            //verifica se existe
            if ($this->pinpad->existeId($id)){
                //busca pinpad
                $pinpad = $this->pinpad->buscaId($id);
                //remove 
                $this->pinpad->remove($id);
                //Log
                $this->gravaLog("removeu pinpad", "pinpad: id:".$id." Nome: ".$pinpad->getNome()." Serial: ".$pinpad->getSerial()." Usuario: ". $this->session->userdata("id"));
                $this->mensagem("Pinpad <strong>".$pinpad->getNome()."</strong> removido.", $url);
            }else {
                //Log
                $this->gravaLog("erro remover pinpad", "tentativa de remover pinpad id: ".$id);
                $this->erro("Não existe este pinpad.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao remover pinpad. Tente novamente.");
        }
    }
    
    //Buscar maquina
    public function buscar(){
        try {
            $texto;
            //Recupera dados
            $this->recuperaBusca($texto);
            //verifica busca se vazio, caso não seja, ira para url com o seguimento 3 com o valor do campo de busca
            if (empty($texto)){
                //recupera o terceiro seguimento da url ocorrencia/buscar/XXXXXX
                $texto = urldecode(trim($this->uri->segment(3)));
            } else {
                redirect(base_url("pinpad/buscar/".urlencode($texto)));
            }
            //Bucar
            $resultado = $this->pinpad->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca por pinpad. Tente novamente.");
        }
    }
    


    /*----------------Funções AJAX---------------*/
    
    //Editar ajax
    public function editarPinpad(){
        //Recupera Id
        $id = $this->input->post("idpinpad");
        $equipamento = $this->pinpad->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idpinpad" => $equipamento->getIdpinpad(),
                "nome" => $equipamento->getNome(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Pinpad não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover ajax
    public function removerPinpad(){
        //Recupera Id
        $id = $this->input->post("idpinpad");
        $equipamento = $this->pinpad->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idpinpad" => $equipamento->getIdpinpad(),
                "nome" => $equipamento->getNome(),
                "modelo" => $equipamento->getModelo(),
                "serial" =>$equipamento->getSerial(),
                "descricao" => $equipamento->getDescricao(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Pinpad não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Verifica se existe o serial cadastrado
    public function verificaSerial(){
        $serial = trim($this->input->get_post("iptCriSerial"));
        //verifica se existe
        if (!$this->pinpad->existe($serial)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
            exit();
    }
    
    //Verifica se existe o serial cadastrado
    public function verificaSerialAtualiza(){
        $id = trim($this->input->post("id"));
        $serial = trim($this->input->post("serial"));        
        //verifica se existe
        if (!$this->pinpad->existeAtualiza($id, $serial)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
            exit();
    }
    
    /*---------------Funções internas------------*/ 
    
    //Recupera dados de criar
    private function recuperaCriar(&$nome, &$modelo, &$serial, &$descricao, &$local, &$url){
        $nome = trim($this->input->post("iptCriNome"));
        $modelo = trim($this->input->post("iptCriModelo"));
        $serial = trim($this->input->post("iptCriSerial"));
        $descricao = trim($this->input->post("iptCriDesc"));
        $local = trim($this->input->post("selCriLocal"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "pinpad";
        }
    }
    
    //Recupera dados de editar
    private function recuperaEditar(&$id, &$nome, &$modelo, &$serial, &$descricao, &$local, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $modelo = trim($this->input->post("iptEdtModelo"));
        $serial = trim($this->input->post("iptEdtSerial"));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $local = trim($this->input->post("selEdtLocal"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "pinpad";
        }
    }
    
    //Recupera dados de busca maquina
    private function recuperaBusca(&$texto){
        $texto = strtolower(trim($this->input->post("iptBusca")));
    }
    
    //Recupera dados de remover maquina
    private function recuperaRemover(&$id, &$url){
        $id = trim($this->input->post("iptRmvId"));
        $url = trim($this->input->post("iptRmvUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "pinpad";
        }
    }

    //Paginação usuariao, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(2)){
            return $this->uri->segment(2);
        } else{
            return 0;
        }
    }
    
    //busca estado
    private function geraEstado($estado){
        return $this->estado->buscaNome($estado)->getIdestado();
    }
    
    //busca local
    private function geraLocal($local){
        return $this->local->buscaLocalNome($local)->getIdlocal();
    }
    
    //busca tipo
    private function geraTipo($tipo){
        return $this->tipo->buscaTipoNome($tipo)->getIdtipo();
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
    
    //Verifica nivel de usuario para acesso ao sistema
    private function verificaNivel(){
        //verifica nivel usuario
        //verifica se tem alguem logado
        if ($this->session->has_userdata('acesso')){
            //verifica nivel de acesso
            if (unserialize($this->session->userdata('acesso'))->getEquipamento() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso sem permissao", "acesso ao controlador Pinpad.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Pinpad.php");
            redirect(base_url());
        }
    }
    
    //Ordena a lista de objetos por nome
    private function ordenarPorNome($lista){
        //verifica se lista vazia
        if (isset($lista)){
            //Ordena um array pelos valores utilizando uma função de comparação definida pelo usuário
            usort($lista, function ($a, $b){
                //Comparação de strings usando o algoritmo "natural order"
                return strnatcmp($a->getNome(), $b->getNome());
            });
            return $lista;
        } else {
            return $lista;
        }
    }
}
