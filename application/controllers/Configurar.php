<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurar extends CI_Controller {

	
	public function index()
	{
		$this->load->view('estrutura/cabecalho');
		//$this->load->view('dashboard/dashboard');
		$this->load->view('estrutura/rodape');
    }
    
    public function Fornecedor()
    {


		$rodape['js'] = array('assets/js/paginas/mascara.js',
							'assets/js/paginas/fornecedor.js');

        $this->load->view('estrutura/cabecalho');
		$this->load->view('fornecedor/fornecedor');
		$this->load->view('estrutura/rodape', $rodape);
	}
	
	public function Salvar_fornecedor()
	{
		$dados = $this->input->post();
		//var_dump($dados);exit;
		if(!empty($dados)){
			
			$set['nome_for'] = $dados['nome'];
			$set['cep_for'] = $dados['cep'];
			$set['logradouro_for'] = $dados['rua'];
			$set['numero_for'] = $dados['numero'];
			$set['cidade_for'] = $dados['cidade'];
			$set['estado_for'] = $dados['estado'];
			$set['telefone_for'] = $dados['telefone'];
			$set['bairro_for'] = $dados['bairro'];
			$set['email_for'] = $dados['email'];
			$set['cnpj_for'] = $dados['cnpj'];


			$retorno = $this->crud->inserir('fornecedor', $set);
			//print_r($retorno);exit;

			if($retorno){
				echo json_encode(array('retorno' => true));
			}else{
				echo json_encode(array('retorno' => false));
			}
			
		}

		
	}
}