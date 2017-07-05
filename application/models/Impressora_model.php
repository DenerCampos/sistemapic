<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Impressora_model extends CI_Model {

    /**
     * Impressora: Armazena informçaões das impressoras 
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idimpressora; //identificador
    var $modelo; //nome do modelo da impressora
    var $serial; //serial da impressora
    var $nome; //nome da impressora no pic
    var $descricao; //dados adicionais a impressora
    var $idlocal; //identificador do local

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //Nova impressora
    public function novo($modelo, $serial, $nome, $descricao, $local){
        $this->setModelo($modelo);
        $this->setSerial($serial);
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setIdlocal($local);
    }
    
    //Insere no BD a nova impressora
    public function adiciona(){
        $this->db->insert("impressora", $this);
    }
    
    //Atualiza impressora 
    public function atualiza($id, $modelo, $serial, $nome, $descricao, $local){
        $dados = array (
            "modelo" => $modelo, 
            "serial" => $serial,
            "nome" => $nome,
            "descricao" => $descricao,
            "idlocal" => $local
        );
        $this->db->set($dados);
        $this->db->where('idimpressora', $id);
        $this->db->update('impressora');
    }
    
    //Remove impressora
    public function remove($id){
        $this->db->where('idimpressora', $id);
        $this->db->delete('impressora');
    }
    
    //Buscar todos
    public function todos($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM impressora 
                ORDER BY nome
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                    "SELECT *
                    FROM impressora");
        }
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('impressora');
    }
    
    //Verifica se existe
    public function existe($serial){
        $query = $this->db->query(
                "SELECT * 
                FROM impressora
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
                FROM impressora
                WHERE idimpressora = '$id'");
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
                FROM impressora
                WHERE serial = '$serial' AND
                    idimpressora <> $id");
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
                FROM impressora
                WHERE idimpressora = '$id'");
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
                FROM impressora
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%' OR
                ORDER BY idimpressora ASC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM impressora
                WHERE modelo LIKE '%$texto%' OR
                    nome LIKE '%$texto%' OR
                    serial LIKE '%$texto%'
                ORDER BY idimpressora ASC");
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
        $impressora = new Impressora_model();
        //atribue valores do resultado
        $impressora->setIdimpressora($r->idimpressora);
        $impressora->setModelo($r->modelo);
        $impressora->setSerial($r->serial);
        $impressora->setNome($r->nome);
        $impressora->setDescricao($r->descricao);
        $impressora->setIdlocal($r->idlocal);
        
        return $impressora;
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
    function getIdimpressora() {
        return $this->idimpressora;
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

    function setIdimpressora($idimpressora) {
        $this->idimpressora = $idimpressora;
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
