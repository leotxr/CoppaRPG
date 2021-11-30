<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CoppaRPG</title>
  <link rel="shortcut icon" href="coppacolor.png">
  <!-- Bootstrap 4.6 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <!-- Icones Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- jQuery do Bootstrap-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script src="{{url("assets/js/javascript.js")}}"></script>
  <!-- APIs do Google -->
  <script src="googleapi.js"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="941435246321-fo7ipjq61soqgm2v19bpmh99m5nht1lm.apps.googleusercontent.com">

  <!-- JQuery e Ajax p/ paginas-->
  <script src="js\jquery-3.6.0.min.map"></script>
  <script src="js\jquery-3.6.0.js"></script>
  <script src="js\ajax.js"></script>

  <!-- CSS Complementar -->
  <link rel="stylesheet" href="css/painel.css">
<!-- JS -->
  <script src="js\evento.js"></script>

</head>

<body>

  <section id="section" style="color: #121212">
    @yield('content')

  </section>


</body>

</html>