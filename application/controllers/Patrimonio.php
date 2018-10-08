<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patrimonio extends CI_Controller {

    /**
     * Patrimonio controller.
     * @descripition Mapa com todos os patrimonio do PIC
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //Carrega modelo
        $this->load->model("Patrimonio_model", "patrimonio");
        $this->load->model("Local_model", "local");
        $this->load->model("Manutencao_model", "manutencao");
        $this->load->model("Unidade_model", "unidade");
        $this->load->model("Setor_model", "setor");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "patrimonio"));      
        //Carrega index
        $this->load->view('patrimonio/patrimonio', array(
            "assetsUrl" => base_url("assets"),
            "patrimonio" => $this->patrimonio->todos(),
            "locais" => $this->local->todosLocaisPatrimonio(),
            "manutencao" => new Manutencao_model()));
        //Modal
        $this->load->view("patrimonio/criar-patrimonio", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisPatrimonio()));
        $this->load->view("patrimonio/editar-patrimonio", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisPatrimonio()));
        $this->load->view("patrimonio/remover-patrimonio", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("patrimonio/visualizar-manutencao", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "patrimonio.js"));
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
        $this->load->view("patrimonio/criar-patrimonio", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "patrimonio.js"));
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
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "patrimonio.js"));
    }
    
    //Resultado da busca
    public function resultado($resultado, $texto){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "patrimonio"));   
        //Carrega
        $this->load->view('patrimonio/resultado', array(
            "assetsUrl" => base_url("assets"),
            "local" => new Local_model(),
            "palavra" => $texto,
            "total" => count($resultado),
            "lista" => $resultado));
        //Modal
        $this->load->view("patrimonio/criar-patrimonio", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisPatrimonio()));
        $this->load->view("patrimonio/editar-patrimonio", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisPatrimonio()));
        $this->load->view("patrimonio/remover-patrimonio", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("patrimonio/visualizar-manutencao", array( 
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "patrimonio.js"));
    }
    
    /*------------------Funções------------------*/   
    //Criar 
    public function criar(){
        //dados
        $equipamento; $serie; $modelo; $descricao; $patrimonio; $fornecedor; $local; $url;
        try {
            //recupera dados post
            $this->recuperaCriar($equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $local, $url);
            //verifica se existe patrimonio
            if (!$this->patrimonio->existePatrimonio($patrimonio)){
                //cria novo novo($equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $idlocal)
                $this->patrimonio->novo($equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $local);
                $this->patrimonio->adiciona();
                //log
                $this->gravaLog("criação patrimonio", "equipamento criado: ".$equipamento." patrimonio: ". $patrimonio);
                //msg
                $this->mensagem("Equipamento <strong>".$equipamento."</strong> criado com sucesso.", $url);
            }else{
                //Log
                $this->gravaLog("erro criação patrimonio", "tentativa de criar patrimonio: ".$equipamento." patrimonio: ". $patrimonio);
                $this->erro("O nome <strong>".$equipamento."</strong> já existe. Tente outro nome ou apague o antigo");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na criação de patrimonio. Tentar novamente.");
        }
    }
    
    //Atualizar (Editar)
    public function editar(){
        //dados
        $id; $equipamento; $serie; $modelo; $descricao; $patrimonio; $fornecedor; $local; $url;
        try {
            //recupera dados post
            $this->recuperaEditar($id, $equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $local, $url);
            //verifica se existe patrimonio
            if ($this->patrimonio->existeId($id)){
                //verifica se existe outro com o mesmo patrimonio verificaAtualiza($id, $patrimonio)
                if (!$this->patrimonio->verificaAtualiza($id, $patrimonio)){
                    //Atualiza atualiza($id, $equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $idlocal)
                    $this->patrimonio->atualiza($id, $equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $local);
                    //log
                    $this->gravaLog("edita patrimonio", "equipamento editado: ".$equipamento." patrimonio: ". $patrimonio);
                    //msg
                    $this->mensagem("Equipamento <strong>".$equipamento."</strong> atualizado com sucesso.", $url);
                } else{
                    //Log
                    $this->gravaLog("erro editar patrimonio", "tentativa de editar patrimonio: ".$equipamento." patrimonio: ". $patrimonio);
                    $this->erro("O equipamento <strong>".$patrimonio."</strong> já existe. Tente outro nome ou apague o antigo");
                }
            }else{
                //Log
                $this->gravaLog("erro editar patrimonio", "tentativa de editar patrimonio: ".$equipamento." patrimonio: ". $patrimonio);
                $this->erro("O equipamento <strong>".$equipamento."</strong> não existe");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na atualizaçao de patrimonio. Tentar novamente.");
        }
    }
    
    //Remover 
    public function remover(){
        //dados
        $id; $url;
        try {
            //recupera dados post
            $this->recuperaRemover($id, $url);
            //verifica se existe
            if ($this->patrimonio->existeId($id)){
                //busca 
                $equipamento = $this->patrimonio->buscaId($id);
                //remover
                $this->patrimonio->remove($id);
                //log
                $this->gravaLog("remocao patrimonio", "equipamento: ".$equipamento->getEquipamento()." patrimonio: ". $equipamento->getPatrimonio());
                //msg
                $this->mensagem("Equipamento <strong>".$equipamento->getEquipamento()."</strong> excluido com sucesso.", $url);
            }else{
                //Log
                $this->gravaLog("erro remocao patrimonio", "tentativa de remocao patrimonio com id invalido: ".$id);
                $this->erro("Este equipamento não existe.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na remoção de patrimonio. Tentar novamente.");
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
                redirect(base_url("patrimonio/buscar/".urlencode($texto)));
            }
            //Bucar
            $resultado = $this->patrimonio->busca($texto);
            $this->resultado($resultado, $texto);
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca por pinpad. Tente novamente.");
        }
    }

    
    /*----------------Funções AJAX---------------*/
    //Verifica se existe o patrimonio cadastrado
    public function verificaPatrimonio(){
        $numero = trim($this->input->get_post("iptCriPatrimonio"));
        //verifica se existe
        if (!$this->patrimonio->existePatrimonio($numero)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
        }
        exit();
    }
    
    //Verifica se existe o patrimonio na edição
    public function verificaEditaPatrimonio(){
        $numero = trim($this->input->get_post("patrimonio"));
        $id = trim($this->input->get_post("id"));
        
        //verifica se existe
        if (!$this->patrimonio->verificaAtualiza($id, $numero)){
            echo json_encode(TRUE); //não exite
        }else {
            echo json_encode(FALSE); //existe
            }        
        exit();
    }
    
    //Remover ajax
    public function removerPatrimonio(){
        //Recupera Id
        $id = trim($this->input->post("idpatrimonio"));
        $equipamento = $this->patrimonio->buscaId($id);
        
        if (isset($equipamento)){
            $mgs = array(
                "idpatrimonio" => $equipamento->getIdpatrimonio(),
                "equipamento" => $equipamento->getEquipamento(),
                "patrimonio" => $equipamento->getPatrimonio()
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
    
    //Editar ajax
    public function editarPatrimonio(){
        //Recupera Id
        $id = trim($this->input->post("idpatrimonio"));
        $equipamento = $this->patrimonio->buscaId($id);
        
        if (isset($equipamento)){
            $local = $this->local->buscaId($equipamento->getIdlocal());
            $mgs = array(
                "idpatrimonio" => $equipamento->getIdpatrimonio(),
                "equipamento" => $equipamento->getEquipamento(),
                "patrimonio" => $equipamento->getPatrimonio(),
                "serial" =>$equipamento->getSerie(),
                "descricao" => $equipamento->getDescricao(),
                "modelo" => $equipamento->getModelo(),
                "fornecedor" => $equipamento->getFornecedor(),
                "local" => $local->getNome()
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
    
    //Editar ajax
    public function visualizarManutencao(){
        //Recupera Id manutencao
        $id = $this->input->post("idmanutencao");
        $manutencao = $this->manutencao->buscaId($id);
        
        if (isset($manutencao)){
            $unidade = $this->unidade->buscaId($manutencao->getIdunidade());
            $setor = $this->setor->buscaId($manutencao->getIdsetor());
            $mgs = array(
                "idmanutencao" => $manutencao->getIdmanutencao(),
                "equipamento" => $manutencao->getEquipamento(),
                "defeito" => $manutencao->getDefeito(),
                "data" => date("Y-m-d", strtotime($manutencao->getData_defeito())),
                "patrimonio" => $manutencao->getPatrimonio(),
                "descricao" => $manutencao->getDescricao(),
                "fornecedor" => $manutencao->getFornecedor(),
                "unidade" => $unidade->getNome(),
                "setor" => $setor->getNome(),
                "motivo" => $manutencao->getMotivo(),
                "solucao" => $manutencao->getSolucao()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Manutencao não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    /*------------Funções internas---------------*/     
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
            if (unserialize($this->session->userdata('acesso'))->getPatrimonio() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("acesso negado", "acesso ao controlador Patrimonio.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Patrimonio.php");
            redirect(base_url());
        }
    }
    
    //Gera id local da maquina
    private function geraIdLocal($nome){
        $id = $this->local->buscaLocalNome($nome)->getIdlocal();        
        if (!isset($id) || empty($id)){
            $id = 1;
        }
        return $id;
    }


    //recupera dados post CRIAR
    private function recuperaCriar(&$equipamento, &$serie, &$modelo, &$descricao, &$patrimonio, &$fornecedor, &$local, &$url){
        $equipamento = trim($this->input->post("iptCriEquipamento"));
        $serie = trim($this->input->post("iptCriSerial"));
        $modelo = trim($this->input->post("iptCriModelo"));
        $descricao = trim($this->input->post("iptCriDesc"));
        $patrimonio = trim($this->input->post("iptCriPatrimonio"));
        $fornecedor = trim($this->input->post("iptCriFornecedor"));
        $local = trim($this->input->post("selCriLocal"));
        $url = trim($this->input->post("iptCriUrl"));
        
        //url
        if (!isset($url) || empty($url)){
            $url = "patrimonio";
        }
        //local id
        $local = $this->geraIdLocal($local);
    }
    
    //recupera dados post EDITAR
    private function recuperaEditar(&$id, &$equipamento, &$serie, &$modelo, &$descricao, &$patrimonio, &$fornecedor, &$local, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $equipamento = trim($this->input->post("iptEdtEquipamento"));
        $serie = trim($this->input->post("iptEdtSerial"));
        $modelo = trim($this->input->post("iptEdtModelo"));
        $descricao = trim($this->input->post("iptEdtDesc"));
        $patrimonio = trim($this->input->post("iptEdtPatrimonio"));
        $fornecedor = trim($this->input->post("iptEdtFornecedor"));
        $local = trim($this->input->post("selEdtLocal"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        //url
        if (!isset($url) || empty($url)){
            $url = "patrimonio";
        }
        //local id
        $local = $this->geraIdLocal($local);
    }
    
    //recupera dados post REMOVER
    private function recuperaRemover(&$id, &$url){
        $id = trim($this->input->post("iptRmvId"));
        $url = trim($this->input->post("iptRmvUrl"));
        
        //url
        if (!isset($url) || empty($url)){
            $url = "patrimonio";
        }
    }
    
    //Recupera dados post BUSCAR
    private function recuperaBusca(&$texto){
        $texto = strtolower(trim($this->input->post("iptBusca")));
    }
}
