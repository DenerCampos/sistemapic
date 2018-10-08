<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aerobica_model extends CI_Model {

    /**
     * Aerobica
     * Parte do sistema de avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idaerobica; //identificardor (INT)
    var $freq_cardiaca_max; // (FLOAT)
    var $freq_rep; // (FLOAT)
    var $freq_cardiaca_treino; // (FLOAT)
    var $idavaliacao; // itentificador avaliacao (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($freq_cardiaca_max, $freq_rep, $freq_cardiaca_treino, $idavaliacao){
        $this->setFreq_cardiaca_max($freq_cardiaca_max);
        $this->setFreq_rep($freq_rep);
        $this->setFreq_cardiaca_treino($freq_cardiaca_treino);
        $this->setIdavaliacao($idavaliacao);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("aerobica", $this);
        return 	$this->db->insert_id();
    }
    
    //Atualiza
    public function atualiza($freq_cardiaca_max, $freq_rep, $freq_cardiaca_treino, $idavaliacao){
        $dados = array(
            "freq_cardiaca_max" => $freq_cardiaca_max,
            "freq_rep" => $freq_rep,
            "freq_cardiaca_treino" => $freq_cardiaca_treino           
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $idavaliacao);
        $this->db->update('aerobica');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idaerobica', $id);
        $this->db->delete('aerobica');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Buscar por id avaliação
    public function BuscarPorIdavaliacao($idavaliacao){
         $query = $this->db->query(
                "SELECT *
                FROM aerobica
                WHERE idavaliacao = $idavaliacao");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca por ID
    public function buscaPorIdAva($id){
        $query = $this->db->query(
                "SELECT * 
                FROM aerobica
                WHERE idavaliacao = $id");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $aerobica = new Aerobica_model();
        //atribue valores do resultado
        $aerobica->setIdaerobica($r->idaerobica);
        $aerobica->setFreq_cardiaca_max($r->freq_cardiaca_max);
        $aerobica->setFreq_rep($r->freq_rep);
        $aerobica->setFreq_cardiaca_treino($r->freq_cardiaca_treino);
        $aerobica->setIdavaliacao($r->idavaliacao);
        
        return $aerobica;
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
    function getIdaerobica() {
        return $this->idaerobica;
    }

    function getFreq_cardiaca_max() {
        return $this->freq_cardiaca_max;
    }

    function getFreq_rep() {
        return $this->freq_rep;
    }

    function getFreq_cardiaca_treino() {
        return $this->freq_cardiaca_treino;
    }

    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function setIdaerobica($idaerobica) {
        $this->idaerobica = $idaerobica;
    }

    function setFreq_cardiaca_max($freq_cardiaca_max) {
        $this->freq_cardiaca_max = $freq_cardiaca_max;
    }

    function setFreq_rep($freq_rep) {
        $this->freq_rep = $freq_rep;
    }

    function setFreq_cardiaca_treino($freq_cardiaca_treino) {
        $this->freq_cardiaca_treino = $freq_cardiaca_treino;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }


}
