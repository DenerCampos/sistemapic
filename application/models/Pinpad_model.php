<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pinpad_model extends CI_Model {

    /**
     * Pinpad: Armazena informçaões dos PinPads 
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idpinpad; //identificador
    var $modelo; //nome do modelo do pinpad
    var $serial; //serial do pinpad
    var $nome; //nome do pinpad no pic
    var $descricao; //dados adicionais ao pinpad
    var $idlocal; //identificador do local

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Novo PinPad
    public function novo($modelo, $serial, $nome, $descricao, $local){
        $this->setModelo($modelo);
        $this->setSerial($serial);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setIdlocal($local);
    }
    
    //Insere no BD o novo PinPad
    public function adiciona(){
        $this->db->insert("pinpad", $this);
    }
    
    //Atualiza PinPad
    public function atualiza($id, $modelo, $serial, $nome, $descricao, $local){
        $dados = array (
            "modelo" => $modelo, 
            "serial" => $serial,
            "nome" => $nome,
            "descricao" => $descricao,
            "idlocal" => $local
        );
        $this->db->set($dados);
        $this->db->where('idpinpad', $id);
        $this->db->update('pinpad');
    }
    
    //Remove PinPad
    public function remove($id){
        $this->db->where('idpinpad', $id);
        $this->db->delete('pinpad');
    }
    
    //Buscar todos
    public function todos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM pinpad 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM pinpad");
        }
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('pinpad');
    }
    
    //Verifica se existe
    public function existe($serial){
        $query = $this->db->query(
                "SELECT * 
                FROM pinpad
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
                FROM pinpad
                WHERE idpinpad = '$id'");
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
                FROM pinpad
                WHERE serial = '$serial' AND
                    idpinpad <> $id");
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
                FROM pinpad
                WHERE idpinpad = '$id'");
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
                FROM pinpad
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%' OR
                ORDER BY idpinpad ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM pinpad
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%'
                ORDER BY idpinpad ASC");
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
        $pinpad = new Pinpad_model();
        //atribue valores do resultado
        $pinpad->setIdpinpad($r->idpinpad);
        $pinpad->setModelo($r->modelo);
        $pinpad->setSerial($r->serial);
        $pinpad->setNome($r->nome);
        $pinpad->setDescricao($r->descricao);
        $pinpad->setIdlocal($r->idlocal);
        
        return $pinpad;
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
    function getIdpinpad() {
        return $this->idpinpad;
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

    function setIdpinpad($idpinpad) {
        $this->idpinpad = $idpinpad;
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
