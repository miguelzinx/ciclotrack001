<?php 
include "layout/header/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CicloTrack | Rotas </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rotas.css">
</head>
<body>
      <section class="home-hero">
        <div class="home-hero__content">
          <h1 class="heading-primary">Encontre a Rota Perfeita para Você!</h1>
          <div class="home-hero__info">
           
          </div>
           <div class="home-hero__cta">
            <a href="./rotas.php#formulario" class="btn btn--bg">Vamos descobrir?</a>
          </div>
        </div>
      
      </section>
<br><br><br><br><br>
      <section>
        <div id="routePanel">
            <h2>Planeje sua rota</h2>
            <label for="start">Ponto de Partida:</label>
            <input type="text" id="start" placeholder="Ex: Joinville">
            <label for="end">Destino:</label>
            <input type="text" id="end" placeholder="Ex: Florianópolis">
            <button onclick="planRoute()">Traçar Rota</button>
            <div id="routeInfo"></div>
        </div>
        <div id="map"></div>
    </section>
<br><br><br><br><br>
</section>

    <script src="assets/js/index.js"></script>
    <script src="assets/js/rotas.js"></script>

</body>
<?php
include "layout/footer/footer.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $start = $_POST['start'];
  $end = $_POST['end'];
  
  // Aqui você pode conectar com banco de dados ou processar os dados
  echo "Rota de $start para $end foi traçada com sucesso!";
}
    ?>
</html>