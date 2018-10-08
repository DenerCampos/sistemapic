<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bioimpedancia_model extends CI_Model {

    /**
     * Bioimpedancia_model
     * Faz parte da função avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idbioimpedancia; //identificador (INT)
    var $peso; // (FLOAT)
    var $altura; // (FLOAT)
    var $imc; // (FLOAT)
    var $agua; // (FLOAT)
    var $agua_l; // (FLOAT)
    var $gordura_corporal; // (FLOAT)
    var $peso_gordura; // (FLOAT)
    var $gordura_alvo; // (FLOAT)
    var $massa_magra; // (FLOAT)
    var $massa_magra_kg; // (FLOAT)
    var $indice_muscular; // (FLOAT)
    var $idavaliacao; // (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($peso, $altura, $imc, $agua, $agua_l, $gordura_corporal, $peso_gordura, $gordura_alvo, 
            $massa_magra, $massa_magra_kg, $indice_muscular, $idavaliacao){
        $this->setPeso($peso);
        $this->setAltura($altura);
        $this->setImc($imc);
        $this->setAgua($agua);
        $this->setAgua_l($agua_l);
        $this->setGordura_corporal($gordura_corporal);
        $this->setPeso_gordura($peso_gordura);
        $this->setGordura_alvo($gordura_alvo);
        $this->setMassa_magra($massa_magra);
        $this->setMassa_magra_kg($massa_magra_kg);
        $this->setIndice_muscular($indice_muscular);
        $this->setIdavaliacao($idavaliacao);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("bioimpedancia", $this);
    }
    
    //Atualiza
    public function atualiza($peso, $altura, $imc, $agua, $agua_l, $gordura_corporal, $peso_gordura, $gordura_alvo, 
            $massa_magra, $massa_magra_kg, $indice_muscular, $idavaliacao){
        $dados = array(
            "peso" => $peso,
            "altura" => $altura,
            "imc" => $imc,
            "agua" => $agua,
            "agua_l" => $agua_l,
            "gordura_corporal" => $gordura_corporal,
            "peso_gordura" => $peso_gordura,
            "gordura_alvo" => $gordura_alvo,
            "massa_magra" => $massa_magra,
            "massa_magra_kg" => $massa_magra_kg,
            "indice_muscular" => $indice_muscular
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $idavaliacao);
        $this->db->update('bioimpedancia');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idbioimpedancia', $id);
        $this->db->delete('bioimpedancia');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM bioimpedancia");
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
                FROM bioimpedancia
                WHERE idavaliacao = $idavaliacao");
        //retorna objeto
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
        $base = new Bioimpedancia_model();
        //atribue valores do resultado
        $base->setIdbioimpedancia($r->idbioimpedancia);
        $base->setPeso($r->peso);
        $base->setAltura($r->altura);
        $base->setImc($r->imc);
        $base->setAgua($r->agua);
        $base->setAgua_l($r->agua_l);
        $base->setGordura_corporal($r->gordura_corporal);
        $base->setPeso_gordura($r->peso_gordura);
        $base->setGordura_alvo($r->gordura_alvo);
        $base->setMassa_magra($r->massa_magra);
        $base->setMassa_magra_kg($r->massa_magra_kg);
        $base->setIndice_muscular($r->indice_muscular);
        $base->setIdavaliacao($r->idavaliacao);
        
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
    function getIdbioimpedancia() {
        return $this->idbioimpedancia;
    }

    function getPeso() {
        return $this->peso;
    }

    function getAltura() {
        return $this->altura;
    }

    function getImc() {
        return $this->imc;
    }

    function getAgua() {
        return $this->agua;
    }

    function getAgua_l() {
        return $this->agua_l;
    }

    function getGordura_corporal() {
        return $this->gordura_corporal;
    }

    function getPeso_gordura() {
        return $this->peso_gordura;
    }

    function getGordura_alvo() {
        return $this->gordura_alvo;
    }

    function getMassa_magra() {
        return $this->massa_magra;
    }

    function getMassa_magra_kg() {
        return $this->massa_magra_kg;
    }

    function getIndice_muscular() {
        return $this->indice_muscular;
    }

    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function setIdbioimpedancia($idbioimpedancia) {
        $this->idbioimpedancia = $idbioimpedancia;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setImc($imc) {
        $this->imc = $imc;
    }

    function setAgua($agua) {
        $this->agua = $agua;
    }

    function setAgua_l($agua_l) {
        $this->agua_l = $agua_l;
    }

    function setGordura_corporal($gordura_corporal) {
        $this->gordura_corporal = $gordura_corporal;
    }

    function setPeso_gordura($peso_gordura) {
        $this->peso_gordura = $peso_gordura;
    }

    function setGordura_alvo($gordura_alvo) {
        $this->gordura_alvo = $gordura_alvo;
    }

    function setMassa_magra($massa_magra) {
        $this->massa_magra = $massa_magra;
    }

    function setMassa_magra_kg($massa_magra_kg) {
        $this->massa_magra_kg = $massa_magra_kg;
    }

    function setIndice_muscular($indice_muscular) {
        $this->indice_muscular = $indice_muscular;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }


}
