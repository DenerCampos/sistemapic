<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patrimonio_model extends CI_Model {

    /**
     * patrimonio model
     * Mapa com os equipamentos com patrimonio. Local true em patrimonio
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idpatrimonio; //identificador (not null)
    var $equipamento; //nome (not null)
    var $serie; //numero de serie
    var $modelo; //modelo 
    var $descricao; //descrição
    var $patrimonio; //numero patrimonio PIC (not null)
    var $fornecedor; //nome fornecedor
    var $idlocal; //id do local

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $idlocal){
        $this->setEquipamento($equipamento);
        $this->setSerie($serie);
        $this->setModelo($modelo);
        $this->setDescricao($descricao);
        $this->setPatrimonio($patrimonio);
        $this->setFornecedor($fornecedor);
        $this->setIdlocal($idlocal);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("patrimonio", $this);
    }
    
    //Atualiza
    public function atualiza($id, $equipamento, $serie, $modelo, $descricao, $patrimonio, $fornecedor, $idlocal){
        $dados = array(
            "equipamento" => $equipamento,
            "serie" => $serie,
            "modelo" => $modelo,
            "descricao" => $descricao,
            "patrimonio" => $patrimonio,
            "fornecedor" => $fornecedor,
            "idlocal" => $idlocal
        );
        $this->db->set($dados);
        $this->db->where('idpatrimonio', $id);
        $this->db->update('patrimonio');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idpatrimonio', $id);
        $this->db->delete('patrimonio');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM patrimonio");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe patrimonio
    public function existePatrimonio($numero){
         $query = $this->db->query(
                "SELECT *
                FROM patrimonio
                WHERE patrimonio = $numero");
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
                FROM patrimonio
                WHERE idpatrimonio = '$id'");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por Patrimonio
    public function buscaPorPatrimonio($numero){
        $query = $this->db->query(
                "SELECT * 
                FROM patrimonio
                WHERE patrimonio = '$numero'");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verifica se existe por ID
    public function existeId($id){
        $query = $this->db->query(
                "SELECT * 
                FROM patrimonio
                WHERE idpatrimonio = '$id'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se a ser atualizada ja existe no bd
    public function verificaAtualiza($id, $patrimonio){
        $query = $this->db->query(
                "SELECT *
                FROM patrimonio 
                WHERE idpatrimonio != $id AND
                    patrimonio = $patrimonio");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM patrimonio
                WHERE equipamento LIKE '%$texto%' OR
                    modelo LIKE '%$texto%' OR
                    patrimonio LIKE '%$texto%' OR
                    serie LIKE '%$texto%'
                ORDER BY idpatrimonio ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM patrimonio
                WHERE equipamento LIKE '%$texto%' OR
                    modelo LIKE '%$texto%' OR
                    patrimonio LIKE '%$texto%' OR
                    serie LIKE '%$texto%'
                ORDER BY idpatrimonio ASC");
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
        $patrimonio = new Patrimonio_model();
        //atribue valores do resultado
        $patrimonio->setIdpatrimonio($r->idpatrimonio);
        $patrimonio->setEquipamento($r->equipamento);
        $patrimonio->setSerie($r->serie);
        $patrimonio->setModelo($r->modelo);
        $patrimonio->setDescricao($r->descricao);
        $patrimonio->setPatrimonio($r->patrimonio);
        $patrimonio->setFornecedor($r->fornecedor);
        $patrimonio->setIdlocal($r->idlocal);
        return $patrimonio;
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
    function getIdpatrimonio() {
        return $this->idpatrimonio;
    }

    function getEquipamento() {
        return $this->equipamento;
    }

    function getSerie() {
        return $this->serie;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPatrimonio() {
        return $this->patrimonio;
    }

    function getFornecedor() {
        return $this->fornecedor;
    }

    function getIdlocal() {
        return $this->idlocal;
    }

    function setIdpatrimonio($idpatrimonio) {
        $this->idpatrimonio = $idpatrimonio;
    }

    function setEquipamento($equipamento) {
        $this->equipamento = $equipamento;
    }

    function setSerie($serie) {
        $this->serie = $serie;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setPatrimonio($patrimonio) {
        $this->patrimonio = $patrimonio;
    }

    function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }


}
