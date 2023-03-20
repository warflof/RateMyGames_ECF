<?php
require_once 'pdo.php';
require_once 'config.php'; // récupère les chemins des images

// Vérifie que le paramètre ID a été transmis via GET
if (isset($_GET['id'])) {
    // Récupère le paramètre et échappe les caractères spéciaux pour éviter les injections SQL
    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);

    // Exécute la requête SQL pour récupérer les noms d'images associées au jeu
    $sql = "SELECT nom_image FROM image WHERE jeu_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Exécute la requête SQL pour supprimer l'image associée au jeu de la base de données
    $sql = "SELECT image FROM jeu WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $imageJeu = $stmt->fetch(PDO::FETCH_COLUMN);

    unlink(_JEUX_IMG_PATH . $imageJeu);

    // Exécute la requête SQL pour supprimer le jeu de la base de données
    $sql = "DELETE FROM jeu WHERE ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    // Supprime les fichiers images associés au jeu du serveur
    foreach ($images as $image) {
        unlink(_JEUX_IMG_PATH . $image);
    }

    // Redirige l'utilisateur vers la page précédente
    
        header('Location: ../dashboard.php');
        exit();
    }
 else {
    // Si le paramètre est manquant, affiche un message d'erreur
    echo "Erreur : paramètre manquant";
}
