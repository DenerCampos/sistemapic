<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problema_model extends CI_Model {

    /**
     * Problema model
     * 
     * @autor: Dener Junio
     * @desc: Manipulação dos dados da classe problema, CRUD problema 
     */
    
     /*------Atributos--------*/
    var $idproblema;
    var $nome;
    var $descricao;
    var $idestado;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo problema
    public function newProblema($nome, $descricao, $idestado){
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setIdestado($idestado);
    }
    
    //Insere problema
    public function addProblema(){
        $this->db->insert("problema", $this);
    }
    
    //Atualiza problema
    public function atualizaProblema($id, $nome, $descricao, $idestado){
        $dados = array(
            "nome" => $nome,
            "descricao" => $descricao,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idproblema', $id);
        $this->db->update('problema');
    }
    
    //Remover problema
    public function removerProblema($id){
        $this->db->where('idproblema', $id);
        $this->db->delete('problema');
    }
    
    //Busca todos problemas
    public function todosProblemas($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE idestado = 1
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM problema
                    WHERE idestado = 1
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos problemas ADM
    public function todosProblemasAdm($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM problema 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM problema
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se problema existe
    public function problemaExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se problema a ser atualizado ja existe no bd
    public function verificaProblemaAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE idproblema != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se problema esta ativo
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE idproblema = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Desativa problema
    public function desativaProblema($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idproblema', $id);
        $this->db->update('problema');
    }
    
    //Ativa problema
    public function ativaProblema($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idproblema', $id);
        $this->db->update('problema');
    }
    
    //Verifica se problema esta desativo
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE idproblema = $id AND
                    idestado = 2");
        //retorna objeto problema
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('problema');
    }
    
    //Busca problema por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE idproblema = $id");
        //retorna objeto area
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por nome
    public function buscaPorNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM problema 
                WHERE nome = '$nome'");
        //retorna objeto unidade
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM problema
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM problema
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC");
        }
        
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $problema = new Problema_model();
        //atribue valores do resultado
        $problema->setIdproblema($r->idproblema);
        $problema->setNome($r->nome);
        $problema->setDescricao($r->descricao);
        $problema->setIdestado($r->idestado);
        
        return $problema;
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
    function getIdproblema() {
        return $this->idproblema;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdproblema($idproblema) {
        $this->idproblema = $idproblema;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }


}
