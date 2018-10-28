<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist_model extends CI_Model {

    /**
     * Checklis model
     * Checklist do pic
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idchecklist; //identificador
    var $data; //data do checklist
    var $idusuario; // id do usuario que fez o checkliwt

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($data, $idusuario){
        $this->setData($data);
        $this->setIdusuario($idusuario);
    }
    
    //Adiciona e retorna ultimo id
    public function adiciona(){
        $this->db->insert("checklist", $this);
        return $this->db->insert_id();
    }
    
    //Atualiza
    public function atualiza($id, $data, $idusuario){
        $dados = array(
            "data" => $data,
            "idusuario" => $idusuario
        );
        $this->db->set($dados);
        $this->db->where('idchecklist', $id);
        $this->db->update('checklist');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idchecklist', $id);
        $this->db->delete('checklist');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM checklist");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //pegar ultimo inserido no BD
    public function ultimoIdInserido(){
        return $this->db->insert_id();
    }
    
    //Buscar todos
    public function ultimos($limite = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM checklist
                ORDER BY idchecklist DESC
                LIMIT $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM checklist
                ORDER BY idchecklist DESC
                LIMIT $limite"); 
        }
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe id
    public function existeId($idchecklist){
         $query = $this->db->query(
                "SELECT *
                FROM checklist
                WHERE idchecklist = $idchecklist"); 
        //retorna 
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM checklist 
                WHERE idchecklist = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por usuário (nome)
    public function todasPorBuscaUsuario($usuario, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT c.idchecklist, c.data, c.idusuario
                FROM  checklist as c
                INNER JOIN usuario as u 
                    ON c.idusuario = u.idusuario
                WHERE u.nome LIKE '%$usuario%'
                ORDER BY c.data DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT c.idchecklist, c.data, c.idusuario
                FROM  checklist as c
                INNER JOIN usuario as u 
                    ON c.idusuario = u.idusuario
                WHERE u.nome LIKE '%$usuario%'
                ORDER BY c.data DESC");
        }
        //retorna objeto ip
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
        $obj = new Checklist_model();
        //atribue valores do resultado
        $obj->setIdchecklist($r->idchecklist);
        $obj->setData($r->data);
        $obj->setIdusuario($r->idusuario);
        
        return $obj;
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
    function getIdchecklist() {
        return $this->idchecklist;
    }

    function getData() {
        return $this->data;
    }

    function getIdusuario() {
        return $this->idusuario;
    }

    function setIdchecklist($idchecklist) {
        $this->idchecklist = $idchecklist;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }


}
