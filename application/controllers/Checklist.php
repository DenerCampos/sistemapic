<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {

    /**
     * Checklist
     * @descripition controller para a função checklist 
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica acesso
        $this->verificaNivel();
        //carregando modelo
        $this->load->model("Grupo_checklist_model", "grupo");
        $this->load->model("Equipamento_checklist_model", "equipamento");
        $this->load->model("Checklist_model", "checklist");
        $this->load->model("Item_checklist_model", "item");
    }
    
    
    /*------------Carregamento de views------------*/ 
    public function index(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('checklist/home', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->geraListaChecklist()));
        //Modal
        $this->load->view("checklist/email-checklist", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "checklist.js"));
    }
    
    public function novo(){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('checklist/checklist', array(
            "assetsUrl" => base_url("assets"),
            "lista" => $this->criaLista()));
        //Modal
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "checklist.js"));
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
            "arquivoJS" => "checklist.js"));
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
            "arquivoJS" => "checklist.js"));
    }
    
    //Resultado
    public function resultado($palavra, $usuario = NULL, $data = NULL){
        //Carrega cabeçaho html
        $this->load->view("_html/cabecalho", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega menu
        $this->load->view("menu/principal", array( 
            "assetsUrl" => base_url("assets"),
            "ativo" => "relatorio"));      
        //Carrega index
        $this->load->view('checklist/resultado', array(
            "palavra" => $palavra,
            "data" => $data,
            "lista" => $usuario
        ));      
        //Modal
        $this->load->view("checklist/email-checklist", array( 
            "assetsUrl" => base_url("assets")));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "checklist.js"));
    }
    
    /*------------------Funções------------------*/   
    //Criar
    function criar(){
        //recuperar dados post
        $dados = $this->input->post();
        $uri = "checklist";
        try {
            //recupera dados ja em um array para inserção no BD
            $resultado = $this->recuperaCriar($dados);
            //Insere checklist novo($data, $idusuario)
            $this->checklist->novo(date('Y-m-d H:i:s'), $this->session->userdata("id"));            
            //Insere e recupera ultimo id checklist inserido no BD
            $ultimo = $this->checklist->adiciona();            
            //insere no BD
            foreach ($resultado as $key => $value) {
                //novo($concluido, $observacao, $idequipamento_checklist, $idchecklist)
                $this->item->novo($value["concluido"], 
                        $value["observacao"], 
                        $value["idequipamento_checklist"], 
                        $ultimo);
                $this->item->adiciona();
            }
            //Gerar pdf
            $this->gerarPdf($ultimo);
            //grava log
            $this->gravaLog("checklist", "checklist gerado. data: ".date('Y-m-d H:i:s')." usuario: ".$this->session->userdata("id"));
            $this->mensagem("Checklist salvo.", $uri);
            
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro ao criar checklist. Favor tentar novamente.");
        }        
    }

    //Enviar email
    public function enviarEmail(){
        //recupera dados
        $id; $data; $para; $copia; $assunto; $texto; $url;
        
        try {
            //recupera dados do post
            $this->recuperaEnviarEmail($id, $data, $para, $copia, $assunto, $texto, $url);
            //verificar se id avaliacao
            if ($this->checklist->existeId($id)){
                //busca o anexo
                $anexo = $this->anexo($id);
                if ($this->envioEmail($para, $data, $copia, $assunto, $texto, $anexo)){
                    $this->gravaLog("enviar email checklist", "checklist id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->mensagem("E-mail enviado com <strong>sucesso</strong>!", $url);
                }else {
                    $this->gravaLog("erro enviar email checklist", "checklist id: ".$id." enviado: ".$this->session->userdata("id"));
                    $this->erro("Erro ao enviar e-mail, <strong>tente novamente</strong>.");
                }
            }else{
                //erro, não existe plantão
                $this->gravaLog("erro enviar email checklist", "a checklist não existe. id: ".$id);
                $this->erro("Não existe o checklist de número: <strong>".$id.".</strong>. <br>Tente novamente.");
            }
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
            $this->erro("Erro para enviar e-mail. Favor tentar novamente.");
        }
    } 
    
    //Busca por ocorrencia
    public function buscar(){
        //recupera dados da busca
        $busca = strtolower(trim($this->input->post("iptBusca")));
        try {
            //verifica se foi digitado algo
            if (isset($busca) && $busca != ""){
                //busca por usuario do checklist todasPorBuscaUsuario($usuario, $limite = NULL, $ponteiro = NULL)
                $usuario = $this->checklist->todasPorBuscaUsuario($busca);
                if (!empty($usuario)){
                    $usuario = $this->geraListaResultadoChecklist($usuario);
                }
                // view resultado($palavra, $data = NULL, $usuario = NULL)
                $this->resultado($busca, $usuario);
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
    //Enviar email AJAX
    public function enviarEmailChecklist(){
        //Recupera Id manutencao
        $id = trim($this->input->post("id"));
                
        if ($this->checklist->existeId($id)){
            //caregando modelo
            $this->load->model("Usuario_model", "usuario");
            $msg = array(
                "idchecklist" => $id,
                "data" => date("d/m/Y", strtotime($this->checklist->buscaId($id)->getData())),
                "usuario" => $this->usuario->buscaId($this->checklist->buscaId($id)->getIdusuario())->getNome(),
                "para" => "ricardo.souza@pic-clube.com.br",
                "copia" => "ti@pic-clube.com.br",
                "assunto" => "Check-list PIC Pampulha: ".date("d/m/Y", strtotime($this->checklist->buscaId($id)->getData())),
                "corpo" => "Prezados, boa dia! \n\nSegue em anexo o check-lista do dia: ".date("d/m/Y", strtotime($this->checklist->buscaId($id)->getData())).". \n\nAtt. \n".$this->usuario->buscaId($this->checklist->buscaId($id)->getIdusuario())->getNome().".\n"
            );
            echo json_encode($msg);
        } else {
            $msg = array(
                "erro" => "Checklist não encontrado. (".$id.")."
            );
            echo json_encode($msg);
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
            if (unserialize($this->session->userdata('acesso'))->getRelatorio() == 1){
                //acesso permitido                
            } else {
                //acesso negado
                $this->gravaLog("acesso negado", "acesso ao controlador Checklist.php");
                redirect(base_url());
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso sem usuario", "acesso ao controlador Checklist.php");
            redirect(base_url());
        }
    }
    
    //Cria lista com dados do grupo e seus equipamentos
    private function criaLista(){
        /*
         * Cria uma matriz com dos dados do grupo e todos os equipamentos desde grupo 
         */        
        
        $grupo = $this->grupo->todosGrupos();
        $dados = array();
        $resultado = array();
        
        foreach ($grupo as $key => $value) {   
            //pega todos equipamentos do grupo
            $equipamentos = $this->equipamento->todosEquipamentoPorGrupo($value->getIdgrupo_checklist());
            
            $dados["grupo"] = $value;
            foreach ($equipamentos as $valor) {
                $dados["equipamento"][] = $valor; 
            }
            
            $resultado[$key] = $dados;
            //limpa array
            $dados = array();
        }        
        return $resultado;
    }
    
    //Recuperar dados post CRIAR
    private function recuperaCriar(&$dados){
        /* Retorna array com o resultado dos inputs na ordem do select do banco de dados
         * Não mudar a ordem do select na chamada para preencher a tela e a busca dos equipamentos, tem que ser o 
         * mesmo select.
         * Pode inserir diretamente no banco este array */
        //Resultado
        $resultado = array();
        //Todos equipamentos
        $equipamentos = $this->equipamento->todosEquipamento();
        //gera inserção item
        foreach ($equipamentos as $key => $value) {
            //novo($concluido, $observacao, $idequipamento_checklist, $idchecklist)
            $resultado[] = array(
                    "concluido" => $this->retornaDadoArray($dados, $value->getIdequipamento_checklist(), "chk"), 
                    "observacao" => $this->retornaDadoArray($dados, $value->getIdequipamento_checklist(), "ipt"), 
                    "idequipamento_checklist" => $value->getIdequipamento_checklist());
        }
        return $resultado;
    }
    
    //Retorna dado se estiver no array
    private function retornaDadoArray($dados, $valor, $input){
        /* Retorna na mesma ordem do select do bd e dos inputs os valores dos inputs */
        switch ($input) {
            //Caso seja um checkbox
            case "chk":
                $key = array_key_exists($input.$valor, $dados);
                if ($key != FALSE){
                    return TRUE;
                } else {
                    return FALSE;
                }
                break;
            //Caso seja um input
            case "ipt":
                $key = array_key_exists($input.$valor, $dados);
                if ($key != FALSE){
                    return $dados[$input.$valor];
                } else {
                    return "";
                }
                break;
            default:
                return NULL;
        }
    }

    //Recuperar ultimo id inserido no BD
    private function recuperaUltimoIdChecklist(){
        $ultimo = $this->checklist->ultimoIdInserido();
        
        if ($ultimo == 0){
            return 1;
        } else {
            return $ultimo;
        }
    }
    
    //Gera lista de checklist para a home
    private function geraListaChecklist(){
        //carrega modelo usuario
        $this->load->model("Usuario_model", "usuario");
        $lista = array();
        //busca ultimos 15 checklist ultimos($limite = NULL)
        $checklist = $this->checklist->ultimos(15);
        //gerar array
        if (isset($checklist)){
            foreach ($checklist as $key => $value) {
                $lista[] = array(
                    "id" => $value->getIdchecklist(),
                    "data" => date("d/m/Y - H:m", strtotime($value->getData())), 
                    "usuario" => $this->usuario->buscaId($value->getIdusuario())->getNome()
                );
            }
        }
        return $lista;
    }
    
    //Gera lista de checklist para a resultado usuario
    private function geraListaResultadoChecklist($usuario){
        //carrega modelo usuario
        $this->load->model("Usuario_model", "usuario");
        $lista = array();
        //gerar array
        if (isset($usuario)){
            foreach ($usuario as $key => $value) {
                $lista[] = array(
                    "id" => $value->getIdchecklist(),
                    "data" => date("d/m/Y - H:m", strtotime($value->getData())), 
                    "usuario" => $this->usuario->buscaId($value->getIdusuario())->getNome()
                );
            }
        }
        return $lista;
    }
    
    //Recupera dados do email
    private function recuperaEnviarEmail(&$id, &$data, &$para, &$copia, &$assunto, &$texto, &$url){
        $id = trim($this->input->post("iptEmlId"));
        $data = trim($this->input->post("iptEmlData"));
        $para = trim($this->input->post("iptEmlPara"));
        $copia = trim($this->input->post("iptEmlCopia"));
        $assunto = trim($this->input->post("iptEmlAssunto"));
        $texto = trim($this->input->post("iptEmlCorpo"));
        $url = trim($this->input->post("iptEmlUrl"));
        
        if (empty($url)){
            $url = "checklist";
        }
    }
    
    //enviar email
    private function envioEmail($para, $data, $copia, $assunto, $texto, $anexo = NULL){
        try {
            //carregando biblioteca de email
            $this->load->library("email");
            //pegando configuração
            $this->load->model("email_conf_model", "configuracao");
            $config = $this->configuracao->busca("html");
            //preparando o email
            $this->email->initialize($config);            
            $this->email->from($config["smtp_user"], $this->session->userdata("nome"));
            $this->email->to($para);
            $this->email->cc($copia);
            $this->email->subject($assunto);
            //$this->email->message($texto);
            $this->email->message($this->geraTextoEmail($texto));
            //anexo
            if (isset($anexo)){
                $this->email->attach($anexo);
            }
            if ($this->email->send()) {
                //email enviado com sucesso
                return TRUE;
            } else {
                $head = $this->email->print_debugger(array('headers'));
                $subject = $this->email->print_debugger(array('subject'));
                $body = $this->email->print_debugger(array('body'));
                $this->gravaLog("erro enviar email avaliacao", "Usuario: ".$this->session->userdata("id").". Erro: ".$head." - ".$subject." - ".$body);
                //$this->erro($teste);
                return FALSE;
            }
            //enviando email
        } catch (Exception $exc) {
            //log
            $this->gravaLog("erro geral", $exc->getTraceAsString());
        }
    }
    
    //Busca anexo 
    private function anexo($id){
        //caminho do documento
        $anexo = "./document/checklist/".$id.".pdf";
        //verifica se existe o documento
        if (file_exists($anexo)){
            return $anexo;
        } else{
            return NULL;      
        }       
    }
    
    //gera html da mensagem para enviar por email
    private function geraTextoEmail($texto){
        //substitui o enter por quebra de linha no html
        $texto = str_replace("\n", "<br/>", $texto);
        //gera html da mensagem
        $email = $this->load->view("checklist/email", array( 
                "assetsUrl" => base_url("assets"),
                "texto" => $texto), TRUE);
        
        return $email;
    }
    
    //Gerar pdf checklist
    private function gerarPdf($idchecklist){
        //carregando a biblioteca
        $this->load->library('pdf');
        //verifica se checklist existe
        if ($this->checklist->existeId($idchecklist)){
            //Gera paginas HTML
            $paginas = $this->geraPaginasChecklist($idchecklist);
            //Css do relatorio
            $css = file_get_contents(base_url('assets/css/sistemapic.checklist.css')); 
            //gera pdf
            $this->pdf->geraChecklistPDF($paginas, $css, $idchecklist);
            //teste
            //$this->pdf->geraTesteHTML($paginas);
            //grava log
            $this->gravaLog("avaliaxao", "relatorio avaliação gerado. Usuario: ".$this->session->userdata("id")."Id checklist: ".$idchecklist);
            //$this->sucesso($idplantao, "plantao", "Relatório emitido com <strong>sucesso</strong>.<br/>Desaja vizualiza-lo?");
        } else{
            //não existe avaliação
        }
    }
    
    //Gera pagina pdf checklist
    private function geraPaginasChecklist($idchecklist){
        //carrega modelo usuario
        $this->load->model("Usuario_model", "usuario");
        //Paginas
        $paginas;
        //Verifica se existe checklist
        if ($this->checklist->existeId($idchecklist)){
            //recupera checklist
            $checklist = $this->checklist->buscaId($idchecklist);
            //gerando html do relatorio
            $paginas = $this->load->view("checklist/relatorio", array( 
                "assetsUrl" => base_url("assets"),
                "data" => date("d/m/Y", strtotime($checklist->getData())),
                "nome" => $this->usuario->buscaId($checklist->getIdusuario())->getNome(),
                "lista" => $this->gerarListaRelatorioChecklist($idchecklist)
                ), TRUE); 
        }
        return $paginas;
    }
    
    //Gerar lista para relatorio checklist
    private function gerarListaRelatorioChecklist($idchecklist){
        //busca o checklist, grupo, itens e equipamentos
        $resultado = array();
        //Verifica se existe checklist
        if ($this->checklist->existeId($idchecklist)){
            //$checklist = $this->checklist->buscaId($idchecklist);
            $itens = $this->item->todosPorChecklist($idchecklist);
            $grupo = $this->grupo->todosGrupos();
            
            //
            foreach ($grupo as $key => $value) {
                $resultado[] = array(
                    "grupo" => $value->getNome(),
                    "item" => $this->gerarListaRelatorioItem($itens, $value->getIdgrupo_checklist())
                );
            }
        }
        return $resultado;
    }
    
    //Gerar lista de item para relatorio checklist
    private function gerarListaRelatorioItem(&$itens, $idgrupo){
        /*Retorna array de itens de um determinado grupo*/
        $resultado = array();
        foreach ($itens as $key => $value) {
            //se equipamento do item tiver o mesmo grupo que o idgrupo, faz parte do grupo o item analisado
            if ($this->equipamento->buscaId($value->getIdequipamento_checklist())->getIdgrupo_checklist() == $idgrupo) {
                $resultado[] = array (
                    "ok" => $value->getConcluido(),
                    "equipamento" => $this->equipamento->buscaId($value->getIdequipamento_checklist())->getNome(),
                    "obs" => $value->getObservacao()
                );
            }
        }
        
        return $resultado;
    }
}
