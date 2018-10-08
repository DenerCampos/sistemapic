<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Antropometria_model extends CI_Model {

    /**
     * Antropometria_model
     * Faz parte do função avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idantropometria; // identificador (INT)
    var $pescoco; // (FLOAT)
    var $ombros; // (FLOAT)
    var $torax; // (FLOAT)
    var $cintura; // (FLOAT)
    var $abdomem; // (FLOAT)
    var $quadril; // (FLOAT)
    var $coxa_direita; // (FLOAT)
    var $coxa_esquerda; // (FLOAT)
    var $panturilha_direita; // (FLOAT)
    var $panturilha_esquerda; // (FLOAT)
    var $braco_direito; // (FLOAT)
    var $braco_esquerdo; // (FLOAT)
    var $antebraco_direito; // (FLOAT)
    var $antebraco_esquerdo; // (FLOAT)
    var $idavaliacao; //identificador da avaliacao // (INT)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //novo contato
    public function novo($pescoco, $ombros, $torax, $cintura, $abdomem, $quadril, $coxa_direita, $coxa_esquerda, $panturilha_direita, 
            $panturilha_esquerda, $braco_direito, $braco_esquerdo, $antebraco_direito, $antebraco_esquerdo, $idavaliacao){
        $this->setPescoco($pescoco);
        $this->setOmbros($ombros);
        $this->setTorax($torax);
        $this->setCintura($cintura);
        $this->setAbdomem($abdomem);
        $this->setQuadril($quadril);
        $this->setCoxa_direita($coxa_direita);
        $this->setCoxa_esquerda($coxa_esquerda);
        $this->setPanturilha_direita($panturilha_direita);
        $this->setPanturilha_esquerda($panturilha_esquerda);
        $this->setBraco_direito($braco_direito);
        $this->setBraco_esquerdo($braco_esquerdo);
        $this->setAntebraco_direito($antebraco_direito);
        $this->setAntebraco_esquerdo($antebraco_esquerdo);
        $this->setIdavaliacao($idavaliacao);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("antropometria", $this);
    }
    
    //Atualiza
    public function atualiza($pescoco, $ombros, $torax, $cintura, $abdomem, $quadril, $coxa_direita, $coxa_esquerda, $panturilha_direita, 
            $panturilha_esquerda, $braco_direito, $braco_esquerdo, $antebraco_direito, $antebraco_esquerdo, $idavaliacao){
        $dados = array(
            "pescoco" => $pescoco,
            "ombros" => $ombros,
            "torax" => $torax,
            "cintura" => $cintura,
            "abdomem" => $abdomem,
            "quadril" => $quadril,
            "coxa_direita" => $coxa_direita,
            "coxa_esquerda" => $coxa_esquerda,
            "panturilha_direita" => $panturilha_direita,
            "panturilha_esquerda" => $panturilha_esquerda,
            "braco_direito" => $braco_direito,
            "braco_esquerdo" => $braco_esquerdo,
            "antebraco_direito" => $antebraco_direito,
            "antebraco_esquerdo" => $antebraco_esquerdo
        );
        $this->db->set($dados);
        $this->db->where('idavaliacao', $idavaliacao);
        $this->db->update('antropometria');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idantropometria', $id);
        $this->db->delete('antropometria');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM antropometria");
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
                FROM antropometria
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
        $base = new Antropometria_model();
        //atribue valores do resultado
        $base->setIdantropometria($r->idantropometria);
        $base->setPescoco($r->pescoco);
        $base->setOmbros($r->ombros);
        $base->setTorax($r->torax);
        $base->setCintura($r->cintura);
        $base->setAbdomem($r->abdomem);
        $base->setQuadril($r->quadril);
        $base->setCoxa_direita($r->coxa_direita);
        $base->setCoxa_esquerda($r->coxa_esquerda);
        $base->setPanturilha_direita($r->panturilha_direita);
        $base->setPanturilha_esquerda($r->panturilha_esquerda);
        $base->setBraco_direito($r->braco_direito);
        $base->setBraco_esquerdo($r->braco_esquerdo);
        $base->setAntebraco_direito($r->antebraco_direito);
        $base->setAntebraco_esquerdo($r->antebraco_esquerdo);
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
    function getIdantropometria() {
        return $this->idantropometria;
    }

    function getPescoco() {
        return $this->pescoco;
    }

    function getOmbros() {
        return $this->ombros;
    }

    function getTorax() {
        return $this->torax;
    }

    function getCintura() {
        return $this->cintura;
    }

    function getAbdomem() {
        return $this->abdomem;
    }

    function getQuadril() {
        return $this->quadril;
    }

    function getCoxa_direita() {
        return $this->coxa_direita;
    }

    function getCoxa_esquerda() {
        return $this->coxa_esquerda;
    }

    function getPanturilha_direita() {
        return $this->panturilha_direita;
    }

    function getPanturilha_esquerda() {
        return $this->panturilha_esquerda;
    }

    function getBraco_direito() {
        return $this->braco_direito;
    }

    function getBraco_esquerdo() {
        return $this->braco_esquerdo;
    }

    function getAntebraco_direito() {
        return $this->antebraco_direito;
    }

    function getAntebraco_esquerdo() {
        return $this->antebraco_esquerdo;
    }

    function getIdavaliacao() {
        return $this->idavaliacao;
    }

    function setIdantropometria($idantropometria) {
        $this->idantropometria = $idantropometria;
    }

    function setPescoco($pescoco) {
        $this->pescoco = $pescoco;
    }

    function setOmbros($ombros) {
        $this->ombros = $ombros;
    }

    function setTorax($torax) {
        $this->torax = $torax;
    }

    function setCintura($cintura) {
        $this->cintura = $cintura;
    }

    function setAbdomem($abdomem) {
        $this->abdomem = $abdomem;
    }

    function setQuadril($quadril) {
        $this->quadril = $quadril;
    }

    function setCoxa_direita($coxa_direita) {
        $this->coxa_direita = $coxa_direita;
    }

    function setCoxa_esquerda($coxa_esquerda) {
        $this->coxa_esquerda = $coxa_esquerda;
    }

    function setPanturilha_direita($panturilha_direita) {
        $this->panturilha_direita = $panturilha_direita;
    }

    function setPanturilha_esquerda($panturilha_esquerda) {
        $this->panturilha_esquerda = $panturilha_esquerda;
    }

    function setBraco_direito($braco_direito) {
        $this->braco_direito = $braco_direito;
    }

    function setBraco_esquerdo($braco_esquerdo) {
        $this->braco_esquerdo = $braco_esquerdo;
    }

    function setAntebraco_direito($antebraco_direito) {
        $this->antebraco_direito = $antebraco_direito;
    }

    function setAntebraco_esquerdo($antebraco_esquerdo) {
        $this->antebraco_esquerdo = $antebraco_esquerdo;
    }

    function setIdavaliacao($idavaliacao) {
        $this->idavaliacao = $idavaliacao;
    }


}
