<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
		var_dump($dados);
		if(!empty($dados)){
			//$set['codigo_for'] = 'DEFAULT';
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

			if($retorno){
				echo json_encode(array('retorno' => true));
			}
			
		}else{
			echo json_encode(array('retorno' => false));
		}

		
	}
}