<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Hora Certa</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

    <style>
    #table table .material-icons {
      transition: color .3s;
    }

    .material-icons:hover {
      cursor: pointer;
      color: #999;
    }

    table {
      border-collapse: collapse;
      text-align: center;
      width: 400px;
    }

    table tr td:first-child{
      text-align: left;
    }

    table thead tr th:first-child{
      text-align: left;
    }


    #tabela table tr:nth-child(2n+1){
      background-color: rgba(0, 0, 0, 0.05);
    }

    </style>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Hora Certa </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Pacientes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Sobre</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contato</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/Hora-Certa/">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Bem vindo ao Hora Certa</h1>
        <p class="lead">Um acompanhamento diário feito com carinho para você!</p>
      </div>
    </header>

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Pacientes</h2>
              <div id="tabela">
                <?php

                      echo "<table>";
                      $dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
                      $user = 'root';
                      $senha = 'abc123';
                      $pdo = new PDO($dsn, $user, $senha);


                      $sql = 'select * from Usuario WHERE tipo = "p"';
                      $result = $pdo->query($sql);
                      $result = $result->fetchAll(PDO::FETCH_ASSOC);
                      $result = json_encode($result);
                      $array = json_decode($result);
                      foreach($array as $json){
                        //echo $json['nome']; // you can access your key value like this if result is array
                       // echo $json->nome; // you can access your key value like this if result is object
                       echo "<tr> <td>{$json->nome} {$json->sobrenome}</td><td><i class='material-icons' name='remed'>local_hospital</i></td><td><i class='material-icons' name='graf'>assessment</i></td><td style='visibility: hidden'>{$json->cpf}</td></tr>";
                       // echo $line;
                     }
                     echo "</table>";
                ?>
                </div>
                <div id="cadastro_dos_remedios" style="margin-top:20px; visibility:hidden">
                  <div id="nome_cadastrar" style="display:inline-block; margin-left:10px"></div>
                  <div id="cadastrar" style="display:inline-block; margin-left:10px"></div>
                  <div style="display:inline-block; margin-left:10px">
                    <input type="text" id="horario_cadastrar" value="00:00" style="width: 50px">
                  </div>
                  <div style="display:inline-block; margin-left:10px">
                    <button id="botao_cadastrar" type="button" name="button">Cadastrar</button>
                  </div>
                  <div id="tabela_remedios" style="margin-top:5px"></div>
                </div>
                <div id = "box" name="caixa" style="margin-top:20px"></div>
                <div id="g_chart">
                  <div id="curve_chart"  style="width: 700px; height: 500px"></div>
             </div>
          </div>
        </div>
      </div>
    </section>

    <section id="services" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Sobre o Hora Certa</h2>
            <p class="lead">O Hora certa é um projeto que pretende ajudar as pessoas, principalmente os idosos a cuidarem melhor da sua saúde. Fazemos isso através de:</p>
            <ul>
              <li>Lembretes diários no horário em que é necessário tomar o remédio</li>
              <li>Hardware Simplificado</li>
              <li>Acompanhamento ponta a ponta, entre o paciente e o médico</li>
            </ul>
          </div>
        </div>
      </div>
    </section>



    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Entre em contato com conosco</h2>
            <p class="lead">Ficou com alguma dúvida? Tem alguma sugestão? Mande um email para nós:</p>
            <p class="lead">contato@horacerta.com</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Hora Certa 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>
    <script src="js/doctor.js"></script>
  </body>

</html>
