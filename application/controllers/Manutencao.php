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
    
    
    /*-----------------Views---------------*/ 
    //Exibe index
    public function index(){
        redirect('manutencao/defeito');
    }
    
    //Exibe view defeito
    public function defeito(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));   
        //Carrega
        $this->load->view('manutencao/home', array(
            "assetsUrl" => base_url("assets"),
            "aba" => "defeito",
        ));
        $this->load->view('manutencao/defeito', array(
            "assetsUrl" => base_url("assets"),            
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "paginas" => $this->listarManutencoes("defeito", "defeito"), 
            "defeitos" => $this->manutencao->buscaTodasDefeito(6, $this->recuperaOffset())));
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
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Exibe view manutencao
    public function manutencao(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));   
        //Carrega
        $this->load->view('manutencao/home', array(
            "assetsUrl" => base_url("assets"),
            "aba" => "manutencao",
        ));
        $this->load->view('manutencao/manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "paginas" => $this->listarManutencoes("manutencao", "manutencao"), 
            "manutencoes" => $this->manutencao->buscaTodasManutencao(6, $this->recuperaOffset())));
        //Modal
        $this->load->view('manutencao/criar-manutencao', array(
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
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Exibe view conserto
    public function conserto(){
       //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));   
        //Carrega
        $this->load->view('manutencao/home', array(
            "assetsUrl" => base_url("assets"),
            "aba" => "conserto",
        ));
        $this->load->view('manutencao/conserto', array(
            "assetsUrl" => base_url("assets"),
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "paginas" => $this->listarManutencoes("conserto", "conserto"),
            "fechadas" => $this->manutencao->buscaTodasFechadas(6, $this->recuperaOffset())));
        //Modal
        $this->load->view('manutencao/criar-manutencao', array(
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
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Exibe view garantia
    public function garantia(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));   
        //Carrega
        $this->load->view('manutencao/home', array(
            "assetsUrl" => base_url("assets"),
            "aba" => "garantia",
        ));
        $this->load->view('manutencao/garantia', array(
            "assetsUrl" => base_url("assets"),
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "paginas" => $this->listarManutencoes("garantia", "garantia"),
            "garantias" => $this->manutencao->buscaTodasGarantia(6, $this->recuperaOffset())));
        //Modal
        $this->load->view('manutencao/criar-manutencao', array(
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
        $this->load->view('manutencao/defeito-manutencao', array(
            "assetsUrl" => base_url("assets"),
            "unidades" => $this->unidade->todasUnidades(),
            "setores" => $this->setor->todosSetores()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }   
        
    //Exibe mensagem de erro
    public function erro($msg = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));     
        //Carrega index
        $this->load->view('mensagens/erro', array(
            "assetsUrl" => base_url("assets"),
            "msgerro" => $msg));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Exibe mensagem de erro
    public function mensagem($msg = null, $uri = null){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));     
        //Carrega index
        $this->load->view('mensagens/mensagem', array(
            "assetsUrl" => base_url("assets"),
            "msg" => $msg,
            "uri" => $uri));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets")));
    }
    
    //Exibe Resultado
    public function resultado($palavra, $defeitos = NULL, $manutencoes = NULL, $fechadas = NULL, $garantia = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "manutencao"));      
        //Carrega index
        $this->load->view('manutencao/resultado', array(
            "unidade" => new Unidade_model(),
            "setor" => new Setor_model(),
            "defeitos" => $defeitos,
            "manutencoes" => $manutencoes,
            "fechadas" => $fechadas,
            "garantias" => $garantia,
            "palavra" => $palavra,
        ));
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
    
    
    /*----------------Funções---------------*/     
    
    //Paginação
    public function listarManutencoes($tipo, $url){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('manutencao/'.$url),
            "per_page" => 6,
            "num_links" => 5,
            "uri_segment" => 3,
            "total_rows" => $this->manutencao->contarTodos($tipo),
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
    
    //Criar nova manutenção
    public function criarManutencao(){
        try {
            //recupera dados
            $equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor; $url;
            $this->recuperaCriarManutencao($equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor, $url);
            //adiciona manutenção ($equipamento, $defeito, $data_defeito, $data_entrega, $data_retorno, $data_reincidencia, $garantia, $data_garantia, $patrimonio, $descricao, $idunidade, $idsetor)
            $this->manutencao->newManutencao($equipamento, $defeito, $ddefeito, NULL, NULL, NULL, NULL, NULL, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
            $this->manutencao->addManutencao();
            //Log
            $this->gravaLog("criação manutencao", "manutencao criada: ".$equipamento." data: ".$ddefeito);
            $this->mensagem("Manutenção <strong>".$equipamento."</strong> criado(a) com sucesso!", $url);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral criação manutencao", "tentativa de criar manutencao: ".$equipamento." data: ".$ddefeito." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    //Enviar para manutenção
    public function enviarManutencao(){
        try {
            $id; $url;
            //recupera dados
            $this->recuperaEnviarManutencao($id, $url);            
            //envia para manutenção
            if ($this->manutencao->verificaEmDefeito($id)){
                //busca manutenção
                $manutencao = $this->manutencao->buscaId($id);
                //enviarManutencao($id, $data_entrega)
                $this->manutencao->enviarManutencao($id, date('Y-m-d H:i:s'));
                //Log
                $this->gravaLog("envia manutencao", "manutencao enviada: ".$id." - ".$manutencao->getEquipamento()." data: ".$manutencao->getData_defeito());
                $this->mensagem("<strong>".$manutencao->getEquipamento()."</strong> enviado(a) para manutenção.", $url);
            } else {
                //Log
                $this->gravaLog("erro envia manutencao", "erro manutencao enviada: ".$id);
                $this->erro("Erro ao enviar equipamento para manutenção. ID:<strong>".$id."</strong>");
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral envia manutencao", "erro manutencao enviada: ".$exc->getTraceAsString());
        }
        }

    //Atualiza manutencao
    public function atualizaManutencao(){        
        try {
            //recupera dados
            $id;$equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor; $url;
            $this->recuperaEditaManutencao($id, $equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor, $url);
            if ($this->manutencao->existe($id)){
                //busca manutenção
                $manutencao = $this->manutencao->buscaId($id);
                //atualizaManutencao($id, $equipamento, $defeito, $patrimonio, $idunidade, $idsetor)
                $this->manutencao->atualizaManutencao($id, $equipamento, $defeito, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
                //Log
                $this->gravaLog("atualiza manutencao", "manutencao atualizada: ".$id." - ".$equipamento);
                $this->mensagem("<strong>".$manutencao->getEquipamento()."</strong> atualizado(a).", $url);
            } else {
                //Log
                $this->gravaLog("erro atualiza manutencao", "erro manutencao atualizada: ".$id." - ".$equipamento);
                $this->erro("Erro ao atualizar manutenção do ID: <strong>".$id."</strong>.");
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral atualiza manutencao", "erro manutencao atualizada: ".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }        
    }        

    //Remove manutencao
    public function removeManutencao(){
        //recupera id
        $id; $url;
        $this->recuperaRemoveManutencao($id, $url);
        try {
            if ($this->manutencao->existe($id)){
                //busca manutenção
                $manutencao = $this->manutencao->buscaId($id);
                $this->manutencao->removerManutencao($id);
                //Log
                $this->gravaLog("remove manutencao", "manutencao removida: ".$id);
                $this->mensagem("<strong>".$manutencao->getEquipamento()."</strong> removido(a).", $url);
            } else {
                //Log
                $this->gravaLog("erro remove manutencao", "erro manutencao removida: ".$id);
                $this->erro("Erro ao remover manutenção ID: <strong>".$id."</strong>.");
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral remove manutencao", "erro manutencao removida: ".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }        
    }
       
    //Retorno manutencao
    public function retornoManutencao(){    
        try {
            //recupera dados
            $id; $url; $garantia; $retorno;
            $this->recuperaRetornoManutencao($id, $url, $garantia, $retorno); 
            if ($this->manutencao->verificaEmManutencao($id)){
                //busca manutenção
                $manutencao = $this->manutencao->buscaId($id);
                //retornoManutencao($id, $data_retorno, $garantia, $data_garantia)
                $this->manutencao->retornoManutencao($id, date('Y-m-d H:i:s', strtotime($retorno)), $garantia, $this->geraGarantia(date('Y-m-d H:i:s', strtotime($retorno)), $garantia));
                //Log
                $this->gravaLog("retorno manutencao", "manutencao: ".$id);
                $this->mensagem("<strong>".$manutencao->getEquipamento()."</strong> retornado(a) do fornecedor.", $url);
            } else {
                //Log
                $this->gravaLog("erro retorno manutencao", "erro manutencao: ".$id);
                $this->erro("Erro ao fazer o retorna da manutenção do ID: <strong>".$id."</strong>");
            }            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral retorno manutencao", "erro manutencao: ".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }        
    }
    
    //Apresentou defeito na manutenção (reindicio)
    public function defeitoManutencao(){            
        try {
            //recupera dados
            $equipamento; $defeito; $ddefeito; $patrimonio; $descricao; $unidade; $setor; $id; $url;
            $this->recuperaDefeitoManutencao($equipamento, $defeito, $ddefeito, $patrimonio, $descricao, $unidade, $setor, $id, $url);    
            //verifrica se existe manutenção em garantia
            if ($this->manutencao->verificaEmGarantia($id)){
                //grava reindicio de manutenção em garantia
                $this->manutencao->reindicio($id, $ddefeito);
                //Log
                $this->gravaLog("reindicio manutencao", "manutencao em garantia: ".$equipamento." data: ".$ddefeito." Id: ".$id);
                //adiciona nova manutenção ($equipamento, $defeito, $data_defeito, $data_entrega, $data_retorno, $data_reincidencia, $garantia, $data_garantia, $patrimonio, $descricao, $idunidade, $idsetor)
                $this->manutencao->newManutencao($equipamento, $defeito, $ddefeito, NULL, NULL, NULL, NULL, NULL, $patrimonio, $descricao, $this->geraUnidade($unidade), $this->geraSetor($setor));
                $this->manutencao->addManutencao();
                //Log
                $this->gravaLog("criação manutencao", "manutencao criada: ".$equipamento." data: ".$ddefeito);
                $this->mensagem("Reindicio do(a) <strong>".$equipamento."</strong> para manutenção criado(a)", $url);
            } else {
                //Log
                $this->gravaLog("erro reindicio manutencao", "erro manutencao: ".$id);
                $this->erro("Erro ao fazer o reindicio da manutenção do ID: <strong>".$id."</strong>");
            }  
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            //Log
            $this->gravaLog("erro geral criação manutencao", "tentativa de criar manutencao: ".$equipamento." data: ".$ddefeito." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    //Busca por manutenção (equipamento)
    public function buscar(){ //criar rota para que depois da uri buscar o numero ser a pesquisa
        //recupera dados da busca
        if ($this->recuperaBusca() != 0){
            $busca = $this->recuperaBusca();
        } else {
            $busca = strtolower(trim($this->input->post("iptBusca")));
        }
        try {
            //verifica se foi digitado algo
            if (isset($busca) && $busca != ""){
                //busca por equipamento buscaPorEquipamento($equipamento, $limite = NULL, $ponteiro = NULL)
                $defeitos = $this->manutencao->buscaPorDefeito($busca);
                $manutencoes = $this->manutencao->buscaPorManutecao($busca);
                $fechadas = $this->manutencao->buscaPorFechada($busca);
                $garantia =$this->manutencao->buscaPorGarantia($busca);
                //view resultado resultado($palavra, $defeitos = NULL, $manutencoes = NULL, $fechadas = NULL, $garantia = NULL)
                $this->resultado($busca, $defeitos, $manutencoes, $fechadas, $garantia);
            } else {
                $this->resultado("'vazio'");
            }                       
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro na busca. Favor tentar novamente.");
        }
    }
    
    
    /*----------------Funções AJAX---------------*/  
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
    
   
    /*---------Funções internas------------*/ 
    
    //Paginação, recupera offset
    private function recuperaOffset(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else{
            return 0;
        }
    }
    
    //recupera url da busca
    private function recuperaBusca(){
        if ($this->uri->segment(3)){
            return $this->uri->segment(3);
        } else {
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
    private function recuperaCriarManutencao(&$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor, &$url){
        $equipamento = $this->primeiraLetraMaiuscula(trim($this->input->post("iptCriEquipamento")));
        $defeito = $this->primeiraLetraMaiuscula(trim($this->input->post("iptCriDefeito")));
        $ddefeito = trim($this->input->post("iptCriDataDefeito"));
        $patrimonio = trim($this->input->post("iptCriPatrimonio"));
        $descricao = $this->primeiraLetraMaiuscula(trim($this->input->post("iptCriDescricao")));
        $unidade = trim($this->input->post("selCriUnidade"));
        $setor = trim($this->input->post("selCriSetor"));
        $url = trim($this->input->post("iptCriUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao/defeito");
        }
    }
    
    //recupera dados edita manutenção
    private function recuperaEditaManutencao(&$id, &$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor, &$url){
        $id = trim($this->input->post("iptEdtId"));
        $equipamento = $this->primeiraLetraMaiuscula(trim($this->input->post("iptEdtEquipamento")));
        $defeito = $this->primeiraLetraMaiuscula(trim($this->input->post("iptEdtDefeito")));
        $ddefeito = trim($this->input->post("iptEdtDataDefeito"));
        $patrimonio = trim($this->input->post("iptEdtPatrimonio"));
        $descricao = trim($this->input->post("iptEdtDescricao"));
        $unidade = trim($this->input->post("selEdtUnidade"));
        $setor = trim($this->input->post("selEdtSetor"));
        $url = trim($this->input->post("iptEdtUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao");
        }
        
    }

    //recupera dados defeito manutenção (em garantia)
    private function recuperaDefeitoManutencao(&$equipamento, &$defeito, &$ddefeito, &$patrimonio, &$descricao, &$unidade, &$setor, &$id, &$url){
        $equipamento = $this->primeiraLetraMaiuscula(trim($this->input->post("iptDftEquipamento")));
        $defeito = $this->primeiraLetraMaiuscula(trim($this->input->post("iptDftDefeito")));
        $ddefeito = trim($this->input->post("iptDftDataDefeito"));
        $patrimonio = trim($this->input->post("iptDftPatrimonio"));
        $descricao = $this->primeiraLetraMaiuscula(trim($this->input->post("iptDftDescricao")));
        $unidade = trim($this->input->post("selDftUnidade"));
        $setor = trim($this->input->post("selDftSetor"));
        $id = trim($this->input->post("iptDftId"));
        $url = trim($this->input->post("iptDftUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao/garantia");
        }
    }
    
    //recupera dados enviarManutencao
    private function recuperaEnviarManutencao(&$id, &$url){
        $id = trim($this->input->post("iptEnvId"));
        $url = trim($this->input->post("iptEnvUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao");
        }
    }
    
    //recupera dados removeManutencao
    private function recuperaRemoveManutencao(&$id, &$url){
        $id = trim($this->input->post("iptRmvId"));
        $url = trim($this->input->post("iptRmvUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao");
        }
    }
    
    //recupera dados removeManutencao
    private function recuperaRetornoManutencao(&$id, &$url, &$garantia, &$retorno){
        $id = trim($this->input->post("iptRtnId"));
        $garantia = trim($this->input->post("selRtnGarantia"));
        $retorno = trim($this->input->post("iptRtnDataRetorno"));
        $url = trim($this->input->post("iptRtnUrl"));
        
        if (!isset($url)){
            $url = base_url("manutencao/manutencao");
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
            if ($this->session->userdata('nivel') == '2'){
                //acesso negado
                //grava log
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Manutencao.php");
                redirect(base_url());
            } else {
                //acesso permitido
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Manutencao.php");
            redirect(base_url());
        }
    }
    
    //primeira letra maiuscula 
    private function primeiraLetraMaiuscula($texto){
        return ucfirst(strtolower($texto));
    }
}
