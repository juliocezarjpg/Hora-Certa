<?

$cpf = $_GET['cpf'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT rem.nome, rem.id_remedio as id, rec.horario as horario
        FROM Remedio as rem JOIN Receita as rec ON rem.id_remedio = rec.id_remedio
        WHERE rec.cpf = '$cpf'";
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

header('Content-Type: application/json');
echo json_encode($result);

?>
