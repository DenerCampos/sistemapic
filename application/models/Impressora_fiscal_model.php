<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Impressora_fiscal_model extends CI_Model {

    /**
     * Impressora_fiscal: Armazena informçaões das impressoras fiscais
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idimpressora_fiscal; //identificador
    var $modelo; //nome do modelo da impressora
    var $serial; //serial da impressora
    var $descricao; //dados adicionais a impressora
    var $caixa; //numero do caixa da impressora
    var $idlocal; //identificador do local

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Nova impressora fiscal
    public function novo($modelo, $serial, $descricao, $caixa, $local){
        $this->setModelo($modelo);
        $this->setSerial($serial);
        $this->setDescricao($descricao);
        $this->setCaixa($caixa);
        $this->setIdlocal($local);
    }
    
    //Insere no BD a nova impressora fiscal
    public function adiciona(){
        $this->db->insert("impressora_fiscal", $this);
    }
    
    //Atualiza impressora fiscal
    public function atualiza($id, $modelo, $serial, $descricao, $caixa, $local){
        $dados = array (
            "modelo" => $modelo, 
            "serial" => $serial,
            "descricao" => $descricao,
            "caixa" => $caixa,
            "idlocal" => $local
        );
        $this->db->set($dados);
        $this->db->where('idimpressora_fiscal', $id);
        $this->db->update('impressora_fiscal');
    }
    
    //Remove impressora fiscal
    public function remove($id){
        $this->db->where('idimpressora_fiscal', $id);
        $this->db->delete('impressora_fiscal');
    }
    
    //Buscar todos
    public function todos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM impressora_fiscal 
                ORDER BY caixa
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM impressora_fiscal");
        }
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('impressora_fiscal');
    }
    
    //Verifica se existe
    public function existe($serial){
        $query = $this->db->query(
                "SELECT * 
                FROM impressora_fiscal
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
                FROM impressora_fiscal
                WHERE idimpressora_fiscal = '$id'");
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
                FROM impressora_fiscal
                WHERE serial = '$serial' AND
                    idimpressora_fiscal <> $id");
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
                FROM impressora_fiscal
                WHERE idimpressora_fiscal = '$id'");
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
                FROM impressora_fiscal
                WHERE modelo LIKE '%$texto%' OR
                    caixa LIKE '%$texto%' OR
                    serial LIKE '%$texto%' OR
                ORDER BY idimpressora_fiscal ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM impressora_fiscal
                WHERE modelo LIKE '%$texto%' OR
                    caixa LIKE '%$texto%' OR
                    serial LIKE '%$texto%'
                ORDER BY idimpressora_fiscal ASC");
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
        $fiscal = new Impressora_fiscal_model();
        //atribue valores do resultado
        $fiscal->setIdimpressora_fiscal($r->idimpressora_fiscal);
        $fiscal->setModelo($r->modelo);
        $fiscal->setSerial($r->serial);
        $fiscal->setDescricao($r->descricao);
        $fiscal->setCaixa($r->caixa);
        $fiscal->setIdlocal($r->idlocal);
        
        return $fiscal;
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
    function getIdimpressora_fiscal() {
        return $this->idimpressora_fiscal;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getSerial() {
        return $this->serial;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getCaixa() {
        return $this->caixa;
    }

    function getIdlocal() {
        return $this->idlocal;
    }

    function setIdimpressora_fiscal($idimpressora_fiscal) {
        $this->idimpressora_fiscal = $idimpressora_fiscal;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setCaixa($caixa) {
        $this->caixa = $caixa;
    }

    function setIdlocal($idlocal) {
        $this->idlocal = $idlocal;
    }


}
