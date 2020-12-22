<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurar extends CI_Controller {

	
	public function index()
	{

		$dados['cat'] = $this->crud->buscar('*', 'grupo', 'ativo_gru = 1');

		$dados['sub'] = $this->crud-> busca_livre('SELECT * 
														FROM subgrupo sub
														INNER JOIN grupo g ON g.id_grupo = sub.id_grupo_sub');

		$rodape['js'] = array('assets/js/paginas/categoria.js'.V);

		$this->load->view('estrutura/cabecalho');
		$this->load->view('configuracao/categoria', $dados);
		$this->load->view('estrutura/rodape', $rodape);
    }
    
    public function Fornecedor()
    {


		$rodape['js'] = array('assets/js/paginas/mascara.js'.V,
							'assets/js/paginas/fornecedor.js'.V);

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
			$set['ativo_for'] = 1;


			$retorno = $this->crud->inserir('fornecedor', $set);
			//print_r($retorno);exit;

			if($retorno){
				echo json_encode(array('retorno' => true));
			}else{
				echo json_encode(array('retorno' => false));
			}
			
		}

		
	}

	public function Salvar_categoria(){

		$dados = $this->input->post();
		if(!empty($dados)){
			$set['descricao_gru'] = $dados['descri'];
			$set['ativo_gru	'] = 1;

			$retorno = $this->crud->inserir('grupo', $set);

			if($retorno){
				echo json_encode(array('retorno' => true));
			}
		}

		
	}

	public function Salvar_subcategoria(){

		$dados = $this->input->post();
		//print_r($dados);exit;
		if(!empty($dados)){
			if(empty($dados['acao'])){
				$set['descricao_sub'] = $dados['descri'];
				$set['id_grupo_sub'] = $dados['codigo'];
				$set['ativo_sub'] = 1;

				$retorno = $this->crud->inserir('subgrupo', $set);

				if($retorno){
					echo json_encode(array('retorno' => true));
				}else{
					echo json_encode(array('retorno' => false));
				}
			}else{
				$set['descricao_sub'] = $dados['descri'];
				$set['id_grupo_sub'] = $dados['codigo'];
				$set['ativo_sub'] = 1;

				$retorno = $this->crud->atualizar('subgrupo', $set, 'id_sub = '.$dados['cod_sub']);

			}
				
		}
			
	}

	public function buscar_subcategoria(){

		$codigo = $this->input->post('codigo');
		//var_dump($codigo);exit;
		$dados = $this->crud->buscar('*', 'subgrupo', 'id_sub = '.$codigo);
		//var_dump($dados);exit;
		if(!empty($dados)){
			echo json_encode(array('retorno' => true, 'dados' => $dados ));
		}else{
			echo json_encode(array('retorno' => false));
		}
	}

}