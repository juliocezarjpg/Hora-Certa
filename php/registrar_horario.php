<?

$cpf = $_GET['cpf'] ?? '';
$remedio = $_GET['remedio'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT id_remedio FROM Remedio WHERE nome='$remedio'";

$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

$id_remedio = 0;
foreach($array as $json){
  $id_remedio = $json->id_remedio;
}

$sql = "INSERT INTO Registro (cpf, id_remedio, horario) VALUES ('$cpf',$id_remedio, NOW())";
$result = $pdo->query($sql);

?>
