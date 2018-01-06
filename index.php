<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Hora Certa</title>
  <script defer src = "js/formata_CPF.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="form">
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Entrar</a></li>
        <li class="tab"><a href="#signup">Registrar</a></li>
      </ul>

      <div class="tab-content">


        <div id="login">
          <h1>Bem vindo de volta!</h1>
          <form action ="php/autentic.php" method="post" name="sentMessage" id="contactForm">
            <div class="field-wrap">
            <label>
              Endereço de Email<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off"name="username"/>
          </div>

          <div class="field-wrap">
            <label>
              Senha<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off"name="password"/>
          </div>


          <p id="incorrect"></a></p>
          <button class="button button-block"/>Entrar</button>
          </form>

        </div>

        <div id="signup">
          <h1>Registre-se Gratuitamente</h1>

          <form name = "form2" action="php/cadastrar_paciente.php" method="post">

            <div class="top-row">
              <div class="field-wrap">
                <label>
                  Nome<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name="nome"/>
              </div>

              <div class="field-wrap">
                <label>
                  Sobrenome<span class="req">*</span>
                </label>
                <input type="text"required autocomplete="off" name="sobrenome"/>
              </div>
            </div>

            <div class="field-wrap">
              <label>
                CPF<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="cpf" id="cpf" maxlength="14" onkeydown="FormataCPF()";/>
            </div>

            <div class="field-wrap">
              <label>
                Endreço de email<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name="email"/>
            </div>

            <div class="field-wrap">
              <label>
                Crie uma senha<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name="senha"/>
            </div>

            <div class="field-wrap">
              <select id="tipo" required name="tipo">
                <option value="m" >Médico</option>
                <option value="p" >Paciente</option>
              </select>
            </div>

            <button type="submit" class="button button-block"/>Registrar</button>
          </form>
        </div>
      </div><!-- tab-content -->
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>
</body>
</html>
