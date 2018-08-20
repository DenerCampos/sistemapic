<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends CI_Model {

    /**
     * Aluno
     * Registro dos alunos do modulo avaliação
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idaluno; //Identificardo do aluno
    var $nome; // Nome do aluno
    var $email; //Email do aluno
    var $idade; //Idade do aluno
    var $sexo; //Sexo do aluno
    var $cota; //Numero da cota do associado PIC
    var $estado_civil; //Estado civil
    var $profissao; //Profissão
    var $posicao_trabalho; //Posição que fica no trabalho (sentado, em pé...)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    
    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $aluno = new Aluno_model();
        //atribue valores do resultado
        $aluno->setIdaluno($r->idaluno);
        $aluno->setNome($r->nome);
        $aluno->setEmail($r->email);
        $aluno->setIdade($r->idade);
        $aluno->setSexo($r->sexo);
        $aluno->setCota($r->cota);
        $aluno->setEstado_civil($r->estado_civil);
        $aluno->setProfissao($r->profissao);
        $aluno->setPosicao_trabalho($r->posicao_trabalho);
        
        return $aluno;
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
    function getIdaluno() {
        return $this->idaluno;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdade() {
        return $this->idade;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getCota() {
        return $this->cota;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getProfissao() {
        return $this->profissao;
    }

    function getPosicao_trabalho() {
        return $this->posicao_trabalho;
    }

    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setCota($cota) {
        $this->cota = $cota;
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
    }

    function setPosicao_trabalho($posicao_trabalho) {
        $this->posicao_trabalho = $posicao_trabalho;
    }


}
