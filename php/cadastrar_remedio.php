<?

$cpf = $_GET['cpf'] ?? '';
$id_remedio = $_GET['id_remedio'] ?? '';
$horario = $_GET['horario'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "INSERT INTO Receita(cpf, id_remedio, horario) VALUES ('$cpf', $id_remedio, '$horario');";
$result = $pdo->query($sql);

?>
