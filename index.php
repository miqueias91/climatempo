<?php
  include_once "config/config.php";
  include_once "$CLASS_PATH/class.Curl.php";
  include_once "$CLASS_PATH/class.Climatempo.php";

  $con = new Curl();
  $ct = new Climatempo($url_firebase, $token_firebase);

  $search = isset($search) ? $search : 'São%20Paulo';

  if (isset($search)) {
    //BUSCA A LOCALIDADE
    $localidade = $ct->buscaLocalizacao('locales.json',$search);
    print_r($localidade);
    $localidade = empty($localidade) ? NULL : $localidade[0];

    if (isset($localidade)) {
      $previsao = $ct->buscaPrevisao('weather.json',$localidade['id']);
      $previsao = $previsao[0];
    }
  }

?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Descubra como vai ficar o tempo para os próximos dias em Osasco e São Paulo utilizando seu smartphone.">
    <meta name="author" content="Miqueias Matias Caetano, and Bootstrap contributors">
    <meta name="generator" content="Clima 0.84.0">
    <title>CLIMATEMPO</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontawesome-free-5.15.3/css/all.css" rel="stylesheet"> 
    <!--load all styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    
<header>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="./" class="navbar-brand d-flex align-items-center logo_header">
        <img src="img/logo-white.png" alt="" width="130">
      </a>
    </div>
  </div>
</header>

<main>
  <section class="py-1 text-center container">
    <div class="row py-lg-1">
      <div class="col-lg-12 col-md-12 mx-auto">
        <div class="input-group mb-3">
          <input type="search" class="form-control search" placeholder="Busque por uma cidade..." aria-label="Busque por uma cidade..." name="search" id="search" aria-describedby="search_button">
          <span class="input-group-text search_button" id="search_button"><i class="fas fa-search"></i></span>
        </div>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <?php if (isset($previsao)) {
      ?>
        <h1 class="cidade_previsao">Previsão para <?php echo $localidade['name']?> - <?php echo $localidade['state']?></h1>
        <?php foreach ($previsao['weather'] as $key => $value) { ?>
          <br>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col-md-12">
              <div class="card shadow-sm">
                <div class="card-header">
                  <h5 class="card-title"><?php echo $value['date']?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?php echo $value['text']?></h6>
                  
                </div>
                <div class="card-body">
                  <div class="d-flex justify-content-between  card_temperatura">
                    <div class="col-md-6 max">
                      <img src="img/upload.png">
                      <span><?php echo $value['temperature']['max']?>°C</span>                  
                    </div>
                    <div class="col-md-6 min">
                      <img src="img/download.png">
                      <span><?php echo $value['temperature']['min']?>°C</span>                  
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center card_cordicoes">
                    <div class="col-md-6">
                      <img src="img/raindrop-close-up.png">
                      <span><?php echo $value['rain']['precipitation']?>mm</span>                  
                    </div>
                    <div class="col-md-6">
                      <img src="img/protection-symbol-of-opened-umbrella-silhouette-under-raindrops.png">
                      <span><?php echo $value['rain']['probability']?>%</span>                  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Voltar ao topo</a>
    </p>
    <p class="mb-1">&copy; Desenvolvido por Miqueias Matias Caetano - 2021</p>
  </div>
</footer>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
        //alert('ok')
      });
    </script>
      
  </body>
</html>
