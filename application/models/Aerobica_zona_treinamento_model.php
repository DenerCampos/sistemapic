<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aerobica_zona_treinamento_model extends CI_Model {

    /**
     * Aerobica_zona_treinamento_model 
     * Aerobica zona treinamento faz parte da aerobica da avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idaerobica_zona_treinamento; // identificação (INT)
    var $zona_treinamento; // (TEXT)
    var $porcentagem; // (INT)
    var $bpm; //(INT)
    var $idaerobica; // identificador aerobica(INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($zona_treinamento, $porcentagem, $bpm, $idaerobica){
        $this->setZona_treinamento($zona_treinamento);
        $this->setPorcentagem($porcentagem);
        $this->setBpm($bpm);
        $this->setIdaerobica($idaerobica);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("aerobica_zona_treinamento", $this);
    }
    
    //Atualiza
    public function atualiza($id, $zona_treinamento, $porcentagem, $bpm, $idaerobica){
        $dados = array(
            "zona_treinamento" => $zona_treinamento,
            "porcentagem" => $porcentagem,
            "bpm" => $bpm,
            "idaerobica" => $idaerobica,
        );
        $this->db->set($dados);
        $this->db->where('idaerobica_zona_treinamento', $id);
        $this->db->update('aerobica_zona_treinamento');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idaerobica_zona_treinamento', $id);
        $this->db->delete('aerobica_zona_treinamento');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica_zona_treinamento");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar por id aerobica
    public function BuscarPorIdaerobica($idaerobica){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica_zona_treinamento
                WHERE idaerobica = $idaerobica");
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
        $base = new Aerobica_zona_treinamento_model();
        //atribue valores do resultado
        $base->setIdaerobica_zona_treinamento($r->idaerobica_zona_treinamento);
        $base->setZona_treinamento($r->zona_treinamento);
        $base->setPorcentagem($r->porcentagem);
        $base->setBpm($r->bpm);
        $base->setIdaerobica($r->idaerobica);
        
        return $base;
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
    function getIdaerobica_zona_treinamento() {
        return $this->idaerobica_zona_treinamento;
    }

    function getZona_treinamento() {
        return $this->zona_treinamento;
    }

    function getPorcentagem() {
        return $this->porcentagem;
    }

    function getBpm() {
        return $this->bpm;
    }

    function getIdaerobica() {
        return $this->idaerobica;
    }

    function setIdaerobica_zona_treinamento($idaerobica_zona_treinamento) {
        $this->idaerobica_zona_treinamento = $idaerobica_zona_treinamento;
    }

    function setZona_treinamento($zona_treinamento) {
        $this->zona_treinamento = $zona_treinamento;
    }

    function setPorcentagem($porcentagem) {
        $this->porcentagem = $porcentagem;
    }

    function setBpm($bpm) {
        $this->bpm = $bpm;
    }

    function setIdaerobica($idaerobica) {
        $this->idaerobica = $idaerobica;
    }


}
