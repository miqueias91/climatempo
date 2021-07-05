<?php
class Climatempo extends Curl{
	public $url_firebase = '';
	public $token_firebase = '';

	public function __construct($url_firebase, $token_firebase){
		$this->url_firebase = $url_firebase;
		$this->token_firebase = $token_firebase;
	}

    public function buscaLocalizacao($url,$cidade){
        //CODIFICANDO A VARIAVEL $cidade
        //BUSCANDO A COLUNA 'name' PARTE DA INFORMACAO QUE O USUARIO DIGITOU
        return (array) Curl::get($this->url_firebase.'/'.$url.'?orderBy="name"&startAt="'.urlencode($cidade).'"&endAt="'.urlencode($cidade).'\uf8ff"');
    }

    public function buscaPrevisao($url,$id){
        //BUSCANDO O CLIMA PELO ID DA LOCALIZACAO
        return Curl::get($this->url_firebase.'/'.$url.'?orderBy="locale/id"&equalTo='.$id);
    }


}