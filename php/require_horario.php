<?

$cpf = $_GET['cpf'] ?? '';
$id_remedio = $_GET['id_remedio'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT day(reg.horario) as dia, hour(reg.horario) as hora, minute(reg.horario) as minuto, hour(rec.horario) as preescrito_h, minute(rec.horario) as preescrito_m, rem.nome as remedio
        FROM Remedio as rem JOIN Registro as reg ON rem.id_remedio = reg.id_remedio
        JOIN Receita as rec ON rec.cpf = reg.cpf and rec.id_remedio = reg.id_remedio
        WHERE reg.cpf='$cpf' and rec.id_remedio = $id_remedio";
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

header('Content-Type: application/json');
echo json_encode($result);

?>
