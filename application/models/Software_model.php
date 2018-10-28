<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Software_model extends CI_Model {

    /**
     * Software_model
     * @description: Inventario de programas do pic
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idsoftware; //identificador
    var $nome; //nome do programa
    var $versao; //versao do programa;
    var $idmaquina; //identificador da maquina

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($nome, $versao, $idmaquina){
        $this->setNome($nome);
        $this->setVersao($versao);
        $this->setIdmaquina($idmaquina);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("software", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $versao, $idmaquina){
        $dados = array(
            "nome" => $nome,
            "versao" => $versao,
            "idmaquina" => $idmaquina
        );
        $this->db->set($dados);
        $this->db->where('idsoftware', $id);
        $this->db->update('software');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idsoftware', $id);
        $this->db->delete('software');
    }
    
    //Remove
    public function removeTodosMaquina($id){
        $this->db->where('idmaquina', $id);
        $this->db->delete('software');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM software");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar todos por maquina
    public function todosPorIdMaquina($id){
         $query = $this->db->query(
                "SELECT *
                FROM software
                WHERE idmaquina = $id
                ORDER BY nome ");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se tem programa cadastrado
    public function verificaInventario($id){
         $query = $this->db->query(
                "SELECT *
                FROM software
                WHERE idmaquina = $id");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $objeto = new Software_model();
        //atribue valores do resultado
        $objeto->setIdsoftware($r->idsoftware);
        $objeto->setNome($r->nome);
        $objeto->setVersao($r->versao);
        $objeto->setIdmaquina($r->idmaquina);
        
        return $objeto;
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
    function getIdsoftware() {
        return $this->idsoftware;
    }

    function getNome() {
        return $this->nome;
    }

    function getVersao() {
        return $this->versao;
    }

    function getIdmaquina() {
        return $this->idmaquina;
    }

    function setIdsoftware($idsoftware) {
        $this->idsoftware = $idsoftware;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setVersao($versao) {
        $this->versao = $versao;
    }

    function setIdmaquina($idmaquina) {
        $this->idmaquina = $idmaquina;
    }


}
