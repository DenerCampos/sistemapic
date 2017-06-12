<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao_model extends CI_Model {

    /**
     * Manutenção: manutenção de equipamentos do PIC
     * 
     * @autor: Dener Junio
     *
     */
    
     /*------Atributos--------*/
    var $idmanutencao; //id manutenção
    var $equipamento; //nome do equipamento para manutenção
    var $defeito; //defeito do equipamento
    var $data_defeito; //data que ocorreu o defeito
    var $data_entrega; //data da entrega para a manutenção
    var $data_retorno; //data de retorno da manutenção
    var $garantia; //tempo de garantia em dias
    var $data_garantia; //data do fim da garantia
    var $data_reincidencia; //data do envio para manutenção em caso de garantia
    var $data_sem_conserto; //data de retorno da manutenção que não obteve conserto
    var $patrimonio; //numero de patrimonio PIC
    var $descricao; //descricao do equipamento (dados como numero de serie e etc)
    var $fornecedor; //nome do fornecedor que foi enviado para manutenção
    var $motivo; //motivo no qual não houver conserto
    var $solucao; //solução do reparo
    var $idunidade; //unidade
    var $idsetor; //setor
    
    /*------Construtor--------*/
    public function __construct() {
        parent::__construct();
    }
    
    /*------Requisições--------*/
    //instancia novo 
    public function newManutencao($equipamento, $defeito, $data_defeito, $data_entrega, $data_retorno, $garantia, 
            $data_garantia, $data_reincidencia, $data_sem_conserto, $patrimonio, $descricao, $fornecedor, $motivo, $solucao, $idunidade, $idsetor){
        $this->setEquipamento($equipamento);
        $this->setDefeito($defeito);
        $this->setData_defeito($data_defeito);
        $this->setData_entrega($data_entrega);
        $this->setData_retorno($data_retorno);
        $this->setGarantia($garantia);
        $this->setData_garantia($data_garantia);
        $this->setData_reincidencia($data_reincidencia);
        $this->setData_sem_conserto($data_sem_conserto);
        $this->setPatrimonio($patrimonio);
        $this->setDescricao($descricao);
        $this->setFornecedor($fornecedor);
        $this->setMotivo($motivo);
        $this->setSolucao($solucao);
        $this->setIdunidade($idunidade);
        $this->setIdsetor($idsetor);
    }
    
    //Inseri manutencao
    public function addManutencao(){
        $this->db->insert("manutencao", $this);
    }

    //atualiza manutencao
    public function atualizaManutencao($id, $equipamento, $defeito, $patrimonio, $descricao, $fornecedor, $idunidade, $idsetor){
        $dados = array(
            "equipamento" => $equipamento,
            "defeito" => $defeito,
            "patrimonio" => $patrimonio,
            "descricao" => $descricao,
            "fornecedor" => $fornecedor,
            "idunidade" => $idunidade,
            "idsetor" => $idsetor            
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmanutencao', $id);
        $this->db->update('manutencao');
    }
    
    //retorna manutencao
    public function retornoManutencao($id, $data_retorno, $garantia, $data_garantia, $solucao){
        $dados = array(
            "data_retorno" => $data_retorno,
            "garantia" => $garantia,
            "data_garantia" => $data_garantia,
            "solucao" => $solucao,
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmanutencao', $id);
        $this->db->update('manutencao');
    }
    
    //Remover manutencao
    public function removerManutencao($id){
        $this->db->where('idmanutencao', $id);
        $this->db->delete('manutencao');
    }
    
    //Enviar para manutenção
    public function enviarManutencao($id, $data_entrega){
        $dados = array(
            "data_entrega" => $data_entrega        
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmanutencao', $id);
        $this->db->update('manutencao');
    }
    
    //reindicio manutencao em garantia
    public function reindicio($id, $data){
        $dados = array(
            "data_reincidencia" => $data        
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmanutencao', $id);
        $this->db->update('manutencao');
    }
    
    //sem conserto manutenção
    public function semConsertoManutencao($id, $data_retorno, $data_sem_conserto, $motivo){
        $dados = array(
            "data_retorno" => $data_retorno,
            "data_sem_conserto" => $data_sem_conserto,
            "motivo" => $motivo,          
        );
        //atualiza no db
        $this->db->set($dados);
        $this->db->where('idmanutencao', $id);
        $this->db->update('manutencao');
    }

    //Busca manutencao por nome
    public function buscaManutencaoNome($nome){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE nome = '$nome'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca manutencao por caracter
    public function buscaManutencaoTermo($termo){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE nome like '%$termo%' OR ip like '%$termo%'
                ORDER BY nome, ip");
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca manutencao por id
    public function buscaId($id){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE idmanutencao = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return $this->getObjByRow($query->row());
        } else{
            return NULL;
        }
    }
    
    //Busca manutencao por id
    public function existe($id){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE idmanutencao = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca manutencao por id
    public function verificaEmDefeito($id){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_entrega IS NULL AND
                    idmanutencao = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca manutencao por id
    public function verificaEmManutencao($id){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_entrega IS NOT NULL AND
                    data_retorno IS NULL AND
                    idmanutencao = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
    
    //Busca manutencao por id
    public function verificaEmGarantia($id){
        $hoje = date("Y-m-d");
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_garantia >= '$hoje' AND
                    idmanutencao = '$id'");
        //retorna objeto ip
        if ($query->num_rows() == 1){
            return TRUE;
        } else{
            return FALSE;
        }
    }
           
    //Busca todas manutencaos
    public function buscaTodasDefeito($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_entrega IS NULL
                ORDER BY idmanutencao DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao
                WHERE data_entrega IS NULL
                ORDER BY idmanutencao DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas manutencaos
    public function buscaTodasManutencao($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_entrega IS NOT NULL AND
                    data_retorno IS NULL
                ORDER BY data_entrega DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao
                WHERE data_entrega IS NOT NULL AND
                    data_retorno IS NULL
                ORDER BY data_entrega DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas manutencaos
    public function buscaTodasFechadas($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_sem_conserto IS NULL
                ORDER BY data_retorno DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_sem_conserto IS NULL
                ORDER BY data_retorno DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas em garantia
    public function buscaTodasGarantia($limite = NULL, $ponteiro = NULL){
        $hoje = date("Y-m-d");
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_garantia IS NOT NULL AND
                    data_garantia >= '$hoje' AND
                    data_reincidencia IS NULL
                ORDER BY data_garantia
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_garantia IS NOT NULL AND
                    data_garantia >= '$hoje' AND
                    data_reincidencia IS NULL
                ORDER BY data_garantia");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todas em garantia
    public function buscaTodasSemConserto($limite = NULL, $ponteiro = NULL){
        if (isset($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_reincidencia IS NULL AND 
                    data_sem_conserto IS NOT NULL AND
                    motivo IS NOT NULL
                ORDER BY data_sem_conserto DESC
                LIMIT $ponteiro, $limite");           
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_reincidencia IS NULL AND 
                    data_sem_conserto IS NOT NULL AND
                    motivo IS NOT NULL
                ORDER BY data_sem_conserto DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //verifica se manutencao exite
    public function existeManutencao($nome){
        $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE nome = '$nome'");
        if ($query->num_rows() == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Contar todos registros
    public function contarTodos($tipo){
        $hoje = date("Y-m-d");
        switch ($tipo) {
            case "defeito":
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao 
                    WHERE data_entrega IS NULL");
                break;
            case "manutencao":
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao 
                    WHERE data_entrega IS NOT NULL AND
                        data_retorno IS NULL");
                break;
            case "conserto":
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao 
                    WHERE data_retorno IS NOT NULL");
                break;
            case "garantia":
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao 
                    WHERE data_retorno IS NOT NULL AND
                        data_garantia IS NOT NULL AND
                        data_garantia >= '$hoje' AND
                        data_reincidencia IS NULL");
                break;
            case "semconserto":
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao 
                    WHERE data_retorno IS NOT NULL AND
                        data_reincidencia IS NULL AND 
                        data_sem_conserto IS NOT NULL AND
                        motivo IS NOT NULL");
                break;
            default:
                $query = $this->db->query(
                    "SELECT *
                    FROM manutencao");
                break;
        }
        return $query->num_rows();
    }
    
    //Busca todos por equipamento com defeito
    public function buscaPorDefeito($equipamento, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_entrega IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_defeito DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_entrega IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_defeito DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por equipamento manutenção
    public function buscaPorManutecao($equipamento, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_entrega IS NOT NULL AND
                    data_retorno IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_entrega DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_entrega IS NOT NULL AND
                    data_retorno IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_entrega DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }

    //Busca todos por equipamento fechada
    public function buscaPorFechada($equipamento, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_retorno IS NOT NULL AND
                    data_sem_conserto IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_retorno DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_retorno IS NOT NULL AND
                    data_sem_conserto IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_retorno DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por equipamento garantia
    public function buscaPorGarantia($equipamento, $limite = NULL, $ponteiro = NULL){
        $hoje = date("Y-m-d");
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_retorno IS NOT NULL AND
                    data_garantia IS NOT NULL AND
                    data_garantia >= '$hoje' AND
                    data_reincidencia IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_retorno DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM  manutencao
                WHERE data_retorno IS NOT NULL AND
                    data_garantia IS NOT NULL AND
                    data_garantia >= '$hoje' AND
                    data_reincidencia IS NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_retorno DESC");
        }
        //retorna objeto ip
        if ($query->num_rows() > 0){
            return $this->getObjByResult($query->result());
        } else{
            return NULL;
        }
    }
    
    //Busca todos por equipamento sem conserto
    public function buscaPorSemconserto($equipamento, $limite = NULL, $ponteiro = NULL){
        if (isset ($limite)){
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_reincidencia IS NULL AND 
                    data_sem_conserto IS NOT NULL AND
                    motivo IS NOT NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_sem_conserto DESC
                LIMIT $ponteiro, $limite");
        } else {
            $query = $this->db->query(
                "SELECT *
                FROM manutencao 
                WHERE data_retorno IS NOT NULL AND
                    data_reincidencia IS NULL AND 
                    data_sem_conserto IS NOT NULL AND
                    motivo IS NOT NULL AND
                    (equipamento LIKE '%$equipamento%' OR
                    fornecedor LIKE '%$equipamento%')
                ORDER BY data_sem_conserto DESC");
        }
        //retorna objeto ip
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
        $manutencao = new Manutencao_model();
        //atribue valores do resultado
        $manutencao->setIdmanutencao($r->idmanutencao);
        $manutencao->setEquipamento($r->equipamento);
        $manutencao->setDefeito($r->defeito);
        $manutencao->setData_defeito($r->data_defeito);
        $manutencao->setData_entrega($r->data_entrega);
        $manutencao->setData_retorno($r->data_retorno);
        $manutencao->setGarantia($r->garantia);
        $manutencao->setData_garantia($r->data_garantia);
        $manutencao->setData_reincidencia($r->data_reincidencia);
        $manutencao->setData_sem_conserto($r->data_sem_conserto);
        $manutencao->setPatrimonio($r->patrimonio);
        $manutencao->setDescricao($r->descricao);
        $manutencao->setFornecedor($r->fornecedor);
        $manutencao->setMotivo($r->motivo);
        $manutencao->setSolucao($r->solucao);
        $manutencao->setIdunidade($r->idunidade);
        $manutencao->setIdsetor($r->idsetor);
        
        return $manutencao;
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
    
    //reduzir descrição de uma manutenção
    public function reduzirDescricao($descricao){
        $tamanho = strlen($descricao);
        if ($tamanho > 20){
            return substr($descricao, 0, 30)."...";
        } else {
            return $descricao;
        }
    }
    
    /*------Gets e Sets--------*/ 
    function getIdmanutencao() {
        return $this->idmanutencao;
    }

    function getEquipamento() {
        return $this->equipamento;
    }

    function getDefeito() {
        return $this->defeito;
    }

    function getData_defeito() {
        return $this->data_defeito;
    }

    function getData_entrega() {
        return $this->data_entrega;
    }

    function getData_retorno() {
        return $this->data_retorno;
    }

    function getGarantia() {
        return $this->garantia;
    }

    function getData_garantia() {
        return $this->data_garantia;
    }

    function getData_reincidencia() {
        return $this->data_reincidencia;
    }

    function getData_sem_conserto() {
        return $this->data_sem_conserto;
    }

    function getPatrimonio() {
        return $this->patrimonio;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getFornecedor() {
        return $this->fornecedor;
    }

    function getMotivo() {
        return $this->motivo;
    }

    function getSolucao() {
        return $this->solucao;
    }

    function getIdunidade() {
        return $this->idunidade;
    }

    function getIdsetor() {
        return $this->idsetor;
    }

    function setIdmanutencao($idmanutencao) {
        $this->idmanutencao = $idmanutencao;
    }

    function setEquipamento($equipamento) {
        $this->equipamento = $equipamento;
    }

    function setDefeito($defeito) {
        $this->defeito = $defeito;
    }

    function setData_defeito($data_defeito) {
        $this->data_defeito = $data_defeito;
    }

    function setData_entrega($data_entrega) {
        $this->data_entrega = $data_entrega;
    }

    function setData_retorno($data_retorno) {
        $this->data_retorno = $data_retorno;
    }

    function setGarantia($garantia) {
        $this->garantia = $garantia;
    }

    function setData_garantia($data_garantia) {
        $this->data_garantia = $data_garantia;
    }

    function setData_reincidencia($data_reincidencia) {
        $this->data_reincidencia = $data_reincidencia;
    }

    function setData_sem_conserto($data_sem_conserto) {
        $this->data_sem_conserto = $data_sem_conserto;
    }

    function setPatrimonio($patrimonio) {
        $this->patrimonio = $patrimonio;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    function setSolucao($solucao) {
        $this->solucao = $solucao;
    }

    function setIdunidade($idunidade) {
        $this->idunidade = $idunidade;
    }

    function setIdsetor($idsetor) {
        $this->idsetor = $idsetor;
    }
}

