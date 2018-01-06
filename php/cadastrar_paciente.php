<!--  mysql -u root -p -->
<!-- abc123 -->
<?php

$nome = $_POST['nome'] ?? '';
$sobrenome = $_POST['sobrenome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "INSERT INTO Usuario(email, senha, cpf, nome, sobrenome, tipo)
        VALUES ('$email','$senha','$cpf', '$nome', '$sobrenome', '$tipo');";
$result = $pdo->query($sql);

if ($tipo == 'm'){
  header('Location: /Hora-Certa/doctor.php');
}
else {
  header("Location: /Hora-Certa/patient.php?cpf=$cpf&&nome=$nome $sobrenome");
}

?>
