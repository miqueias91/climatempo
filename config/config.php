<?php 
  $base     ="/var/www/climatempo";
  $base_http    = "http://localhost/climatempo/";

  $PATH_BASE_HTTP = $base_http;
  $CLASS_PATH    = $base."/class" ;
  $PATH_CLASS    = $CLASS_PATH ;
  $SCRIPT_PATH  = $base_http."/css" ;
  $PATH_CSS    = $SCRIPT_PATH ;
  $PATH_JS    = $base_http."/js" ;
  $FUNCTION_PATH  = $base."/funcoes" ;
  $PATH_FUNCTION  = $FUNCTION_PATH ;
  $IMAGE_PATH    = $base_http."/img" ;

  //Conexao com o db principal
  //include_once( "$base/class/class.Conexao.php" );
  //$conexao = Conexao::getInstance();

  if(empty($extraidos)){
    extract($_POST);
    extract($_GET);
    extract($_FILES);
    if(isset($_SESSION)){
      extract($_SESSION);
    }
    $extraidos = 1;
  }

  //Configuracao do Firebase
  $url_firebase = 'https://climatempo-1ee3b-default-rtdb.firebaseio.com'; 
  $token_firebase = 'YO9UxeO06wm3slQaOsE6HW16a7M54uYFun8Ruhss';