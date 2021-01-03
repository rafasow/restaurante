<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configurar extends CI_Controller {

	
	public function index()
	{

		$dados['cat'] = $this->crud->buscar('*', 'grupo', 'ativo_gru = 1');

		$dados['sub'] = $this->crud->busca_livre('SELECT * 
														FROM subgrupo sub
														INNER JOIN grupo g ON g.id_grupo = sub.id_grupo_sub');

		$rodape['js'] = array('assets/js/paginas/categoria.js'.V);

		$this->load->view('estrutura/cabecalho');
		$this->load->view('configuracao/categoria', $dados);
		$this->load->view('estrutura/rodape', $rodape);
    }
    
    public function Fornecedor()
    {
		$dados['fornecedor'] = $this->crud->busca_livre('SELECT * FROM fornecedor  WHERE ativo_for = 1');

		$rodape['js'] = array('assets/js/paginas/mascara.js'.V,
							'assets/js/paginas/fornecedor.js'.V);

        $this->load->view('estrutura/cabecalho');
		$this->load->view('fornecedor/fornecedor', $dados);
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

	public function buscar_fornecedor(){

		$dados = $this->crud->busca_livre('SELECT *
											FROM fornecedor 
											WHERE fornecedor.ativo_for = 1');

		if(!empty($dados)){

			echo json_encode(array('retorno' => true, 'dados' => $dados));
		}else{

			echo json_encode(array('retorno' => false));

		}
	}

	public function Salvar_categoria(){

		$dados = $this->input->post();
		var_dump($dados);
		if(!empty($dados)){
			if(empty($dados['acao'])){

				$set['descricao_gru'] = $dados['descri'];
				$set['ativo_gru	'] = 1;

				$retorno = $this->crud->inserir('grupo', $set);

				if($retorno){
					echo json_encode(array('retorno' => true));
				}
			}else{

				$set['descricao_gru'] = $dados['descri'];

				$retorno = $this->crud->atualizar('grupo', $set, 'id_grupo = '.$dados['codigo']);

				if($retorno){
					echo json_encode(array('retorno' => true));
				}
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

		$codigo = $this->input->post();
		//var_dump($codigo);exit;
		if(empty($codigo['ativo'])){

			$dados = $this->crud->buscar('*', 'subgrupo', 'id_sub = '.$codigo['codigo']);
			
			if(!empty($dados)){
				echo json_encode(array('retorno' => true, 'dados' => $dados ));
			}else{
				echo json_encode(array('retorno' => false));
			}
		}else{

			$dados = $this->crud->busca_livre('SELECT * FROM subgrupo sub WHERE id_grupo_sub = ' . $codigo["codigo"] . ' AND ativo_sub = 1');
			//$dados = $this->crud->buscar('*', 'subgrupo', 'id_grupo_sub = '.$codigo['codigo']);

			if(!empty($dados)){
				echo json_encode(array('retorno' => true, 'dados' => $dados));
			}else{
				echo json_encode(array('retorno' => false));
			}
		}

		
	}

	public function excluir_categoria(){

		$codigo = $this->input->post('codigo');

		$set['ativo_gru'] = 0;

		$retorno = $this->crud->atualizar('grupo', $set, 'id_grupo = '.$codigo['codigo']);

		if($retorno){
			echo json_encode(array('retorno' => true));
		}else{
			echo json_encode(array('retorno' => false));
		}
	}

	public function buscar_categoria(){

		$codigo = $this->input->post();

		$dados = $this->crud->buscar('*', 'grupo', 'id_grupo = '.$codigo['codigo']);

		if(!empty($dados)){

			echo json_encode(array('retorno' => true, 'dados' => $dados));
		}else{
			echo json_encode(array('retorno' => false));
		}
	}

	public function excluir_subcategoria(){

		$codigo = $this->input->post();

		$set['ativo_sub'] = 0;

		$retorno = $this->crud->atualizar('subgrupo', $set, 'id_sub = '.$codigo['codigo']);

		if($retorno){
			echo json_encode(array('retorno' => true));
		}else{
			echo json_encode(array('retorno' => false));
		}

	}

}