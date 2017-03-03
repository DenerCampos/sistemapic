<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {

    /**
     * Base para arquivo model
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $base;
    var $exemplo;

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $base = new Base_model();
        //atribue valores do resultado
        $base->setBase($r->base);
        $base->setExemplo($r->exemplo);
        
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
    function getBase() {
        return $this->base;
    }

    function getExemplo() {
        return $this->exemplo;
    }

    function setBase($base) {
        $this->base = $base;
    }

    function setExemplo($exemplo) {
        $this->exemplo = $exemplo;
    }


}
