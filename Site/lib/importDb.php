<?php
$servername = _SERVER_NAME;
$username = _USER_NAME;
$password = _PASSWORD;
$dbname = _DB_NAME;

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// On définit le mode d'erreur de PDO sur Exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Importer le fichier SQL
  $sql = file_get_contents("ratemygamesDb.sql");
  // Séparer les instructions SQL
  $queries = explode(";", $sql);

  // Exécuter chaque instruction SQL
  foreach ($queries as $query) {
    $pdo->exec($query);
  }

 
  ?> 
  <script>alert("DB import succes")</script>
  echo '<script>location.href = "../index.php";</script>';
  <?php
} catch(PDOException $e) {
  ?> 
  <script>alert("DB import failed")</script>
  <?php
}

$pdo = new PDO('mysql:dbname=ratemygames;host=localhost;charset=utf8mb4', 'root', '');