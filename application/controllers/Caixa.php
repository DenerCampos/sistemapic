<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caixa extends CI_Controller {

    /**
     * Caixa: Controller para operações dos ips do caixas e mapas dos caixas
     *
     * @author Dener Junio
     * mapa dos caixas
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //Carrega modelo
        $this->load->model("Maquina_model", "maquina");
        $this->load->model("Local_model", "local");
    }
    
    
    /*-----------Carregamento de views---------*/
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "caixa")); 
        //Carrega index
        $this->load->view('caixa/maps', array(
            "assetsUrl" => base_url("assets"),
            "maquinas" => $this->maquina->buscaCaixas(),
            "locais" => $this->local->todosLocaisCaixas()
        ));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        $this->load->view("caixa/editar-caixa", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisCaixas()));
        $this->load->view("caixa/remover-caixa", array( 
            "assetsUrl" => base_url("assets"),
            "locais" => $this->local->todosLocaisCaixas()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "caixa.js"));
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
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "caixa.js"));
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
            "arquivoJS" => "caixa.js"));
    }
    
    /*----------------Funções---------------*/
    
    //Alterar maquina
    public function alterar(){               
        try {
            //Recupera dados
            $id; $nomelocal; $url;
            $this->recuperaAlterar($id, $nomelocal, $url);
            //Busca maquina
            $maquina = $this->maquina->buscaMaquinaId($id);
            //Busca local
            $local = $this->local->buscaLocalNome($nomelocal);

            //Atualiza
            if (isset($maquina) && isset($local)){
                //gravar log
                $this->gravaLog("alteração", "alterou dados do caixa."
                        . " Caixa antigo: ". $maquina->getNome()
                        . " - ". $maquina->getIdlocal()
                        . ". Novo local: ". $local->getNome());
                //atualizaMaquina($id, $nome, $login, $descricao, $idlocal, $idtipo, $idunidade)
                $maquina->atualizaMaquina($maquina->getIdmaquina(), $maquina->getNome(), $maquina->getLogin(), $maquina->getDescricao(), $local->getIdlocal(), $maquina->getIdtipo(), 1);
                //mensagem
                $this->mensagem("Caixa alterado!", $url);
            } else {
                $this->erro("Não foi possível alterar o caixa. O caixa não existe.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao tentar alterar um caixa.");
        }
    }
    
    //Remover
    public function remover(){
        try {
            //Recupera dados
            $id; $url;
            $this->recuperaRemover($id, $url);
            //Busca maquina
            $maquina = $this->maquina->buscaMaquinaId($id);

            //remover
            if (isset($maquina)){
                //gravar log
                $this->gravaLog("remove", "deixou ip do caixa livre id: "
                        . $id);
                //$maquina->removerMaquina($maquina->getIdmaquina());
                //LiberaMaquina($id, $idlocal, $idtipo)
                $maquina->LiberaMaquina($maquina->getIdmaquina(), $maquina->getIdlocal(), $maquina->getIdtipo());
                //mensagem
                $this->mensagem("Caixa removido!", $url);
            } else {
                $this->erro("Erro ao tentar remover um caixa.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao tentar remover um caixa.");
        }
    }
    
    /*----------------Funções AJAX---------------*/

    //Editar AJAX
    public function editarCaixa(){
        //Recupera Id maquina
        $id = $this->input->post("idmaquina");
        $maquina = $this->maquina->buscaMaquinaId($id);
        
        $local = $this->local->buscaId($maquina->getIdlocal());
        
        if ($maquina){
            $mgs = array(
                "idmaquina" => $maquina->getIdmaquina(),
                "nome" => $maquina->getNome(),
                "ip" => $maquina->getIp(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Maquina não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
          
    //Remover AJAX
    public function removerCaixa(){
        //Recupera Id maquina
        $id = $this->input->post("idmaquina");
        $maquina = $this->maquina->buscaMaquinaId($id);
        
        $local = $this->local->buscaId($maquina->getIdlocal());
        
        if ($maquina){
            $mgs = array(
                "idmaquina" => $maquina->getIdmaquina(),
                "nome" => $maquina->getNome(),
                "ip" => $maquina->getIp(),
                "descricao" =>$maquina->getDescricao(),
                "idlocal" => $local->getIdlocal(),
                "local" => $local->getNome()
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Maquina não encontrada"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Buscar maquina AJAX
    public function buscarMaquina(){
        //Recupera letras
        $termo = $this->input->get("termo");
        $maquinas = $this->maquina->buscaMaquinaTermo($termo);
        //Gera json
        foreach ($maquinas as $maquina){
            $local = $this->local->buscaId($maquina->getIdlocal());
            $resultado[] = $maquina->getNome().": ".$maquina->getIp()." - ".$local->getNome(); 
        }
        echo json_encode($resultado);
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    
    /*---------------Funções internas------------*/ 
    
    private function recuperaAlterar(&$id, &$nomelocal, &$url){
        $id = $this->input->post("iptEdtId");
        $nomelocal = $this->input->post("selEdtLocal");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "caixa";
        }
    }
    
    private function recuperaRemover(&$id, &$url){
        $id = $this->input->post("iptRmvId");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "caixa";
        }
    }

        //Verificar maquinas ligadas e desligadas
    public function verificarEstado(){
         $id = $this->input->post("idmaquina");
        //busca maquinas
        $maquina = $this->maquina->buscaMaquinaId($id);
        if (isset($maquina)){
            $comando = "ping -n 1 ".$maquina->getIp();
            //executa comando
            $saida = shell_exec($comando);
            //verifica se tem o termo TTL
            if (preg_match("/TTL/", $saida)){
                echo true;
            } else{
                echo 'erro';
            }
        } else{
            //maquina não existe
            echo 'erro';
        }
        exit();
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
            if (unserialize($this->session->userdata('acesso'))->getCaixa() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("tentativa de acesso sem permissao", "acesso ao controlador Caixa.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Caixa.php");
            redirect(base_url());
        }
    }
}
