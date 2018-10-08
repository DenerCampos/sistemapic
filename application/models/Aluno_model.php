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
    //novo contato
    public function novo($nome, $email, $idade, $sexo, $cota, $estado_civil, $profissao, $posicao_trabalho){
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdade($idade);
        $this->setSexo($sexo);
        $this->setCota($cota);
        $this->setEstado_civil($estado_civil);
        $this->setProfissao($profissao);
        $this->setPosicao_trabalho($posicao_trabalho);
    }
    
    //Adiciona
    public function adiciona(){
        $this->db->insert("aluno", $this);
    }
    
    //Atualiza
    public function atualiza($id, $nome, $email, $idade, $sexo, $cota, $estado_civil, $profissao, $posicao_trabalho){
        $dados = array(
            "nome" => $nome,
            "email" => $email,
            "idade" => $idade,
            "sexo" => $sexo,
            "cota" => $cota,
            "estado_civil" => $estado_civil,
            "profissao" => $profissao,
            "posicao_trabalho" => $posicao_trabalho
        );
        $this->db->set($dados);
        $this->db->where('idaluno', $id);
        $this->db->update('aluno');
    }
    
    //Remove
    public function remove($id){
        $this->db->where('idaluno', $id);
        $this->db->delete('aluno');
    }
    
    //Buscar todos
    public function todos(){
         $query = $this->db->query(
                "SELECT *
                FROM aluno");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca aluno por caracter (avaliação novo)
    public function buscaAlunoTermo($termo){
        $query = $this->db->query(
                "SELECT *
                FROM aluno                 
                WHERE nome like '%$termo%'
                ORDER BY nome ASC");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Verifica se a existe nome do aluno e cota para criação de um novo
    public function verificaNomeCota($nome, $cota){
        $query = $this->db->query(
                "SELECT *
                FROM aluno 
                WHERE nome = '$nome' OR
                    cota = $cota");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se a existe nome do aluno e cota para criação de um novo
    public function verificaNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM aluno 
                WHERE nome = '$nome'");
        //retorna objeto usuario
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca por nome
    public function verificaPorNome($nome){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE nome = '$nome'");
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    
    //Busca por nome
    public function buscaPorNome($nome){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE nome = '$nome'");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    public function buscaPorId($id){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE idaluno = $id");
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Verificar se existe nome do aluno 
    public function existeNomeAluno($nome){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE nome = '$nome'");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se existe cota
    public function existeCota($cota){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE cota = $cota");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verifica se existe ID
    public function existeId($id){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE idaluno = $id");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Verificar se existe nome ja cadastrado com outro id
    public function existeNomeAlunoId($nome, $idaluno){
        $query = $this->db->query(
                "SELECT * 
                FROM aluno
                WHERE nome = '$nome' AND
                idaluno <> $idaluno");
        if ($query->num_rows() > 0){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    public function busca($texto, $limite = null){
        //Seleção
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM aluno
                WHERE nome LIKE '%$texto%' OR
                    cota LIKE '%$texto%' 
                ORDER BY idaluno DESC
                LIMIT $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM aluno
                WHERE nome LIKE '%$texto%' OR
                    cota LIKE '%$texto%' 
                ORDER BY idaluno DESC");
        }
        
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
