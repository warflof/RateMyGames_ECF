<?php
// Connexion à la base de données
require_once 'lib/pdo.php';

// Récupérer les données de la table "produits"
$stmt = $pdo->prepare('SELECT * FROM jeu');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoyer les données sous forme de JSON
echo json_encode($products);
?>
