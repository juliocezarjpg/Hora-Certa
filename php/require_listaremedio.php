<?

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT nome, id_remedio as id
        FROM Remedio";
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

header('Content-Type: application/json');
echo json_encode($result);

?>
