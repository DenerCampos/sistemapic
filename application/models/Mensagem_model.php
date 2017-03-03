<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_modal extends CI_Model {

    /**
     * Mensagem model
     * 
     * @autor: Dener Junio
     * @desc: Troca de mensagem entre os usuarios
     */
    
     /*------Atributos--------*/
    var $idmensagem;
    var $assunto;
    var $corpo;
    var $data;
    var $data_lida;
    var $usuario_recebe;
    var $usuario_envia; 

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $mensagem = new Mensagem_modal();
        //atribue valores do resultado
        $mensagem->setIdmensagem($r->idmensagem);
        $mensagem->setAssunto($r->assunto);
        $mensagem->setCorpo($r->corpo);
        $mensagem->setData($r->data);
        $mensagem->setData_lida($r->data_lida);
        $mensagem->setUsuario_recebe($r->usuario_recebe);
        $mensagem->setUsuario_envia($r->usuario_envia);
        
        return $mensagem;
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
    function getIdmensagem() {
        return $this->idmensagem;
    }

    function getAssunto() {
        return $this->assunto;
    }

    function getCorpo() {
        return $this->corpo;
    }

    function getData() {
        return $this->data;
    }

    function getData_lida() {
        return $this->data_lida;
    }

    function getUsuario_recebe() {
        return $this->usuario_recebe;
    }

    function getUsuario_envia() {
        return $this->usuario_envia;
    }

    function setIdmensagem($idmensagem) {
        $this->idmensagem = $idmensagem;
    }

    function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    function setCorpo($corpo) {
        $this->corpo = $corpo;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setData_lida($data_lida) {
        $this->data_lida = $data_lida;
    }

    function setUsuario_recebe($usuario_recebe) {
        $this->usuario_recebe = $usuario_recebe;
    }

    function setUsuario_envia($usuario_envia) {
        $this->usuario_envia = $usuario_envia;
    }


}
