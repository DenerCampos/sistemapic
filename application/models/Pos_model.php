<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pos_model extends CI_Model {

    /**
     * Pos: Armazena informçaões dos POS 
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idpos; //identificador
    var $modelo; //nome do modelo do pos
    var $serial; //serial do pos
    var $nome; //nome do pos no pic
    var $descricao; //dados adicionais ao pos
    var $idlocal; //identificador do local

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Novo POS
    public function novo($modelo, $serial, $nome, $descricao, $local){
        $this->setModelo($modelo);
        $this->setSerial($serial);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setIdlocal($local);
    }
    
    //Insere no BD o novo POS
    public function adiciona(){
        $this->db->insert("pos", $this);
    }
    
    //Atualiza POS
    public function atualiza($id, $modelo, $serial, $nome, $descricao, $local){
        $dados = array (
            "modelo" => $modelo, 
            "serial" => $serial,
            "nome" => $nome,
            "descricao" => $descricao,
            "idlocal" => $local
        );
        $this->db->set($dados);
        $this->db->where('idpos', $id);
        $this->db->update('pos');
    }
    
    //Remove POS
    public function remove($id){
        $this->db->where('idpos', $id);
        $this->db->delete('pos');
    }
    
    //Buscar todos
    public function todos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM pos 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM pos");
        }
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('pos');
    }
    
    //Verifica se existe
    public function existe($serial){
        $query = $this->db->query(
                "SELECT * 
                FROM pos
                WHERE serial = '$serial'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se existe por ID
    public function existeId($id){
        $query = $this->db->query(
                "SELECT * 
                FROM pos
                WHERE idpos = '$id'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica existe para atualização
    public function existeAtualiza($id, $serial){
        $query = $this->db->query(
                "SELECT * 
                FROM pos
                WHERE serial = '$serial' AND
                    idpos <> $id");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca por ID
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT * 
                FROM pos
                WHERE idpos = '$id'");
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
                FROM pos
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%' OR
                ORDER BY idpos ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM pos
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%'
                ORDER BY idpos ASC");
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
        $pos = new Pos_model();
        //atribue valores do resultado
        $pos->setIdpos($r->idpos);
        $pos->setModelo($r->modelo);
        $pos->setSerial($r->serial);
        $pos->setNome($r->nome);
        $pos->setDescricao($r->descricao);
        $pos->setIdlocal($r->idlocal);
        
        return $pos;
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
    function getIdpos() {
        return $this->idpos;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getSerial() {
        return $this->serial;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getIdlocal() {
        return $this->idlocal;
    }

    function setIdpos($idpos) {
        $this->idpos = $idpos;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }


}
