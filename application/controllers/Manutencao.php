<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends CI_Controller {

    /**
     * Manutencao.
     * @descripition Visualização das manutencaos no PIC Pampulha
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('manutencao_model', 'manutencao');
        $this->load->model('unidade_model', 'unidade');
        $this->load->model('setor_model', 'setor');
    }
    
    
    /*------Carregamento de views--------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));   
        //Carrega
        $this->load->view('manutencao/manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "defeitos" => $this->manutencao->buscaTodasDefeito(),
            "manutencoes" => $this->manutencao->buscaTodasManutencao(),
            "fechadas" => $this->manutencao->buscaTodasFechadas(),
            "garantias" => $this->manutencao->buscaTodasGarantia()));
        //Modal
        $this->load->view('manutencao/criar-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view('manutencao/enviar-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view('manutencao/editar-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view('manutencao/remover-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view('manutencao/retorno-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        $this->load->view('manutencao/defeito-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
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
            "msgerro" => 'teste de ero'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
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
            "msg" => 'teste de mensagem',
            "uri" => 'home'));
        //Modal
        $this->load->view("usuario/criar-usuario", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    /*------Funções internas--------*/     
    
    //Paginação
    public function listarManutencoes(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('manutencao'),
            "per_page" => 10,
            "num_links" => 5,
            "uri_segment" => 2,
            "total_rows" => $this->manutencao->contarTodos(),
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
    
    //Paginação, recupera offset
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
    
    //busca unidade
    private function geraUnidade($unidade){
        return $this->unidade->buscaPorNome($unidade)->getIdunidade();
    }
    
    //busca setor
    private function geraSetor($setor){
        return $this->setor->buscaPorNome($setor)->getIdsetor();
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
    
    //recupera dados criar manutenção
    private function recuperaCriarManutencao(&$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor){
        $equipamento = trim($this->input->post("iptCriEquipamento"));
        $defeito = trim($this->input->post("iptCriDefeito"));
        $ddefeito = trim($this->input->post("iptCriDataDefeito"));
        $patrimonio = trim($this->input->post("iptCriPatrimonio"));
        $descricao = trim($this->input->post("iptCriDescricao"));
        $unidade = trim($this->input->post("selCriUnidade"));
        $setor = trim($this->input->post("selCriSetor"));
    }
    
    //recupera dados edita manutenção
    private function recuperaEditaManutencao(&$id, &$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor){
        $id = trim($this->input->post("iptEdtId"));
        $equipamento = trim($this->input->post("iptEdtEquipamento"));
        $defeito = trim($this->input->post("iptEdtDefeito"));
        $ddefeito = trim($this->input->post("iptEdtDataDefeito"));
        $patrimonio = trim($this->input->post("iptEdtPatrimonio"));
        $descricao = trim($this->input->post("iptEdtDescricao"));
        $unidade = trim($this->input->post("selEdtUnidade"));
        $setor = trim($this->input->post("selEdtSetor"));
    }

    //recupera dados defeito manutenção (em garantia)
    private function recuperaDefeitoManutencao(&$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor, &$id){
        $equipamento = trim($this->input->post("iptDftEquipamento"));
        $defeito = trim($this->input->post("iptDftDefeito"));
        $ddefeito = trim($this->input->post("iptDftDataDefeito"));
        $patrimonio = trim($this->input->post("iptDftPatrimonio"));
        $descricao = trim($this->input->post("iptDftDescricao"));
        $unidade = trim($this->input->post("selDftUnidade"));
        $setor = trim($this->input->post("selDftSetor"));
        $id = trim($this->input->post("iptDftId"));
    }
    
    //Criar
    public function criarManutencao(){
        //recupera dados
        $equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor;
        $this->recuperaCriarManutencao($equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor);
        
        try {
            //adiciona manutenção ($equipamento, $defeito, $data_defeito, $data_entrega, $data_retorno, $data_reincidencia, $garantia, $data_garantia, $patrimonio, $descricao, $idunidade, $idsetor)
            $this->manutencao->newManutencao($equipamento, $defeito, $ddefeito, NULL, NULL, NULL, NULL, NULL, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
            $this->manutencao->addManutencao();
            //Log
            $this->gravaLog("criação manutencao", "manutencao criada: ".$equipamento." data: ".$ddefeito);
            redirect(base_url('manutencao'));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral criação manutencao", "tentativa de criar manutencao: ".$equipamento." data: ".$ddefeito." erro:".$exc->getTraceAsString());
            echo'erro ao criar manutencao';
        }
    }
    
    //Enviar ajax
    public function enviarParaManutencao(){
        //Recupera Id manutencao
        $id = $this->input->post("idmanutencao");
        $manutencao = $this->manutencao->buscaId($id);
        
        if (isset($manutencao)){
            $mgs = array(
                "idmanutencao" => $manutencao->getIdmanutencao(),
                "equipamento" => $manutencao->getEquipamento(),
                "data" => date("Y-m-d", strtotime($manutencao->getData_defeito()))
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
    
    //Editar ajax
    public function editarManutencao(){
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
                "unidade" => $unidade->getNome(),
                "setor" => $setor->getNome()
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
    
    //Remover ajax
    public function removerManutencao(){
        //Recupera Id manutencao
        $id = $this->input->post("idmanutencao");
        $manutencao = $this->manutencao->buscaId($id);
        
        if (isset($manutencao)){
            $mgs = array(
                "idmanutencao" => $manutencao->getIdmanutencao(),
                "equipamento" => $manutencao->getEquipamento(),
                "data" => date("Y-m-d", strtotime($manutencao->getData_defeito()))
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
    
    //Retornar para manutenção ajax
    public function retornarParaManutencao(){
        //Recupera Id manutencao
        $id = $this->input->post("idmanutencao");
        $manutencao = $this->manutencao->buscaId($id);
        
        if (isset($manutencao)){
            $mgs = array(
                "idmanutencao" => $manutencao->getIdmanutencao(),
                "equipamento" => $manutencao->getEquipamento(),
                "data" => date("Y-m-d", strtotime($manutencao->getData_defeito()))
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
    
    //defeito em garantia ajax
    public function apresentouDefeitoManutencao(){
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
                "unidade" => $unidade->getNome(),
                "setor" => $setor->getNome()
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
    
    //Enviar para manutenção
    public function enviarManutencao(){
        try {
            $id = $this->input->post("iptEnvId");
            $manutencao = $this->manutencao->buscaId($id);
            //envia para manutenção
            if (isset($manutencao)){
                //enviarManutencao($id, $data_entrega)
                $this->manutencao->enviarManutencao($id, date('Y-m-d H:i:s'));
                //Log
                $this->gravaLog("envia manutencao", "manutencao enviada: ".$id." - ".$manutencao->getEquipamento()." data: ".$manutencao->getData_defeito());
                redirect(base_url('manutencao'));
            } else {
                //Log
                $this->gravaLog("erro envia manutencao", "erro manutencao enviada: ".$id);
                echo 'Erro ao enviar equipamento para manutenção. '.$id;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral envia manutencao", "erro manutencao enviada: ".$exc->getTraceAsString());
        }
        }

    //Atualiza manutencao
    public function atualizaManutencao(){
        //recupera dados
        $id;$equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor;
        $this->recuperaEditaManutencao($id, $equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor);
        
        try {
            if ($this->manutencao->existe($id)){
                //atualizaManutencao($id, $equipamento, $defeito, $patrimonio, $idunidade, $idsetor)
                $this->manutencao->atualizaManutencao($id, $equipamento, $defeito, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
                //Log
                $this->gravaLog("atualiza manutencao", "manutencao atualizada: ".$id." - ".$equipamento);
                redirect(base_url('manutencao'));
            } else {
                //Log
                $this->gravaLog("erro atualiza manutencao", "erro manutencao atualizada: ".$id." - ".$equipamento);
                redirect(base_url('manutencao'));
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral atualiza manutencao", "erro manutencao atualizada: ".$exc->getTraceAsString());
        }        
    }
    
    //remove manutencao
    public function removeManutencao(){
        //recupera id
        $id = $this->input->post("iptRmvId");        
        try {
            if ($this->manutencao->existe($id)){
                $this->manutencao->removerManutencao($id);
                //Log
                $this->gravaLog("remove manutencao", "manutencao removida: ".$id);
                redirect(base_url('manutencao'));
            } else {
                //Log
                $this->gravaLog("erro remove manutencao", "erro manutencao removida: ".$id);
                redirect(base_url('manutencao'));
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral remove manutencao", "erro manutencao removida: ".$exc->getTraceAsString());
        }        
    }
    
    //remove manutencao
    public function retornoManutencao(){
        //recupera id
        $id = trim($this->input->post("iptRtnId"));
        $garantia = trim($this->input->post("selRtnGarantia"));
        $retorno = trim($this->input->post("iptRtnDataRetorno"));
        try {
            if ($this->manutencao->existe($id)){
                //retornoManutencao($id, $data_retorno, $garantia, $data_garantia)
                $this->manutencao->retornoManutencao($id, date('Y-m-d H:i:s', strtotime($retorno)), $garantia, $this->geraGarantia(date('Y-m-d H:i:s', strtotime($retorno)), $garantia));
                //Log
                $this->gravaLog("retorno manutencao", "manutencao: ".$id);
                redirect(base_url('manutencao'));
            } else {
                //Log
                $this->gravaLog("erro retorno manutencao", "erro manutencao: ".$id);
                redirect(base_url('manutencao'));
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral retorno manutencao", "erro manutencao: ".$exc->getTraceAsString());
        }        
    }
    
    //Criar
    public function defeitoManutencao(){
        //recupera dados
        $equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor; $id;
        $this->recuperaDefeitoManutencao($equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor, $id);        
        try {
            //grava reindicio de manutenção em garantia
            $this->manutencao->reindicio($id, $ddefeito);
            //Log
            $this->gravaLog("reindicio manutencao", "manutencao em garantia: ".$equipamento." data: ".$ddefeito." Id: ".$id);
            //adiciona nova manutenção ($equipamento, $defeito, $data_defeito, $data_entrega, $data_retorno, $data_reincidencia, $garantia, $data_garantia, $patrimonio, $descricao, $idunidade, $idsetor)
            $this->manutencao->newManutencao($equipamento, $defeito, $ddefeito, NULL, NULL, NULL, NULL, NULL, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
            $this->manutencao->addManutencao();
            //Log
            $this->gravaLog("criação manutencao", "manutencao criada: ".$equipamento." data: ".$ddefeito);
            redirect(base_url('manutencao'));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral criação manutencao", "tentativa de criar manutencao: ".$equipamento." data: ".$ddefeito." erro:".$exc->getTraceAsString());
            echo'erro ao criar manutencao';
        }
    }
    
    //gera garantia
    private function geraGarantia($dataretorno, $garantia){
        //dias em segundos
        $segundos = $garantia * 86400;
        //calcula data
        $data = date('Y-m-d H:i:s', strtotime($dataretorno) + $segundos);
        return $data;
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Manutencao.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Manutencao.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Manutencao.php");
            redirect(base_url());
        }
    }
}
