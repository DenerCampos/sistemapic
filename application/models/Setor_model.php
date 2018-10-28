<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_model extends CI_Model {

    /**
     * Setor model
     * @description: Classe de setores do PIC
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idsetor;
    var $nome;
    var $idestado;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Instancia novo setor
    public function newSetor($nome, $idestado){
        $this->setNome($nome);
        $this->setIdestado($idestado);
    }
    
    //Insere setor
    public function addSetor(){
        $this->db->insert("setor", $this);
    }
    
    //Atualiza setor
    public function atualizaSetor($id, $nome, $idestado){
        $dados = array(
            "nome" => $nome,
            "idestado" => $idestado
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idsetor', $id);
        $this->db->update('setor');
    }
    
    //Verifica se setor existe
    public function setorExiste($nome){
        $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Remover setor
    public function removerSetor($id){
        $this->db->where('idsetor', $id);
        $this->db->delete('setor');
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('setor');
    }
    
    //Busca setor por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE idsetor = $id");
        //retorna objeto setor
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
                FROM setor 
                WHERE nome = '$nome'");
        //retorna objeto unidade
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se setor a ser atualizado ja existe no bd
    public function verificaSetorAtualiza($id, $nome){
        $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE idsetor != $id AND
                    nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se esta ativa
    public function verificaAtivo($id){
        $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE idsetor = $id AND
                    idestado = 1");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
        
    //Desativa setor
    public function desativaSetor($id){
        $dados = array(
            "idestado" => 2
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idsetor', $id);
        $this->db->update('setor');
    }
    
    //Ativa setor
    public function ativaSetor($id){
        $dados = array(
            "idestado" => 1
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idsetor', $id);
        $this->db->update('setor');
    }
    
    //Verifica se setor esta desativo
    public function verificaDesativo($id){
        $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE idsetor = $id AND
                    idestado = 2");
        //retorna objeto setor
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca todas areas
    public function todosSetores($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM setor 
                WHERE idestado = 1
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM setor
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
    
    //Busca todas areas
    public function todosSetoresAdm($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM setor 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM setor
                    ORDER BY nome");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
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
                FROM setor
                WHERE nome LIKE '%$texto%'
                ORDER BY nome ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM setor
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
        $setor = new Setor_model();
        //atribue valores do resultado
        $setor->setIdsetor($r->idsetor);
        $setor->setNome($r->nome);
        $setor->setIdestado($r->idestado);
        
        return $setor;
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
    function getIdsetor() {
        return $this->idsetor;
    }

    function getNome() {
        return $this->nome;
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdsetor($idsetor) {
        $this->idsetor = $idsetor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }


}
