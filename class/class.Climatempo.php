<?php
class Climatempo extends Curl{
	public $url_firebase = '';
	public $token_firebase = '';

	public function __construct($url_firebase, $token_firebase){
		$this->url_firebase = $url_firebase;
		$this->token_firebase = $token_firebase;
	}

    public function buscaLocalizacao($url,$cidade){
    	echo $this->url_firebase.'/'.$url.'?orderBy="name"&equalTo="'.$cidade.'"';
        return (array) Curl::get($this->url_firebase.'/'.$url.'?orderBy="name"&equalTo="'.$cidade.'"');
    }

    public function buscaPrevisao($url,$id){
        return Curl::get($this->url_firebase.'/'.$url.'?orderBy="locale/id"&equalTo='.$id);
    }


}