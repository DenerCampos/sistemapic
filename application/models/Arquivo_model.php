<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo_model extends CI_Model {

    /**
     * Usuario
     * @description: Classe arquivo, armazena dados dos aquivos anexados no helpdesk
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idarquivo; //identificador
    var $nome; //nome arquivo
    var $local; //pasta onde arquivo esta armazenado
    var $nome_antigo; //nome antigo do arquivo
    var $idocorrencia; //id da ocorrencia (chamado)

    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    
    //Instancia novo arquivo
    public function newArquivo($nome, $local, $nome_antigo, $idocorrencia){
        $this->setNome($nome);
        $this->setLocal($local);
        $this->setNome_antigo($nome_antigo);
        $this->setIdocorrencia($idocorrencia);
    }
    
    //Insere usuario
    public function addArquivo(){
        $this->db->insert("arquivo", $this);
    }    
    
    //Remover arquivo
    public function removerArquivo($id){
        $this->db->where('idarquivo', $id);
        $this->db->delete('arquivo');
    }  

    //Busca arquivo por ocorrencia
    public function buscaOcorrencia($id){
        $query = $this->db->query(
                "SELECT *
                FROM arquivo 
                WHERE idocorrencia = '$id'");
        //retorna objeto
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca arquivo por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM arquivo 
                WHERE idarquivo = $id");
        //retorna objeto usuario
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }      
    
    //Contar todos registros
    public function contarTodos(){
        return $this->db->count_all('arquivo');
    }

    /*------Funções internas--------*/ 
    //Retorna objeto
    private function getObjByRow($r){
        //cria novo objeto
        $arquivo = new Arquivo_model();
        //atribue valores do resultado
        $arquivo->setIdarquivo($r->idarquivo);
        $arquivo->setNome($r->nome);
        $arquivo->setLocal($r->local);
        $arquivo->setNome_antigo($r->nome_antigo);
        $arquivo->setIdocorrencia($r->idocorrencia);
        
        return $arquivo;
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
    function getIdarquivo() {
        return $this->idarquivo;
    }

    function getNome() {
        return $this->nome;
    }

    function getLocal() {
        return $this->local;
    }

    function getNome_antigo() {
        return $this->nome_antigo;
    }

    function getIdocorrencia() {
        return $this->idocorrencia;
    }

    function setIdarquivo($idarquivo) {
        $this->idarquivo = $idarquivo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setNome_antigo($nome_antigo) {
        $this->nome_antigo = $nome_antigo;
    }

    function setIdocorrencia($idocorrencia) {
        $this->idocorrencia = $idocorrencia;
    }


}
