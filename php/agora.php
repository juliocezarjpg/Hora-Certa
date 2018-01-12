<?


$cpf = $_GET['cpf'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT hour(NOW()), minute(NOW())";
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

$hour_now = (string)$result[17].(string)$result[18];
$minute_now = (string)$result[38].(string)$result[39];

$sql = "SELECT rem.nome, hour(rec.horario) as hora, minute(rec.horario) as minuto
        FROM Receita as rec JOIN Remedio as rem ON rec.id_remedio = rem.id_remedio
        WHERE cpf='$cpf'";

$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

$flag = 'nada';

foreach($array as $json){
  if ($json->hora == $hour_now){
    if ($json->minuto == $minute_now){
      $flag = $json->nome;
    }
  }
}

echo $flag;
// echo 'Ibuprofeno';


?>
