<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	
	public function index()
	{
		$dados['cat'] = $this->crud->busca_livre('SELECT * FROM grupo g WHERE g.ativo_gru = 1');
		$dados['produtos'] = $this->crud->busca_livre('SELECT * 
														FROM produto p 
														INNER JOIN subgrupo sub ON sub.id_sub = p.codigo_subg
														INNER JOIN grupo g ON g.id_grupo = sub.id_grupo_sub
														WHERE p.ativo_pro = 1');

		$dados['fornecedor'] = $this->crud->busca_livre('SELECT * FROM fornecedor WHERE ativo_for = 1');												

		$rodape['js'] = array('assets/js/paginas/produtos.js'.V);
		

		$this->load->view('estrutura/cabecalho');
		$this->load->view('configuracao/cadastro-produto', $dados);
		$this->load->view('estrutura/rodape', $rodape);
	}
	
	public function Cadastrar_produto(){

		$dados = $this->input->post();
		//var_dump($dados);exit;

		$set['descricao_pro'] = $dados['nome'];
		$set['marca_pro'] = $dados['marca'];
		$set['codigo_subg'] = $dados['codigo'];
		$set['ativo_pro'] = 1;

		$resultado = $this->crud->inserir('produto', $set);

		if(!empty($resultado)){
			echo json_encode(array('resultado' => true));
		}else{
			echo json_encode(array('resultado' => false));
		}
	}

	public function Cadastrar_compra(){

		$dados = $this->input->post();

		

		$set['codigo_pro'] = $dados['codigo'];
		$set['codigo_for'] = $dados['fornecedor'];
		$set['dtcompra'] = $dados['dtcompra'];
		$set['dtfabri'] = $dados['dtfabri'];
		$set['dtvalid'] = $dados['dtvali'];
		$set['quant'] = $dados['quant'];
		$set['valor_compra'] = $dados['valor'];
		$set['lote'] = $dados['lote'];
		$set['codigo_compra'] = $dados['codigo_pro'];

		if(!empty($dados)){

			$retorno = $this->crud->inserir('compra_produto', $set);

			if($retorno){

				echo json_encode(array('retorno' => true));
			}else{

				echo json_encode(array('retorno' => false));
			}
		}

	}
}