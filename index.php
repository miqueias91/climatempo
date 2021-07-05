<?php
  include_once "config/config.php";
  include_once "$CLASS_PATH/class.Curl.php";
  include_once "$CLASS_PATH/class.Climatempo.php";

  $con = new Curl();
  $ct = new Climatempo($url_firebase, $token_firebase);


  $id = isset($id) ? $id : null;

  if (isset($id)) {
    $previsao = $ct->buscaPrevisao('weather.json',$id);
  }
  

/*
  require 'vendor/autoload.php';
  $client = Elasticsearch\ClientBuilder::create()->build();
  if ($client) {
    echo 'conectado';
  }

$handler = new MockHandler([
  'status' => 200,
  'transfer_stats' => [
     'total_time' => 100
  ],
  'body' => fopen('base/locales.json'),
  'effective_url' => 'localhost'
]);
$builder = ClientBuilder::create();
$builder->setHosts(['somehost']);
$builder->setHandler($handler);
$client = $builder->build();
*/

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <form id="form" action="./" method="GET">
          <div class="row py-lg-1">
            <div class="col-lg-12 col-md-12 mx-auto">
              <div class="input-group mb-3">
                  <input type="search" class="form-control search" placeholder="Busque por uma cidade..." aria-label="Busque por uma cidade..." id="search" aria-describedby="search_button" value="">
                  <input type="hidden" name="id" id="idlocalizacao" value="">
                  <span class="input-group-text search_button" id="search_button"><i class="fas fa-search"></i></span>                
              </div>
            </div>
          </div>
        </form>
      </section>
      <div class="album py-5 bg-light">
        <div class="container">
          <?php if (isset($previsao)) { ?>
            <?php foreach ($previsao as $key => $prev) {
            ?>
              <h1 class="cidade_previsao">Previsão para <?php echo $prev['locale']['name']?> - <?php echo $prev['locale']['state']?> <i class="fas fa-map-marker-alt"></i></h1>

                <br>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                  <div class="col-md-12">
                    <div class="card shadow-sm">
                      <div class="card-header">
                        <h5 class="card-title">Conversão dos valores:</h5>
                        <div class="card-subtitle mb-2 text-muted">Temperatura:
                          <input class="form-check-input temperatura" type="radio" name="temperatura" checked id="celsius">°C
                          <input class="form-check-input temperatura" type="radio" name="temperatura" id="fahrenheit">°F
                        </div>
                        <div class="card-subtitle mb-2 text-muted">Chuva:
                          <input class="form-check-input chuva" type="radio" name="chuva" checked id="mm">mm
                          <input class="form-check-input chuva" type="radio" name="chuva" id="inch">inch
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <?php
              foreach ($prev['weather'] as $key => $value) { 
              ?>
                <br>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                  <div class="col-md-12">
                    <div class="card shadow-sm">
                      <div class="card-header">
                        <h5 class="card-title"><?php echo date('d/m/Y', strtotime($value['date']))?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $value['text']?></h6>
                        
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between  card_temperatura">
                          <div class="col-md-6 max">
                            <img src="img/upload.png">
                            <span class="celsius visivel_temperature"><?php echo $value['temperature']['max']?>°C</span>                  
                            <span class="fahrenheit esconder_temperature"><?php echo (($value['temperature']['max'] * 1.8) + 32)?>°F</span>                  
                          </div>
                          <div class="col-md-6 min">
                            <img src="img/download.png">
                            <span class="celsius visivel_temperature"><?php echo $value['temperature']['min']?>°C</span>                  
                            <span class="fahrenheit esconder_temperature"><?php echo (($value['temperature']['max'] * 1.8) + 32)?>°F</span>                  
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center card_cordicoes">
                          <div class="col-md-6">
                            <img src="img/raindrop-close-up.png">
                            <span class="mm visivel_chuva"><?php echo $value['rain']['precipitation']?>mm</span>                  
                            <span class="inch esconder_chuva"><?php echo round(($value['rain']['precipitation'] / 25.4),3)?>inch</span>                  
                          </div>
                          <div class="col-md-6">
                            <img src="img/protection-symbol-of-opened-umbrella-silhouette-under-raindrops.png">
                            <span class=""><?php echo $value['rain']['probability']?>%</span>                  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
        //VERIFICO QUAL CONVERSAO ESTAVA MARCADO
        if ($('#celsius').prop("checked")) {
          $(".celsius").removeClass( "esconder_temperature" ).addClass( "visivel_temperature" );
          $(".fahrenheit").removeClass( "visivel_temperature" ).addClass( "esconder_temperature" );
        }
        else{
          $(".celsius").removeClass( "visivel_temperature" ).addClass( "esconder_temperature" );
          $(".fahrenheit").removeClass( "esconder_temperature" ).addClass( "visivel_temperature" );
        }

        //FACO A BUSCA DA LOCALIDADE NA MEDIDA QUE O USUARIO FOR DIGITANDO
        $('#search').autocomplete({
          source: "buscaLocalizacao.php",
          minLength: 1,
          select: function( event, ui ) {
            $('#search').attr('value',ui.item.id);
            $('#idlocalizacao').attr('value',ui.item.id);
          }
        });

        //BUSCO A PREVISAO PARA LOCALIDADE
        $('#search_button').click(function(){
          if($('#idlocalizacao').val() != ""){
            var id = $('#idlocalizacao').val();
            $('#form').attr('action', "./?id="+id);
            $('#form').submit();
          }
          else{
            alert('Não foi possível buscar a localidade, tente novamente.')
          }
        });

        //DE ACORDO COM O TIPO DE CONVEESAO DA TEMPERATURA EXIBO OS VALORES
        $('.temperatura').change(function(){
          var temperatura = $(this).attr('id');
          if (temperatura == 'celsius') {
            $(".celsius").removeClass( "esconder_temperature" ).addClass( "visivel_temperature" );
            $(".fahrenheit").removeClass( "visivel_temperature" ).addClass( "esconder_temperature" );
          }
          else{
            $(".celsius").removeClass( "visivel_temperature" ).addClass( "esconder_temperature" );
            $(".fahrenheit").removeClass( "esconder_temperature" ).addClass( "visivel_temperature" );
          }
        });

        $('.chuva').change(function(){
          var chuva = $(this).attr('id');
          if (chuva == 'mm') {
            $(".mm").removeClass( "esconder_chuva" ).addClass( "visivel_chuva" );
            $(".inch").removeClass( "visivel_chuva" ).addClass( "esconder_chuva" );
          }
          else{
            $(".mm").removeClass( "visivel_chuva" ).addClass( "esconder_chuva" );
            $(".inch").removeClass( "esconder_chuva" ).addClass( "visivel_chuva" );
          }
        });

      });
    </script>
  </body>
</html>
