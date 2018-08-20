<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_admin extends CI_Controller {

    /**
     * Usuario_admin.
     * @descripition Controlador usuario da area de administraçao do sistema
     * @author Dener Junio
     * 
     */

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
        //verifica nivel usuario
        $this->verificaNivel();
        //carregando modelo
        $this->load->model('Usuario_model', 'usuario');
        $this->load->model('estado_model', 'estado');
        $this->load->model("Area_model", "area");
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
            "ativo" => "usuarios"));
        //Carrega usuarios
        $this->load->view('admin/usuarios/usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "area" => new Area_model(),
            "usuarios" => $this->usuario->todosUsuarios(7, $this->recuperaOffset()),
            "paginas" => $this->listarUsuarios()));
        //Modal
        $this->load->view('admin/usuarios/criar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados(),
            "areas" => $this->area->todasAreas()));
        $this->load->view('admin/usuarios/editar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/remover-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/ativar-usuarios', array(
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
    
    //resultado da busca
    public function resultado($resultados, $palavra){
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
            "ativo" => "usuarios"));
        //Carrega usuarios
        $this->load->view('admin/usuarios/usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estado" => new Estado_model(),
            "area" => new Area_model(),
            "palavra" => $palavra,
            "resultados" => $resultados));
        //Modal
        $this->load->view('admin/usuarios/criar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados(),
            "areas" => $this->area->todasAreas()));
        $this->load->view('admin/usuarios/editar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/remover-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        $this->load->view('admin/usuarios/ativar-usuarios', array(
            "assetsUrl" => base_url("assets"),
            "estados" => $this->estado->todosEstados()));
        //Carrega fechamento html
        $this->load->view("_html/rodape", array( 
            "assetsUrl" => base_url("assets"), 
            "arquivoJS" => "administracao.js"));
    }
    
    /*-------------Funções---------------*/        
    //Paginação usuario
    public function listarUsuarios(){
        //Configuração da paginação codeigniter
        $config = array(
            "base_url" => base_url('admin/usuario_admin'),
            "per_page" => 7,
            "num_links" => 3,
            "uri_segment" => 3,
            "total_rows" => $this->usuario->contarTodos(),
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
    
    //Criar usuario
    public function criarUsuario(){
        //recupera dados
        $nome; $login; $senha; $rsenha; $nivel; $estado; $url;
        //recupera area - somente tecnico
        $area;
        //array com nivel de acesso
        $acesso;
        
        try {
            //recupera dados do post
            $this->recuperaCriarUsuario($nome, $login, $senha, $rsenha, $nivel, $estado, $area, $acesso, $url);

            //verifica dados
            if ($this->verificaLogin($login, $senha, $rsenha)){
                //verifica usuario tecnico
                if ($this->verificaTecnico($nivel)){
                    //cria usuario tecnico
                    $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));
                } else {
                    //cria usuario
                    $this->usuario->newUsuario($nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado));                
                }
                //adiciona usuario
                $this->usuario->addUsuario();
                //cria nivel de acesso novo($ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $idusuario)
                $this->acesso->novo($acesso["ocorrencia"], $acesso["admin"], $acesso["caixa"], $acesso["manutencao"], 
                        $acesso["relatorio"], $acesso["usuario"], $acesso["equipamento"], $acesso["avaliacao"], $acesso["utilitario"], $this->usuario->buscaUsuario($login)->getIdusuario());
                $this->acesso->adiciona();
                //Log
                $this->gravaLog("ADMIN criação usuario", "usuario criado: ".$nome." Email: ". $login);
                $this->gravaLog("ADMIN criação acesso", implode("|", $acesso));
                //mensagem
                $this->mensagem("Usuário <strong>".$login."</strong> criado!", $url);
            }else{
                //Log
                $this->gravaLog("ADMIN erro criação usuario", "tentativa de criar usuario: ".$nome." Email: ". $login);
                $this->erro("Erro na criação de usuário. Tentar novamente.");
            }
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("ADMIN GERAL", $exc->getTraceAsString());
            $this->erro($exc->getTraceAsString());
        }
    }
    
    //Atualiza usuario
    public function atualizaUsuario(){
        //recuperando dados do usuario
        $id; $nome; $login; $senha; $rsenha; $nivel; $estado; $url;
        //recupera area - somente tecnico
        $area;
        //array com nivel de acesso
        $acesso;
        try {
            //Recupera dados
            $this->recuperaAtualizaUsuario($id, $nome, $login, $senha, $rsenha, $nivel, $estado, $area, $acesso, $url);
            if ($senha == ""){
                $senha = NULL;
            }
            //verifica dados
            if ($this->atualizaLogin($id, $login, $senha, $rsenha)){
                //atualiza usuario
                //verifica se é tecnico
                if ($this->verificaTecnico($nivel)){
                    if (isset($senha)){
                        $this->usuario->atualizaUsuario($id, $nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));            
                    } else {
                        $usuario = $this->usuario->buscaId($id);
                        $this->usuario->atualizaUsuario($id, $nome, $login, $usuario->getSenha(), $this->geraNivel($nivel), $this->geraEstado($estado), $this->geraArea($area));
                    }
                } else {
                    //Não é tecnico
                    if (isset($senha)){
                        $this->usuario->atualizaUsuario($id, $nome, $login, $this->geraSenha($senha), $this->geraNivel($nivel), $this->geraEstado($estado));            
                    } else {
                        $usuario = $this->usuario->buscaId($id);
                        $this->usuario->atualizaUsuario($id, $nome, $login, $usuario->getSenha(), $this->geraNivel($nivel), $this->geraEstado($estado));
                    }
                }
                //busca nivel de acesso
                $idacesso = $this->acesso->buscaIdUsuario($id);
                //verifica se existe acesso para o usuario
                if (isset($idacesso)){
                    //atualiza acesso atualiza($id, $ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $idusuario)
                    $this->acesso->atualiza($idacesso->getIdacesso(), $acesso["ocorrencia"], $acesso["admin"], $acesso["caixa"], $acesso["manutencao"],
                            $acesso["relatorio"], $acesso["usuario"], $acesso["equipamento"], $acesso["avaliacao"], $acesso["utilitario"], $id);   
                } else {
                    //cria nivel de acesso novo($ocorrencia, $admin, $caixa, $manutencao, $relatorio, $usuario, $equipamento, $avaliacao, $utilitario, $idusuario)
                    $this->acesso->novo($acesso["ocorrencia"], $acesso["admin"], $acesso["caixa"], $acesso["manutencao"], 
                        $acesso["relatorio"], $acesso["usuario"], $acesso["equipamento"], $acesso["avaliacao"], $acesso["utilitario"], $this->usuario->buscaUsuario($login)->getIdusuario());
                    $this->acesso->adiciona();
                }
                //Log
                $this->gravaLog("ADMIN alteração usuario", "usuario alterado: ".$nome." Email: ". $login);
                //mensagem
                $this->mensagem("Usuário <strong>".$login."</strong> alterado!", $url);
            }else{
                //Log
                $this->gravaLog("ADMIN erro alteração usuario", "tentativa de alterar usuario: ".$nome." Email: ". $login);
                $this->erro("Erro na edição de usuário. Tentar novamente.");
            }      
            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("ADMIN GERAL", $exc->getTraceAsString());
            $this->erro($exc->getTraceAsString());
        }     
    }
    
    //Desabilitar usuario
    public function desabilitaUsuario() {
        $id; $url;

        try {
            //recupera dados do post
            $this->recuperaDesabilitaUsuario($id, $url);
            //verifica se usuario existe e esta ativo
            if ($this->usuario->verificaAtivo($id)) {
                //desativa usuario
                $this->usuario->desativaUsuario($id);
                //Log
                $this->gravaLog("ADMIN desabilita usuario", "usuario desabilitado id: " . $id);
                //mensagem
                $this->mensagem("Usuário desabilitado!", $url);
            } else {
                //Log
                $this->gravaLog("ADMIN erro desabilitar usuario", "tentativa de desabilitar usuario id: " . $id);
                $this->erro("Erro ao desabilitar o usuário. Tentar novamente.");
            }
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("ADMIN GERAL", $exc->getTraceAsString());
            $this->erro($exc->getTraceAsString());
        }
    }

    //Ativar usuario
    public function ativaUsuario() {        
        $id; $url;
        
        try {
            //recupera id usuario
            $this->recuperaAtivaUsuario($id, $url);
            //verifica se usuario existe e esta ativo
            if ($this->usuario->verificaDesativo($id)) {
                //ativar usuario
                $this->usuario->ativaUsuario($id);
                //Log
                $this->gravaLog("ADMIN ativar usuario", "usuario ativado id: " . $id);
                //mensagem
                $this->mensagem("Usuário ativado!", $url);
            } else {
                //Log
                $this->gravaLog("ADMIN erro ativar usuario", "tentativa de ativar usuario id: " . $id);
                $this->erro("Erro ao ativar o usuário. Tentar novamente.");
            }
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("ADMIN GERAL", $exc->getTraceAsString());
            $this->erro($exc->getTraceAsString());
        }
    }

    //buscar
    public function busca(){
        try {
            //recupera dados
            $texto = trim($this->input->post("iptBusca"));
            //busca pelo texto
            if (isset($texto) && $texto != ""){
                $this->resultado($this->usuario->busca($texto), $texto);
            } else if ($texto == "") {
                $this->resultado($this->usuario->busca($texto, 100), $texto);
            } else {
                $this->erro("Erro ao pesquisar a palavra <strong>".$texto."</strong>");
            }            
        } catch (Exception $exc) {
            //Log
            $this->gravaLog("erro geral ADMIN", "erro pesquisa de usuario: ".$texto." erro:".$exc->getTraceAsString());
            $this->erro("<strong>Erro Geral</strong>");
        }
    }
    
    /*----------------Funções AJAX---------------*/
    //Editar usuario ajax
    public function editarUsuario(){
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        $acesso = $this->acesso->buscaIdUsuario($id);
        
        if (isset($usuario)){
            $estado = $this->estado->buscaId($usuario->getIdestado());
            //verifica area de atendimento usuario
            if ($usuario->getIdarea() != NULL){
                $area = $this->area->buscaId($usuario->getIdarea())->getNome();
            }else{
                $area = "Nenhuma";
            }
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
                "nivel" =>  $this->buscaNivel($usuario->getNivel()),
                "estado" => $estado->getNome(),
                "area" => $area,
                "acesso" => $acesso
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Ativar usuario ajax
    public function ativarUsuario(){
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        
        if (isset($usuario)){
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
            );
            echo json_encode($mgs);
        }
        //WARNNING: requisição ajax é recuperada por impressão
        exit();
    }
    
    //Remover usuario ajax
    public function removerUsuario(){
        //Recupera Id usuario
        //Recupera Id usuario
        $id = $this->input->post("idusuario");
        $usuario = $this->usuario->buscaId($id);
        
        if (isset($usuario)){
            $mgs = array(
                "idusuario" => $usuario->getIdusuario(),
                "nome" => $usuario->getNome(),
                "login" => $usuario->getLogin(),
            );
            echo json_encode($mgs);
        } else {
            $mgs = array(
                "erro" => "Usuário não encontrado"
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

    //verificação de login e senha
    private function verificaLogin($login, $senha, $rsenha){
        //Verifica se login existe e senha
        if ($this->usuario->loginExiste($login)){
            return FALSE;
        } elseif ($senha != $rsenha) {
            return FALSE;
        } else{
            return TRUE;
        }
    }
    
    //gera hash senha
    private function geraSenha($senha){
        $novo = password_hash($senha, PASSWORD_DEFAULT);
        return $novo;
    }
    
    //verifica senha
    private function verificaSenha($senha, $senhabanco){
        if (password_verify($senha, $senhabanco)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //verifica nivel 
    private function geraNivel($nivel){
       
        switch ($nivel) {
            case "Administrador":
                return 0;
            case "Técnico":
                return 1;
            default:
                return 2;
        }
    }
    
    //busca nivel 
    private function buscaNivel($nivel){
       
        switch ($nivel) {
            case 0:
                return "Administrador";
            case 1:
                return "Técnico";
            default:
                return "Usuário";
        }
    }

    //busca estado
    private function geraEstado($estado){
        return $this->estado->buscaNome($estado)->getIdestado();
    }
    
    //busca area
    private function geraArea($area){
        return $this->area->buscaPorNome($area)->getIdarea();
    }
    
    //verifica se é tecnico
    private function verificaTecnico($nivel){
        if ($this->geraNivel($nivel) == 1){
            return TRUE;
        } else {
            return FALSE;
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
    
    //verifica senha e email para atualizar login
    private function atualizaLogin($id, $login, $senha = NULL, $rsenha = NULL){
        //Verifica se login existe e senha
        if ($this->usuario->verificaLoginAtualiza($id, $login)){
            return FALSE;
        } elseif (isset ($senha) && isset ($rsenha)){
            if ($senha != $rsenha) {
                return FALSE;
            }else{
                return TRUE;
            }
        } else{
            return TRUE;
        }
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
                $this->gravaLog("tentativa de acesso", "acesso ao controlador Usuario_adim.php");
                redirect(base_url());
            } else {
                //acesso permitido
                //grava log
                $this->gravaLog("acesso", "acesso ao controlador Usuario_adim.php");
            }
        } else {
            //grava log
            $this->gravaLog("tentativa de acesso", "acesso ao controlador Usuario_adim.php");
            redirect(base_url());
        }
    }
    
    //recupera dados do post criar usuario
    private function recuperaCriarUsuario(&$nome, &$login, &$senha, &$rsenha, &$nivel, &$estado, &$area, &$acesso, &$url){
        //recupera dados
        $nome = trim($this->input->post("iptCriNome"));
        $login = trim($this->input->post("iptCriEmail"));
        $senha = trim($this->input->post("iptCriSenha"));
        $rsenha = trim($this->input->post("iptCriRSenha"));
        $nivel = trim($this->input->post("selCriNivel"));
        $estado = trim($this->input->post("selCriEstado"));
        //recupera area - somente tecnico
        $area = trim($this->input->post("selCriArea"));
        //recupera url
        $url = trim($this->input->post("iptCriUrl"));
               
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "administracao/usuario_admin";
        }
        
        //recupera nivel de acesso
        if (!empty($this->input->post("chkCriOcorrencia"))){
            $acesso['ocorrencia'] = 1;
        } else {
            $acesso['ocorrencia'] = 0;
        }
        if (!empty($this->input->post("chkCriAdmin"))){
            $acesso['admin'] = 1;
        } else {
            $acesso['admin'] = 0;
        }        
        if (!empty($this->input->post("chkCriCaixa"))){
            $acesso['caixa'] = 1;
        } else {
            $acesso['caixa'] = 0;
        }
        if (!empty($this->input->post("chkCriManutencao"))){
            $acesso['manutencao'] = 1;
        } else {
            $acesso['manutencao'] = 0;
        }
        if (!empty($this->input->post("chkCriRelatorio"))){
            $acesso['relatorio'] = 1;
        } else {
            $acesso['relatorio'] = 0;
        }
        if (!empty($this->input->post("chkCriUsuario"))){
            $acesso['usuario'] = 1;
        } else {
            $acesso['usuario'] = 0;
        }
        if (!empty($this->input->post("chkCriEquipamento"))){
            $acesso['equipamento'] = 1;
        } else {
            $acesso['equipamento'] = 0;
        }
        if (!empty($this->input->post("chkCriAvaliacao"))){
            $acesso['avaliacao'] = 1;
        } else {
            $acesso['avaliacao'] = 0;
        }
        if (!empty($this->input->post("chkCriUtilitario"))){
            $acesso['utilitario'] = 1;
        } else {
            $acesso['utilitario'] = 0;
        }
        
    }
    
    //recupera dados do post atualiza usuario
    private function recuperaAtualizaUsuario(&$id, &$nome, &$login, &$senha, &$rsenha, &$nivel, &$estado, &$area, &$acesso, &$url){
        //recupera dados
        $id = trim($this->input->post("iptEdtId"));
        $nome = trim($this->input->post("iptEdtNome"));
        $login = trim($this->input->post("iptEdtEmail"));
        $senha = trim($this->input->post("iptEdtSenha"));
        $rsenha = trim($this->input->post("iptEdtRSenha"));
        $nivel = trim($this->input->post("selEdtNivel"));
        $estado = trim($this->input->post("selEdtEstado"));
        //recupera area - somente tecnico
        $area = trim($this->input->post("selEdtArea"));
        //recupera url
        $url = trim($this->input->post("iptEdtUrl"));
               
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "administracao/usuario_admin";
        }
        
        //recupera nivel de acesso
        if (!empty($this->input->post("chkEdtOcorrencia"))){
            $acesso['ocorrencia'] = 1;
        } else {
            $acesso['ocorrencia'] = 0;
        }
        if (!empty($this->input->post("chkEdtAdmin"))){
            $acesso['admin'] = 1;
        } else {
            $acesso['admin'] = 0;
        }        
        if (!empty($this->input->post("chkEdtCaixa"))){
            $acesso['caixa'] = 1;
        } else {
            $acesso['caixa'] = 0;
        }
        if (!empty($this->input->post("chkEdtManutencao"))){
            $acesso['manutencao'] = 1;
        } else {
            $acesso['manutencao'] = 0;
        }
        if (!empty($this->input->post("chkEdtRelatorio"))){
            $acesso['relatorio'] = 1;
        } else {
            $acesso['relatorio'] = 0;
        }
        if (!empty($this->input->post("chkEdtUsuario"))){
            $acesso['usuario'] = 1;
        } else {
            $acesso['usuario'] = 0;
        }
        if (!empty($this->input->post("chkEdtEquipamento"))){
            $acesso['equipamento'] = 1;
        } else {
            $acesso['equipamento'] = 0;
        }
        if (!empty($this->input->post("chkEdtAvaliacao"))){
            $acesso['avaliacao'] = 1;
        } else {
            $acesso['avaliacao'] = 0;
        }
        if (!empty($this->input->post("chkEdtUtilitario"))){
            $acesso['utilitario'] = 1;
        } else {
            $acesso['utilitario'] = 0;
        }
    }
    
    //Recupera dados do post desabilita usuario
    private function recuperaDesabilitaUsuario(&$id, &$url){
        //recupera dados
        $id = trim($this->input->post("iptRmvId"));
        $url = trim($this->input->post("iptRmvUrl"));
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "administracao/usuario_admin";
        }
    }
    
    //Recupera dados do post ativa usuario
    private function recuperaAtivaUsuario(&$id, &$url){
        //recupera dados
        $id = $this->input->post("iptAtvId");
        $url = $this->input->post("iptAtvUrl");
        
        //verifica URL existe
        if (!isset($url)|| $url === ""){
            $url = "administracao/usuario_admin";
        }
    }
}
