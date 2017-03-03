<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    /**
     * Usuario
     * @description: Classe usuario model
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idusuario; //identificador
    var $nome; //nome usuario
    var $login; //email
    var $senha; //senha
    var $nivel; // 0 = adm, 1 = tecnico e 2 = usuario
    var $idestado; //ativo ou desativo
    var $idarea; //area de atendimento se for tecnico

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    //Instancia novo usuario
    public function newUsuario($nome, $login, $senha, $nivel, $idestado, $idarea = NULL){
        $this->setNome($nome);
        $this->setLogin($login);
        $this->setSenha($senha);
        $this->setNivel($nivel);
        $this->setIdestado($idestado);
        if (isset($idarea)){
            $this->setIdarea($idarea);
        }
    }
    
    //Insere usuario
    public function addUsuario(){
        $this->db->insert("usuario", $this);
    }
    
    //Atualiza usuario
    public function atualizaUsuario($id, $nome, $login, $senha, $nivel, $idestado, $idarea = NULL){
        $dados = array(
            "nome" => $nome,
            "login" => $login,
            "senha" => $senha,
            "nivel" => $nivel,
            "idestado" => $idestado,
            "idarea" => $idarea
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idusuario', $id);
        $this->db->update('usuario');
    }
    
    //Desatica usuario
    public function desativaUsuario($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idusuario', $id);
        $this->db->update('usuario');
    }
    
    //Remover usuario
    public function removerUsuario($id){
        $this->db->where('idusuario', $id);
        $this->db->delete('usuario');
    }
    
    //Ativar usuario
    public function ativaUsuario($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idusuario', $id);
        $this->db->update('usuario');
    }
      
    //Verifica usuario e senha e busca usuario se existir
    public function loginUsuario($login, $senha){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE login = '$login' AND
                    senha = '$senha'");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se login do usuario a ser utilizado ja existe no bd
    public function verificaLoginAtualiza($id, $login){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE idusuario != $id AND
                    login = '$login'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se usuario esta ativo
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE idusuario = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se usuario esta desativo
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE idusuario = $id AND
                    idestado = 2");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    //Busca usuario por login
    public function buscaUsuario($login){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE login = '$login'");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca usuario por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE idusuario = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe login
    public function loginExiste($login){
        $query = $this->db->query(
                "SELECT *
                FROM usuario 
                WHERE login = '$login'");
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
      
    //Busca todos usuarios
    public function todosUsuarios($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM usuario 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM usuario");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('usuario');
    }


    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $usuario = new Usuario_model();
        //atribue valores do resultado
        $usuario->setIdusuario($r->idusuario);
        $usuario->setNome($r->nome);
        $usuario->setLogin($r->login);
        $usuario->setSenha($r->senha);
        $usuario->setNivel($r->nivel);
        $usuario->setIdestado($r->idestado);
        $usuario->setIdarea($r->idarea);
        
        return $usuario;
    }
    
    //Recuperar um array de objetos sob uma resposta de query
    private function getObjByResult($result){  
        //verifica tamanho do array
        if(count($result)>1){            
            $objects=array();           
            foreach ($result as $k => $v){               
                $objects[$k]=$this->getObjByRow($result[$k]);
            }
            return $objects;
        }
        else{   
            return array($this->getObjByRow($result[0]));
        }
    }
    
    /*------Gets e Sets--------*/ 
    function getIdusuario() {
        return $this->idusuario;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function getIdarea() {
        return $this->idarea;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }

    function setIdarea($idarea) {
        $this->idarea = $idarea;
    }


}
