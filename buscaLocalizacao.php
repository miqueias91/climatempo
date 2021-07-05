<?php
	include_once "config/config.php";
	include_once "$CLASS_PATH/class.Curl.php";
	include_once "$CLASS_PATH/class.Climatempo.php";

	$con = new Curl();
	$ct = new Climatempo($url_firebase, $token_firebase);

	//TRATANDO O TERMO DIGITADO PELO USUARIO
	$_GET['term'] = ucfirst(strtolower($_GET['term']));

	//BUSCA A LOCALIDADE
	$localidade = $ct->buscaLocalizacao('locales.json',$_GET['term']);
	$localidade = empty($localidade) ? NULL : $localidade;

	if (!empty($localidade)) {
		$i = 0;
		foreach ($localidade as $loc){
			//PEGO APENAS O NOME, ESTADO E ID DA LOCALIZACAO
			$dados[$i]['value'] = $loc['name'].' - '.$loc['state'];
			$dados[$i]['id'] = $loc['id'];
			$i++;
		}
		echo json_encode($dados);
	}