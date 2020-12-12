<?php

class Crud_model extends CI_Model {
    
    public function inserir($tabela, $dados){
        $this->db->insert($tabela, $dados);
        //print_r($this->db->last_query());
        //exit;
        if ($this->db->insert_id() >= 1) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function inserir_t($tabela, $dados){
        $this->db->insert($tabela, $dados);
        //print_r($this->db->last_query());
        //exit;
        return true;
    }

    public function inserir_log_usuario($tabela, $operacao, $id){

        $data = array(
            'codigo_usu' => $this->session->usuario['codigo'],
            'nome_usu' => $this->session->usuario['nome'],
            'tabela_log' => $tabela,
            'operacao_log' => $operacao,
            'id_item' => $id
        );

        $this->db->insert('log_usuario', $data);

        if ($this->db->insert_id() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function inserir_array($tabela, $dados){
        if($this->db->insert_batch($tabela, $dados)){

            //print_r($this->db->last_query());
            return true;
        } else {

            //print_r($this->db->last_query());
            return false;
        }

    }
    
    public function atualizar($tabela, $dados, $where){
        $this->db->set($dados);
        $this->db->where($where);

        //print_r($this->db->last_query());exit;
        if ($this->db->update($tabela)) {

            return true;
        } else {
            return false;
        }
    }

    public function excluir($tabela, $prefixo, $codigo){
        $this->db->where('codigo_' . $prefixo, $codigo);

        if ($this->db->delete($tabela)) {

            return true;
        } else {
            return false;
        }
    }

    public function excluir_condicionado($tabela, $where){
        $this->db->where($where);

        if ($this->db->delete($tabela)) {
            return true;
        } else {
            return false;
        }
    }

    public function inativar($tabela, $prefixo, $codigo){
        $this->db->set("ativo_" . $prefixo, false);
        $this->db->where('codigo_' . $prefixo, $codigo);

        if ($this->db->update($tabela)) {

            return true;
        } else {
            return false;
        }
    }

    public function buscar($campos, $tabela, $where, $order = "", $join = ""){
        $this->db->select($campos);
        $this->db->from($tabela);
        $this->db->where($where);
        if(!empty($join)) {
            $this->db->join($join['tabela'], $join['condicao'], $join['tipo']);
        }


        if(!empty($order)){
            $this->db->order_by($order);
        }

        $query = $this->db->get();

        //print_r($this->db->last_query());exit;

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function busca_livre($select){
        //$this->db->query($select);
        $query = $this->db->query($select);
        //$query = $this->db->get();
        // print_r($this->db->last_query());exit;
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function executa_comando($query){
        $query = $this->db->query($query);
        //print_r($this->db->last_query());exit;

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar($tabela, $where){
        $this->db->select("*");
        $this->db->from($tabela);
        $this->db->where($where);
        $query = $this->db->get();
        //print_r($this->db->last_query());exit;

        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function duplicar($tabela, $where, $prefixo, $novo_codigo){
        $this->db->select('*');
        $this->db->from($tabela);
        $this->db->where($where);
        $resultado = $this->db->get();

        $dados = array();
        $campo = 'codigo_' . $prefixo;

        foreach ($resultado->result() as $cada) {
            if(empty($novo_codigo)) {
                unset($cada->$campo);
            } else {
                $cada->$campo = $novo_codigo;
            }

            $this->inserir_t($tabela, $cada);
        }

        if(empty($novo_codigo)){
            return  $this->db->insert_id();
        } else {
            return $novo_codigo;
        }
    }

}
