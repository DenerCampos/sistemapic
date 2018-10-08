<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clinico_model extends CI_Model {

    /**
     * Clinico_model
     * Faz parte da função de avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idclinico; //identificador (INT)
    var $lesao_articular; //(TEXT)
    var $coluna; //(TEXT)
    var $cardiologico; //(TEXT)
    var $varizes; //(TEXT)
    var $cirurgias; //(TEXT)
    var $hernia; //(TEXT)
    var $pulso; //(TEXT)
    var $pa; //(TEXT)
    var $historia_familiar; //(TEXT)
    var $medicamentos; //(TEXT)
    var $informacoes; //(TEXT)
    var $idavaliacao; // identificador da avaliação (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($lesao_articular, $coluna, $cardiologico, $varizes, $cirurgias, $hernia, $pulso, 
            $pa, $historia_familiar, $medicamentos, $informacoes, $idavaliacao){
        $this->setLesao_articular($lesao_articular);
        $this->setColuna($coluna);
        $this->setCardiologico($cardiologico);
        $this->setVarizes($varizes);
        $this->setCirurgias($cirurgias);
        $this->setHernia($hernia);
        $this->setPulso($pulso);
        $this->setPa($pa);
        $this->setHistoria_familiar($historia_familiar);
        $this->setMedicamentos($medicamentos);
        $this->setInformacoes($informacoes);
        $this->setIdavaliacao($idavaliacao);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("clinico", $this);
    }
    
    //Atualiza
    public function atualiza($lesao_articular, $coluna, $cardiologico, $varizes, $cirurgias, $hernia, $pulso, 
            $pa, $historia_familiar, $medicamentos, $informacoes, $idavaliacao){
        $dados = array(
            "lesao_articular" => $lesao_articular,
            "coluna" => $coluna,
            "cardiologico" => $cardiologico,
            "varizes" => $varizes,
            "cirurgias" => $cirurgias,
            "hernia" => $hernia,
            "pulso" => $pulso,
            "pa" => $pa,
            "historia_familiar" => $historia_familiar,
            "medicamentos" => $medicamentos,
            "informacoes" => $informacoes
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $idavaliacao);
        $this->db->update('clinico');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idclinico', $id);
        $this->db->delete('clinico');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM clinico");
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
                FROM clinico
                WHERE idavaliacao = $idavaliacao");
        //retorna objeto ip
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
        $base = new Clinico_model();
        //atribue valores do resultado        
        $base->setIdclinico($r->idclinico);
        $base->setLesao_articular($r->lesao_articular);
        $base->setColuna($r->coluna);
        $base->setCardiologico($r->cardiologico);
        $base->setVarizes($r->varizes);
        $base->setCirurgias($r->cirurgias);
        $base->setHernia($r->hernia);
        $base->setPulso($r->pulso);
        $base->setPa($r->pa);
        $base->setHistoria_familiar($r->historia_familiar);
        $base->setMedicamentos($r->medicamentos);
        $base->setInformacoes($r->informacoes);
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
    function getIdclinico() {
        return $this->idclinico;
    }

    function getLesao_articular() {
        return $this->lesao_articular;
    }

    function getColuna() {
        return $this->coluna;
    }

    function getCardiologico() {
        return $this->cardiologico;
    }

    function getVarizes() {
        return $this->varizes;
    }

    function getCirurgias() {
        return $this->cirurgias;
    }

    function getHernia() {
        return $this->hernia;
    }

    function getPulso() {
        return $this->pulso;
    }

    function getPa() {
        return $this->pa;
    }

    function getHistoria_familiar() {
        return $this->historia_familiar;
    }

    function getMedicamentos() {
        return $this->medicamentos;
    }

    function getInformacoes() {
        return $this->informacoes;
    }

    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function setIdclinico($idclinico) {
        $this->idclinico = $idclinico;
    }

    function setLesao_articular($lesao_articular) {
        $this->lesao_articular = $lesao_articular;
    }

    function setColuna($coluna) {
        $this->coluna = $coluna;
    }

    function setCardiologico($cardiologico) {
        $this->cardiologico = $cardiologico;
    }

    function setVarizes($varizes) {
        $this->varizes = $varizes;
    }

    function setCirurgias($cirurgias) {
        $this->cirurgias = $cirurgias;
    }

    function setHernia($hernia) {
        $this->hernia = $hernia;
    }

    function setPulso($pulso) {
        $this->pulso = $pulso;
    }

    function setPa($pa) {
        $this->pa = $pa;
    }

    function setHistoria_familiar($historia_familiar) {
        $this->historia_familiar = $historia_familiar;
    }

    function setMedicamentos($medicamentos) {
        $this->medicamentos = $medicamentos;
    }

    function setInformacoes($informacoes) {
        $this->informacoes = $informacoes;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }


}
