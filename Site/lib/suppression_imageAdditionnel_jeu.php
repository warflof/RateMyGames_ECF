<?php
require_once 'pdo.php';
require_once 'config.php'; // récupère les chemins des images

// Vérifie que les paramètres ID et image ont été transmis via GET
if (isset($_GET['id']) && isset($_GET['image']) && isset($_GET['nom_image'])) {
    // Récupère les paramètres et échappe les caractères spéciaux pour éviter les injections SQL
   
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    $image_id = htmlspecialchars($_GET['image'], ENT_QUOTES);
    $nom_image = htmlspecialchars($_GET['nom_image'], ENT_QUOTES);

    // Exécute la requête SQL pour supprimer l'image de la base de données
    $sql = "DELETE FROM image WHERE jeu_id = ? AND id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->bindValue(2, $image_id);
    $stmt->execute();

    // Supprime le fichier image du serveur
    unlink(_JEUX_IMG_PATH . $nom_image);

    // Redirige l'utilisateur vers la page précédente
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Si les paramètres sont manquants, affiche un message d'erreur
    echo "Erreur : paramètres manquants";
}
