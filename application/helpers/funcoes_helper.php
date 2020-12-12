<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( ! function_exists('formata_moeda_banco')){
	    function formata_moeda_banco($valor){
			return str_replace(',', '.', str_replace('.', '', $valor));
		}
	}	
	
	if( ! function_exists('tirarAcentos')){
	
		function tirarAcentos($string){
		    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
		}
	}	
	
	if( ! function_exists('formata_moeda')){
		function formata_moeda($moeda)
		{
			return number_format($moeda, 2, ',', '.');
		}
	}	

	if( ! function_exists('formata_moeda3Casas')){
		function formata_moeda3Casas($moeda)
		{		
			return number_format($moeda, 3, ',', '.');
		}
	}	

	if( ! function_exists('Iniciais')){
	  function Iniciais($nome){
	   $partes = explode(" ",$nome);
	   $ret = '';
	   foreach($partes as $parte) if(strlen($parte) > 2) $ret .= substr($parte,0,1);
	   $primeira = substr($ret, 0, 1);  
	   $ultima =  substr($ret, strlen($ret)-1); 
	   return $primeira.$ultima; 
	  }
	 }
		
	
	if( ! function_exists('Nome')){
		function Nome($nome){
			$partes = explode(" ",$nome);
			$primeira = reset($partes);  
			$ultima =  end($partes); 
			return $primeira.' '.$ultima; 
		}
	}	
	
	if( ! function_exists('DiaSemana')){
		function DiaSemana($dataMysql){
			$diasemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');	
			
			$dataA = explode('-', $dataMysql);
			$data = $dataA[0].'-'.$dataA[1].'-'.$dataA[2];
				
			$diasemana_numero = date('w', strtotime($data));
			return $diasemana[$diasemana_numero];	
		}
	}

	if( ! function_exists('printaAnoMes')){
		function printaAnoMes($session, $url){
			$link = site_url($url."trocar_mes");
			$linkano = site_url($url."trocar_ano");
			$anomes =  '<div class="estados-relatorio">	
		            <div class="ano-mes">    
		            	<p>Ano</p> 
		                
		                <div class="auxiliar-grupo">
		                    <select name="ddlAno" id="ddlAno" class="form-control ddlAno" data-url="'.$linkano.'"  data-style="btn-primary">';
		                    //<select name="ddlAno" id="ddlAno" class="form-control ddlAno selectpicker" data-url="'.$linkano.'"  data-style="btn-primary">';
							
								$anoInicio = 2016;
								$anoCorrente = date('Y');
								$correnteAno = $session->userdata('ano');
								
								for($i = $anoInicio;  $i <= $anoCorrente+5; $i++) {
									if ($i == $correnteAno) $select = 'selected';  
									else $select = '';
									
									$anomes .= '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
								}
								
							$anomes .= '</select>		
		                </div>	
		            </div>
		            
		            <div class="ano-mes">
		            	<p>Mês</p> 
		                <div class=" btn-group">';
		              	
							$corrente = $session->userdata('mes');
							$mes = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
							$current = "";
							$selected = "";
							$cont = count($mes);

							for($i=1; $i <= $cont; $i++){
								 if($i == $corrente){
									$current = "mes_ativo";
									$selected = "selected";
								}else{
									$current = "";
									$selected = "";
								}
								
								
								
								if(!empty($current)){				
									$anomes .= '<button class="btn mes_selecionado ' .$current.'" data-url="'.$link.'" value='.$i.' >'.$mes[$i-1].'</button>';
								}else{
									$anomes .= '<button class="btn btn-primary mes_selecionado' .$current.'" data-url="'.$link.'" value='.$i.' >'.$mes[$i-1].'</button>';
								}	
							}
						
		                $anomes .= '</div>
		            </div>
		        </div>	';
		        return $anomes;
		}
	}

	if( ! function_exists('GerarSenha')){
		function GerarSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
			$lmin = 'abcdefghijklmnopqrstuvwxyz';
			$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$num = '1234567890';
			$simb = '!@#$%*-';
			$retorno = '';
			$caracteres = '';
			
			$caracteres .= $lmin;
			if ($maiusculas) $caracteres .= $lmai;
			if ($numeros) $caracteres .= $num;
			if ($simbolos) $caracteres .= $simb;
			
			$len = strlen($caracteres);
			for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
			}
			return $retorno;
		}
	}

	if( ! function_exists('validCPF')){
		function validCPF($cpf = null) {
 
		    // Verifica se um número foi informado
		    if(empty($cpf)) {
		        return false;
		    }
		 
		    // Elimina possivel mascara
		    $cpf = preg_replace('/[^0-9]/', '', $cpf);
		    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		     
		    // Verifica se o numero de digitos informados é igual a 11 
		    if (strlen($cpf) != 11) {
		        return false;
		    }
		    // Verifica se nenhuma das sequências invalidas abaixo 
		    // foi digitada. Caso afirmativo, retorna falso
		    else if ($cpf == '00000000000' || 
		        $cpf == '11111111111' || 
		        $cpf == '22222222222' || 
		        $cpf == '33333333333' || 
		        $cpf == '44444444444' || 
		        $cpf == '55555555555' || 
		        $cpf == '66666666666' || 
		        $cpf == '77777777777' || 
		        $cpf == '88888888888' || 
		        $cpf == '99999999999') {
		        return false;
		     // Calcula os digitos verificadores para verificar se o
		     // CPF é válido
		     } else {   
		         
		        for ($t = 9; $t < 11; $t++) {
		             
		            for ($d = 0, $c = 0; $c < $t; $c++) {
		                $d += $cpf{$c} * (($t + 1) - $c);
		            }
		            $d = ((10 * $d) % 11) % 10;
		            if ($cpf{$c} != $d) {
		                return false;
		            }
		        }
		 
		        return true;
		    }
		}
	}

	if( ! function_exists('validCNPJ')){
		function validCNPJ($cnpj)
	 	{
			//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
			$j=0;
			for($i=0; $i<(strlen($cnpj)); $i++)
				{
					if(is_numeric($cnpj[$i]))
						{
							$num[$j]=$cnpj[$i];
							$j++;
						}
				}
			//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
			if(count($num)!=14)
				{
					$isCnpjValid=false;
				}
			//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
			if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
				{
					$isCnpjValid=false;
				}
			//Etapa 4: Calcula e compara o primeiro dígito verificador.
			else
				{
					$j=5;
					for($i=0; $i<4; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=4; $i<12; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[12])
						{
							$isCnpjValid=false;
						} 
				}
			//Etapa 5: Calcula e compara o segundo dígito verificador.
			if(!isset($isCnpjValid))
				{
					$j=6;
					for($i=0; $i<5; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=5; $i<13; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[13])
						{
							$isCnpjValid=false;
						}
					else
						{
							$isCnpjValid=true;
						}
				}
			//Trecho usado para depurar erros.
			/*
			if($isCnpjValid==true)
				{
					echo "<p><font color="GREEN">Cnpj é Válido</font></p>";
				}
			if($isCnpjValid==false)
				{
					echo "<p><font color="RED">Cnpj Inválido</font></p>";
				}
			*/
			//Etapa 6: Retorna o Resultado em um valor booleano.
			return $isCnpjValid;			
		}
	}

	if( ! function_exists('inverterdata')){
		function inverterdata($data)
		{
			$this_year = substr ( $data, 0, 4 );
			$this_month = substr ( $data, 5, 2 );
			$this_day =  substr ( $data, 8, 2 );
			$data = mktime ( 0, 0, 0, $this_month, $this_day, $this_year );
			return strftime("%d/%m/%Y", $data);
		}
	}

	if( ! function_exists('datapararemessa')){
		function datapararemessa($data)
		{
			$this_year = substr ( $data, 0, 4 );
			$this_month = substr ( $data, 5, 2 );
			$this_day =  substr ( $data, 8, 2 );
			$data = mktime ( 0, 0, 0, $this_month, $this_day, $this_year );
			return strftime("%d%m%Y", $data);
		}
	}

	if( ! function_exists('inverteparadatepicker')){
		function inverteparadatepicker($data)
		{
			$this_year = substr ( $data, 0, 4 );
			$this_month = substr ( $data, 5, 2 );
			$this_day =  substr ( $data, 8, 2 );
			$data = mktime ( 0, 0, 0, $this_month, $this_day, $this_year );
			return strftime("%Y/%m/%d", $data);
		}
	}
    if( ! function_exists('invertedatateste')) {
        function invertedatateste($data)
        {
            if (count(explode("/", $data)) > 1) {
                return implode("-", array_reverse(explode("/", $data)));
            } elseif (count(explode("-", $data)) > 1) {
                return implode("/", array_reverse(explode("-", $data)));
            }
        }
    }
	if( ! function_exists('dataparabanco')){
		function dataparabanco($data)
		{
			//echo $data; exit;
			$datas = explode("/", $data);

			/*$this_year = substr ( $data, 6, 4 );
			$this_month = substr ( $data, 3, 2 );
			$this_day =  substr ( $data, 0, 2 );*/
			$this_year = $datas[2];
			$this_month = $datas[1];
			$this_day = $datas[0];
			$data = mktime ( 0, 0, 0, $this_month, $this_day, $this_year );
			return strftime("%Y-%m-%d", $data);
		}  
	}

    if(!function_exists('MesAbrv')) {
        function MesAbrv($mes){
            $meses = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
            if($mes == 0)
            {
                $mes = 12;
            }
            if(isset($mes)){
                return $meses[$mes-1];
            }else{
                return false;
            }
        }
    }

    if(!function_exists('MesCompleto')){
        function MesCompleto($mes){
            $diasemana = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
            $imes = (int)$mes;
            if(!empty($mes)) return $diasemana[$imes];
            else return '';
        }
    }

	if( ! function_exists('adicionar_mes_data')){
		function adicionar_mes_data($date, $mes) {
		    $data_formatada = explode("-", $date);
		    if($data_formatada[2] == "31"){
                switch (intval($mes)){
                    case 2: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "28";
                        break;
                    case 4: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "30";
                        break;
                    case 6: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "30";
                        break;
                    case 9: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "30";
                        break;
                    case 11: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "30";
                        break;
                    default: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . $data_formatada[2];
                        break;
                }
            }else if($data_formatada[2] == "30" || $data_formatada[2] == "29"){
                switch (intval($mes)){
                    case 2: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . "28";
                        break;
                    default: $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . $data_formatada[2];
                        break;
                }
            }else{
                $data_formatada = $data_formatada[0] . "-" . $data_formatada[1] . "-" . $data_formatada[2];
            }
            $time = strtotime($data_formatada);
            return date("Y-m-d", strtotime("+{$mes} month", $time));
		} 
	}

	if( ! function_exists('data_para_banco')){
		function data_para_banco($date) {
            $data = explode('/', $date);
            return $data[2] . "-" . $data[1] . "-" . $data[0];
		}
	}

	if( ! function_exists('addMonthIntoDate')){
		function addMonthIntoDate($date) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month + 1, $this_day, $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		}
	}

	if( ! function_exists('addDayIntoDate')){
		function addDayIntoDate($date) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month, $this_day + 1, $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		} 
	}

	if( ! function_exists('addXDayIntoDate')){
		function addXDayIntoDate($date, $x) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month, $this_day + $x, $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		} 
	}

	if( ! function_exists('addXMonthIntoDate')){
		function addXMonthIntoDate($date, $x) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month+ $x, $this_day , $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		} 
	}

	if( ! function_exists('removeDayIntoDate')){
		function removeDayIntoDate($date, $days) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month, $this_day - $days, $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		}
	}

	if( ! function_exists('removeXMonthIntoDate')){
		function removeXMonthIntoDate($date, $days) {
		 $this_year = substr ( $date, 0, 4 );
		 $this_month = substr ( $date, 5, 2 );
		 $this_day =  substr ( $date, 8, 2 );
		 $next_date = mktime ( 0, 0, 0, $this_month - $days, $this_day , $this_year );
		 return strftime("%Y-%m-%d", $next_date);
		} 
	}

	if( ! function_exists('inverterdatetime')){
		function inverterdatetime($data)
		{
			$year = substr ( $data, 0, 4 );
			$month = substr ( $data, 5, 2 );
			$day =  substr ( $data, 8, 2 );
			$hour = substr ( $data, 11, 2 );
			$min = substr ( $data, 14, 2 );
			$data = mktime ( $hour, $min, 0, $month, $day, $year );
			return strftime("%d/%m/%Y %H:%M", $data);
		}

	}

    if( ! function_exists('formata_datahora')){
    function formata_datahora($data, $format = 'en', $type = 'data_hora')
    {
        if($format == 'en'){
            list ($d, $m, $y) = explode('/', $data);
            if($y <= 1970){
                $retorno = sprintf("%04d-%02d-%02d", $y, $m, $d);
            }else{
                $dt = $y.'-'.$m.'-'.$d;
                switch ($type){
                    case 'data_hora':
                        $formato = 'Y-m-d H:i:s';
                        $retorno = date($formato, strtotime($dt));
                        break;
                    case 'data_hora_ns':
                        $formato = 'Y-m-d H:i';
                        $retorno = date($formato, strtotime($dt));
                        break;
                    case 'data':
                        $formato = 'Y-m-d';
                        $retorno = date($formato, strtotime($dt));
                        break;
                    case 'mes_ano':
                        $formato = 'm-Y';
                        $retorno = date($formato, strtotime($dt));
                        break;
                    case 'hora_segundo':
                        $formato = 'H:i:s';
                        $retorno = date($formato, strtotime($dt));
                        break;
                    case 'hora':
                        $formato = 'H:i';
                        $retorno = date($formato, strtotime($dt));
                        break;
                }
            }

        }
        elseif($format == 'br'){
            list ($y, $m, $d) = explode('-', $data);
            if($y <= 1970) {
                $retorno = sprintf("%02d/%02d/%04d", $d, $m, $y);
            }else{
                switch ($type){
                    case 'data_hora':
                        $formato = 'd/m/Y H:i:s';
                        break;
                    case 'data_hora_ns':
                        $formato = 'd/m/Y H:i';
                        break;
                    case 'data':
                        $formato = 'd/m/Y';
                        break;
                    case 'mes_ano':
                        $formato = 'm/Y';
                        break;
                    case 'hora_segundo':
                        $formato = 'H:i:s';
                        break;
                    case 'hora':
                        $formato = 'H:i';
                        break;
                }
                $retorno = date($formato, strtotime($data));
            }

        }elseif($format == 'banco'){
            switch ($type){
                case 'data_hora':
                    $formato = 'Y-m-d H:i:s';
                    $retorno = date($formato, strtotime($data));
                    break;
                case 'data_hora_ns':
                    $formato = 'Y-m-d H:i';
                    $retorno = date($formato, strtotime($data));
                    break;
                case 'data':
                    $formato = 'Y-m-d';
                    $retorno = date($formato, strtotime($data));
                    break;
                case 'mes_ano':
                    $formato = 'm-Y';
                    $retorno = date($formato, strtotime($data));
                    break;
                case 'hora_segundo':
                    $formato = 'H:i:s';
                    $retorno = date($formato, strtotime($data));
                    break;
                case 'hora':
                    $formato = 'H:i';
                    $retorno = date($formato, strtotime($data));
                    break;
            }
        }

        return $retorno;
    }
}

	if( ! function_exists('datetimeparabanco')){ 
		function datetimeparabanco($data)
		{
			$year = substr ( $data, 6, 4 );
			$month = substr ( $data, 3, 2 );
			$day =  substr ( $data, 0, 2 );
			$hour = substr ( $data, 11, 2 );
			$min = substr ( $data, 14, 2 );
			$data = mktime ( $hour, $min, 0, $month, $day, $year );
			return strftime("%Y-%m-%d %H:%M", $data);
		} 
	}

    if(!function_exists('limitarTexto')){
        function limitarTexto($texto, $limite){

            $contador = strlen($texto);
            if ( $contador > $limite ) {
                $texto = substr($texto, 0, $limite) . '...';
                return $texto;
            }
            else{
                return $texto;
            }
        }
    }

	if( ! function_exists('pegaParam1')){ 
		function pegaParam1($uri)
		{
			return base64_decode($uri->segment(3));
		} 
	}

	if( ! function_exists('pegaParam2')){ 
		function pegaParam2($uri)
		{
			return base64_decode($uri->segment(4));
		} 
	}

	if( ! function_exists('formata_numdoc'))
	{
		function formata_numdoc($num,$tamanho)
		{
			while(strlen($num)<$tamanho)
			{
				$num="0".$num; 
			}
			return $num;
		}
	}

	if( ! function_exists('tiraMoeda'))
	{
					
		function tiraMoeda($valor){
		    $pontos = array(",", ".");
		    $result = str_replace($pontos, "", $valor);
		    return $result;
		}
	}

	if( ! function_exists('montaLinha'))
	{
		
		function montaLinha($linha, $config, $tipo){

		    $novaLinha = '';
		    $dadosHeader = array_values($linha);
		    $dadosConfig = array_values($config);
		    $dadosTipo = array_values($tipo);
			
			
			
			$totallinha = 0;
		    // echo "<pre>";
		    for ($i = 0; $i < sizeof($linha); $i++) {
		        // echo ("<h1>" . $i . "</h1>");
		        if ($dadosTipo[$i] == "num") {
		            // echo ($i . " era do tamanho " . strlen($dadosHeader[$i]) . " e deve ficar com " . $dadosConfig[$i]);
		            while(strlen($dadosHeader[$i]) < $dadosConfig[$i]){
		                $dadosHeader[$i] = '0' . $dadosHeader[$i];
		            }
		            // echo (". Ficou com " . strlen($dadosHeader[$i]) . " > " . $dadosHeader[$i] . " (" . $dadosTipo[$i] . ")<br>");
		        } if ($dadosTipo[$i] == "str") {
		            // echo ($i . " era do tamanho " . strlen($dadosHeader[$i]) . " e deve ficar com " . $dadosConfig[$i]);
		            while(strlen($dadosHeader[$i]) < $dadosConfig[$i]){
		                $dadosHeader[$i] = $dadosHeader[$i] . " ";
		            }
                    while(strlen($dadosHeader[$i]) > $dadosConfig[$i]){
                        $dadosHeader[$i] = substr($dadosHeader[$i],0,-1);
                    }
		            // echo (". Ficou com " . strlen($dadosHeader[$i]) . " > " . $dadosHeader[$i] . " (" . $dadosTipo[$i] . ")<br>");
		        };
		        $novaLinha = $novaLinha . $dadosHeader[$i];
				
				$totallinha += $dadosConfig[$i];
		    }
		    //echo $novaLinha."\r\n";
			
		    // Abre ou cria o arquivo bloco1.txt
		    // "a" representa que o arquivo é aberto para ser escrito
		    $fp = fopen("remessa".date('dmY').".rem", "a");

		    // Escreve "exemplo de escrita" no bloco1.txt
		    $escreve = fwrite($fp, $novaLinha . "\r\n");

		    // Fecha o arquivo
		    fclose($fp);

		    return $novaLinha."\r\n";
		}
		
	}

	if( ! function_exists('montaLinha2'))
	{

		function montaLinha2($linha, $config, $tipo, $nome){

		    $novaLinha = '';
		    $dadosHeader = array_values($linha);
		    $dadosConfig = array_values($config);
		    $dadosTipo = array_values($tipo);



			$totallinha = 0;
		    // echo "<pre>";
		    for ($i = 0; $i < sizeof($linha); $i++) {
		        // echo ("<h1>" . $i . "</h1>");
		        if ($dadosTipo[$i] == "num") {
		            // echo ($i . " era do tamanho " . strlen($dadosHeader[$i]) . " e deve ficar com " . $dadosConfig[$i]);
		            while(strlen($dadosHeader[$i]) < $dadosConfig[$i]){
		                $dadosHeader[$i] = '0' . $dadosHeader[$i];
		            }
		            // echo (". Ficou com " . strlen($dadosHeader[$i]) . " > " . $dadosHeader[$i] . " (" . $dadosTipo[$i] . ")<br>");
		        } if ($dadosTipo[$i] == "str") {
		            // echo ($i . " era do tamanho " . strlen($dadosHeader[$i]) . " e deve ficar com " . $dadosConfig[$i]);
		            while(strlen($dadosHeader[$i]) < $dadosConfig[$i]){
		                $dadosHeader[$i] = $dadosHeader[$i] . " ";
		            }
                    while(strlen($dadosHeader[$i]) > $dadosConfig[$i]){
                        $dadosHeader[$i] = substr($dadosHeader[$i],0,-1);
                    }
		            // echo (". Ficou com " . strlen($dadosHeader[$i]) . " > " . $dadosHeader[$i] . " (" . $dadosTipo[$i] . ")<br>");
		        };
		        $novaLinha = $novaLinha . $dadosHeader[$i];

				$totallinha += $dadosConfig[$i];
		    }
		    //echo $novaLinha."\r\n";

		    // Abre ou cria o arquivo bloco1.txt
		    // "a" representa que o arquivo é aberto para ser escrito
		    $fp = fopen($nome, "a");

		    // Escreve "exemplo de escrita" no bloco1.txt
		    $escreve = fwrite($fp, $novaLinha . "\r\n");

		    // Fecha o arquivo
		    fclose($fp);

		    return $novaLinha."\r\n";
		}

	}

    if(!function_exists('envia_email')) {

    function envia_email($assunto, $mensagem, $para, $cc = "", $bcc = "", $anexo = "", $title, $reply)
    {
        $CI =& get_instance();
        $CI->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.l8.vc';
        $config['smtp_user'] = 'naoresponda@l8.vc';
        $config['smtp_pass'] = '4deb4NRx2';
        $config['smtp_port'] = 587;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $CI->email->initialize($config);

        $CI->email->from($config['smtp_user'], $title);
        $CI->email->to($para);

        if (!empty($reply)) $CI->email->reply_to($reply, $title);

        $CI->email->subject($assunto);
        $CI->email->message($mensagem);

        if (!empty($cc)) $CI->email->cc($cc);
        if (!empty($bcc)) $CI->email->bcc($bcc);
        //$CI->email->bcc($reply);
        if (!empty($anexo)) $CI->email->attach($anexo);

        if ($CI->email->send()) {
            return array('retorno' => true);
        } else {
            return array('retorno' => false, 'erro' => 'Erro ao enviar o e-mail.' . $CI->email->print_debugger());
        }
    }
}

    if( ! function_exists('paginacao_figueiredo')) {
        function paginacao_figueiredo($itens_por_pagina, $num_pagina, $total_registros, $total_paginas, $busca = "", $id = ""){
            $paginacao = '';
            $registros = '';

            $idPage = ((!empty($id)) ? 'id='.$id : '');

            if($total_paginas > 0 && $total_paginas != 1 && $num_pagina <= $total_paginas){
                $paginacao .= '<ul class="pagination pull-right" '.$idPage.'>';

                $links_direita    = $num_pagina + 3;
                $anteriores       = $num_pagina - 3;
                $proximos         = $num_pagina + 1;
                $voltar           = $num_pagina - 1;
                $primeiro_link    = true;

                $data_busca = ((!empty($busca) && !is_array($busca)) ? 'data-busca=' . $busca : '');

                if($num_pagina > 1){
                    $anteriores_link = ($voltar <= 0)? 1: $voltar;
                    $paginacao .= '<li class="paginate_button first mudaPagina"><a href="javascript: void(0)" style="padding: 9px 12px;" data-page="1" ' . $data_busca . ' title="Primeira"><i class="fa fa-angle-double-left"></i></a></li>';//&laquo;
                    $paginacao .= '<li class="paginate_button mudaPagina"><a href="javascript: void(0)" style="padding: 9px 12px;" data-page="' . $anteriores_link . '" ' . $data_busca . ' title="Anterior"><i class="fa fa-angle-left"></i></a></li>';//&lt;
                    for($i = ($num_pagina-2); $i < $num_pagina; $i++){
                        if($i > 0) {
                            $paginacao .= '<li class="paginate_button mudaPagina"><a href="javascript: void(0)" data-page="' . $i . '" ' . $data_busca . ' title="Pagina' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    $primeiro_link = false;
                }

                if($primeiro_link) {
                    $paginacao .= '<li class="paginate_button proxima active"><a href="javascript: void(0)" title="Pagina' . $num_pagina . '">' . $num_pagina . '</a></li>';
                } elseif($num_pagina == $total_paginas) {
                    $paginacao .= '<li class="paginate_button anterior active"><a href="javascript: void(0)" title="Pagina' . $num_pagina . '">' . $num_pagina . '</a></li>';
                } else {
                    $paginacao .= '<li class="paginate_button active"><a href="javascript: void(0)" title="Pagina' . $num_pagina . '">' . $num_pagina . '</a></li>';
                }

                for($i = $num_pagina+1; $i < $links_direita ; $i++){
                    if($i <= $total_paginas) {
                        $paginacao .= '<li class="paginate_button mudaPagina"><a href="javascript: void(0)" data-page="' . $i . '" ' . $data_busca . ' title="Pagina ' . $i . '">' . $i . '</a></li>';
                    }
                }

                if($num_pagina < $total_paginas){
                    $proximos_link = ($proximos > $total_paginas) ? $total_paginas : $proximos;
                    $paginacao .= '<li class="paginate_button mudaPagina"><a href="javascript: void(0)" data-page="' . $proximos_link . '" ' . $data_busca . ' title="Próxima" style="padding: 9px 12px;"><i class="fa fa-angle-right"></i></a></li>';//&gt;
                    $paginacao .= '<li class="paginate_button last mudaPagina"><a href="javascript: void(0)" data-page="' . $total_paginas . '" ' . $data_busca . ' title="Última" style="padding: 9px 12px;"><i class="fa fa-angle-double-right"></i></a></li>';//&raquo;
                }

                $paginacao .= '</ul>';

                if ($num_pagina){
                    $curr_offset = ($itens_por_pagina*$num_pagina) - $itens_por_pagina;
                    $info = 'Registros ' . ( $curr_offset + 1 ) . ' a ' ;

                    if(($curr_offset + $itens_por_pagina) < ($total_registros -1)) {
                        $info .= $curr_offset + $itens_por_pagina;
                    } else {
                        $info .= $total_registros;
                    }

                    $info .= ' de ' . $total_registros;

                    $registros .= '<a class="btn btn-danger btn-round">' . $info . '</a>';
                }else{
                    $info = 'Registros: ' . $total_registros;
                    $registros .= '<a class="btn btn-danger btn-round">' . $info . '</a>';
                }
            }

            $retorno = array('links' =>$paginacao, 'registros' => $registros);

            return $retorno;
        }
    }

    if(!function_exists('extensao')) {
        function extensaoImg($tipo)
        {
            $img_cam = base_url() . 'assets/imagem/extensoes';

            switch ($tipo) {
                case 'gif':
                    $ext = $img_cam . '/gif.png';
                    break;
                case 'png':
                    $ext = $img_cam . '/png.png';
                    break;
                case 'jpg':
                case 'jpeg':
                    $ext = $img_cam . '/jpg.png';
                    break;
                case 'pdf':
                    $ext = $img_cam . '/pdf.png';
                    break;
                case 'doc':
                case 'docx':
                    $ext = $img_cam . '/doc.png';
                    break;
                default:
                    $ext = '';
                    break;
            }
            return $ext;
        }
    }

    if(!function_exists('url_encode')) {
        function url_encode($encode)
        {
            return rawurlencode(base64_encode(str_replace(array('+', '=', '/'), array('_', '-', '~'), $encode)));
        }
    }

    if(!function_exists('url_decode')) {
        function url_decode($decode)
        {
            return base64_decode(rawurldecode($decode));
        }
    }

    if(!function_exists('base64_url_encode')){
        function base64_url_encode($input)
        {
            return strtr(base64_encode($input), '+/=', '._-');
        }
    }

    if(!function_exists('base64_url_decode')){
        function base64_url_decode($input)
        {
            return base64_decode(strtr($input, '._-', '+/='));
        }
    }

    if( ! function_exists('gerar_pdf')){
        function gerar_pdf($arquivo, $nome){
            $CI =& get_instance();
            $CI->load->library("pdf");
            if(!empty($arquivo)){
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->load_html($arquivo);
                $dompdf->setPaper('A4', 'landscape');

                //Renderizar o html
                $dompdf->render();


                //Exibibir a página
                $dompdf->stream(
                    "relatorio_" . $nome . ".pdf",
                    array(
                        "Attachment" => true //Para realizar o download somente alterar para true
                    )
                );
            }
        }
    }
