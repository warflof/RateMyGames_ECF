<?php
require_once 'pdo.php';



if (isset($_GET['id']) && isset($_GET['mail'])) {

    $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    $userMail = htmlspecialchars($_GET['mail'], ENT_QUOTES);

    
        $query = $pdo->prepare("INSERT INTO utilisateur_jeu (utilisateur_email, jeu_id) VALUES (:userEmail, :jeuId)");
        $query->bindParam(':userEmail', $userMail, PDO::PARAM_STR);
        $query->bindParam(':jeuId', $id, PDO::PARAM_INT);
        $query->execute();

        $queryRate = $pdo->prepare("UPDATE jeu SET score = score + 1 WHERE id = :jeuId");
        $queryRate->bindParam(':jeuId', $id, PDO::PARAM_INT);
        $queryRate->execute();

        header('Location: ../jeu.php?id=' . $id);
    
}


