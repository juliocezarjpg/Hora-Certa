<!--  mysql -u root -p -->
<!-- abc123 -->
<?php

$username = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = 'select email, senha, tipo, cpf, nome, sobrenome from Usuario';
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

$correto = 0;

foreach($array as $json){

  if ($json->email == $username)
    if ($json->senha == $pass){
      $correto = 1;
      $tipo = $json->tipo;
      $cpf = $json->cpf;
      $nome = $json->nome;
      $sobrenome = $json->sobrenome;
    }
}

if ($correto == 1)
  if ($tipo == 'm'){
    header('Location: /Hora-Certa/doctor.php');
  }
  else {
    header("Location: /Hora-Certa/patient.php?cpf=$cpf&&nome=$nome $sobrenome");
  }
else
  header('Location: /Hora-Certa');

?>
