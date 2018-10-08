<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fisioterapico_model extends CI_Model {

    /**
     * Fisioterapico_model
     * Faz parte do função avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idfisioterapico; //identificador (INT)
    var $postura; // (TEXT)
    var $coluna_vertebral; // (TEXT)
    var $forca_muscular; // (TEXT)
    var $adm; // (TEXT)
    var $atividade_proposta; // (TEXT)
    var $objetivo_atividade; // (TEXT)
    var $exercicio_contra_indicado; // (TEXT)
    var $conduta; // (TEXT)
    var $idavaliacao; //identificador da avaliação (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($postura, $coluna_vertebral, $forca_muscular, $adm, $atividade_proposta, $objetivo_atividade,
            $exercicio_contra_indicado, $conduta, $idavaliacao){
        $this->setPostura($postura);
        $this->setColuna_vertebral($coluna_vertebral);
        $this->setForca_muscular($forca_muscular);
        $this->setAdm($adm);
        $this->setAtividade_proposta($atividade_proposta);
        $this->setObjetivo_atividade($objetivo_atividade);
        $this->setExercicio_contra_indicado($exercicio_contra_indicado);
        $this->setConduta($conduta);
        $this->setIdavaliacao($idavaliacao);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("fisioterapico", $this);
    }
    
    //Atualiza
    public function atualiza($postura, $coluna_vertebral, $forca_muscular, $adm, $atividade_proposta, $objetivo_atividade,
            $exercicio_contra_indicado, $conduta, $idavaliacao){
        $dados = array(
            "postura" => $postura,
            "coluna_vertebral" => $coluna_vertebral,
            "forca_muscular" => $forca_muscular,
            "adm" => $adm,
            "atividade_proposta" => $atividade_proposta,
            "objetivo_atividade" => $objetivo_atividade,
            "exercicio_contra_indicado" => $exercicio_contra_indicado,
            "conduta" => $conduta
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $idavaliacao);
        $this->db->update('fisioterapico');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idfisioterapico', $id);
        $this->db->delete('fisioterapico');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM fisioterapico");
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
                FROM fisioterapico
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
        $base = new Fisioterapico_model();
        //atribue valores do resultado
        $base->setIdfisioterapico($r->idfisioterapico);
        $base->setPostura($r->postura);
        $base->setColuna_vertebral($r->coluna_vertebral);
        $base->setForca_muscular($r->forca_muscular);
        $base->setAdm($r->adm);
        $base->setAtividade_proposta($r->atividade_proposta);
        $base->setObjetivo_atividade($r->objetivo_atividade);
        $base->setExercicio_contra_indicado($r->exercicio_contra_indicado);
        $base->setConduta($r->conduta);
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
    function getIdfisioterapico() {
        return $this->idfisioterapico;
    }

    function getPostura() {
        return $this->postura;
    }

    function getColuna_vertebral() {
        return $this->coluna_vertebral;
    }

    function getForca_muscular() {
        return $this->forca_muscular;
    }

    function getAdm() {
        return $this->adm;
    }

    function getAtividade_proposta() {
        return $this->atividade_proposta;
    }

    function getObjetivo_atividade() {
        return $this->objetivo_atividade;
    }

    function getExercicio_contra_indicado() {
        return $this->exercicio_contra_indicado;
    }

    function getConduta() {
        return $this->conduta;
    }

    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function setIdfisioterapico($idfisioterapico) {
        $this->idfisioterapico = $idfisioterapico;
    }

    function setPostura($postura) {
        $this->postura = $postura;
    }

    function setColuna_vertebral($coluna_vertebral) {
        $this->coluna_vertebral = $coluna_vertebral;
    }

    function setForca_muscular($forca_muscular) {
        $this->forca_muscular = $forca_muscular;
    }

    function setAdm($adm) {
        $this->adm = $adm;
    }

    function setAtividade_proposta($atividade_proposta) {
        $this->atividade_proposta = $atividade_proposta;
    }

    function setObjetivo_atividade($objetivo_atividade) {
        $this->objetivo_atividade = $objetivo_atividade;
    }

    function setExercicio_contra_indicado($exercicio_contra_indicado) {
        $this->exercicio_contra_indicado = $exercicio_contra_indicado;
    }

    function setConduta($conduta) {
        $this->conduta = $conduta;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }


}
