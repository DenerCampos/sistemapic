<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aerobica_teste_model extends CI_Model {

    /**
     * Aerobica_teste
     * Parte do sistema de avaliação da parte aerobica
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idaerobica_teste; //identificador (INT)
    var $velocidade; // (INT)
    var $tempo; // (INT)
    var $freq_cardiaca; //(FLOAT)
    var $pse; // (FLOAT)
    var $momento_corrida; //(FLOAT)
    var $idaerobica; //identificardor aerobica (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($velocidade, $tempo, $freq_cardiaca, $pse, $momento_corrida, $idaerobica){
        $this->setVelocidade($velocidade);
        $this->setTempo($tempo);
        $this->setFreq_cardiaca($freq_cardiaca);
        $this->setPse($pse);
        $this->setMomento_corrida($momento_corrida);
        $this->setIdaerobica($idaerobica);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("aerobica_teste", $this);
    }
    
    //Atualiza
    public function atualiza($id, $velocidade, $tempo, $freq_cardiaca, $pse, $momento_corrida, $idaerobica){
        $dados = array(
            "velocidade" => $velocidade,
            "tempo" => $tempo,
            "freq_cardiaca" => $freq_cardiaca,
            "pse" => $pse,
            "momento_corrida" => $momento_corrida,
            "idaerobica" => $idaerobica
        );
        $this->db->set($dados);
        $this->db->where('idaerobica_teste', $id);
        $this->db->update('aerobica_teste');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idaerobica_teste', $id);
        $this->db->delete('aerobica_teste');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica_teste");
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
                FROM aerobica_teste
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
        $aerobicat = new Aerobica_teste_model();
        //atribue valores do resultado
        $aerobicat->setIdaerobica_teste($r->idaerobica_teste);
        $aerobicat->setVelocidade($r->velocidade);
        $aerobicat->setTempo($r->tempo);
        $aerobicat->setFreq_cardiaca($r->freq_cardiaca);
        $aerobicat->setPse($r->pse);
        $aerobicat->setMomento_corrida($r->momento_corrida);
        $aerobicat->setIdaerobica($r->idaerobica);
        
        return $aerobicat;
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
    function getIdaerobica_teste() {
        return $this->idaerobica_teste;
    }

    function getVelocidade() {
        return $this->velocidade;
    }

    function getTempo() {
        return $this->tempo;
    }

    function getFreq_cardiaca() {
        return $this->freq_cardiaca;
    }

    function getPse() {
        return $this->pse;
    }

    function getMomento_corrida() {
        return $this->momento_corrida;
    }

    function getIdaerobica() {
        return $this->idaerobica;
    }

    function setIdaerobica_teste($idaerobica_teste) {
        $this->idaerobica_teste = $idaerobica_teste;
    }

    function setVelocidade($velocidade) {
        $this->velocidade = $velocidade;
    }

    function setTempo($tempo) {
        $this->tempo = $tempo;
    }

    function setFreq_cardiaca($freq_cardiaca) {
        $this->freq_cardiaca = $freq_cardiaca;
    }

    function setPse($pse) {
        $this->pse = $pse;
    }

    function setMomento_corrida($momento_corrida) {
        $this->momento_corrida = $momento_corrida;
    }

    function setIdaerobica($idaerobica) {
        $this->idaerobica = $idaerobica;
    }


}
