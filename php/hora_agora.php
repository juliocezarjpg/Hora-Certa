<?


$cpf = $_GET['cpf'] ?? '';

$dsn = 'mysql:host=127.0.0.1;dbname=horacerta_db';
$user = 'root';
$senha = 'abc123';
$pdo = new PDO($dsn, $user, $senha);

$sql = "SELECT hour(NOW()) as hora, minute(NOW()) as minute";
$result = $pdo->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);
$array = json_decode($result);

foreach ($array as $json) {
  $hour_now = $json->hora;
  $minute_now = $json->minute;
}

echo $hour_now;
echo ":";
if ($minute_now < 10) echo "0";
echo $minute_now;

?>
