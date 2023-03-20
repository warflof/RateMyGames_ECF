<?php
$servername = _SERVER_NAME;
$username = _USER_NAME;
$password = _PASSWORD;
$dbname = _DB_NAME;

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // On définit le mode d'erreur de PDO sur Exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch(PDOException $e) {
  ?> 
  <script>alert("Connexion failed")</script>
  <?php
}


?>
