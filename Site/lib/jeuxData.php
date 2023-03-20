<?php

function getGamesByID(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM jeu WHERE id = :id;");
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch();
}

function getGamesByTitle(PDO $pdo)
{
    $query = $pdo->prepare("SELECT Titre FROM jeu;");
    $query->execute();
    return $query->fetchAll();
}

// Récupération de view

function addGameStatut(PDO $pdo, array $jeux)
{
    $receiveStatut = $pdo->prepare("SELECT * FROM jeu_jouable_vw WHERE Titre = :Titre;");
    $receiveStatut->bindParam(':Titre', $jeux['Titre']);
    $receiveStatut->execute();
    return $receiveStatut->fetch();
}

function addGameSupport(PDO $pdo, array $jeux)
{
    $receiveSupport = $pdo->prepare("SELECT * FROM jeu_support_vw WHERE ID = :id;");
    $receiveSupport->bindParam(':id', $jeux['ID']);
    $receiveSupport->execute();
    return $receiveSupport->fetchAll();
}

function addGameStyle(PDO $pdo, array $jeux)
{
    $receiveStyle = $pdo->prepare("SELECT * FROM jeu_style_vw WHERE ID = :ID;");
    $receiveStyle->bindParam(':ID', $jeux['ID']);
    $receiveStyle->execute();
    return $receiveStyle->fetchAll();
}

function addGameNbJoueur(PDO $pdo, array $jeux)
{
    $receiveNbJoueur = $pdo->prepare("SELECT * FROM jeu_nombre_joueur_vw WHERE ID = :ID;");
    $receiveNbJoueur->bindParam(':ID', $jeux['ID']);
    $receiveNbJoueur->execute();
    return $receiveNbJoueur->fetchAll();
}

function addGameMoteur(PDO $pdo, array $jeux)
{
    $receiveGameMoteur = $pdo->prepare("SELECT * FROM jeu_moteur_vw WHERE Titre = :Titre;");
    $receiveGameMoteur->bindParam(':Titre', $jeux['Titre']);
    $receiveGameMoteur->execute();
    return $receiveGameMoteur->fetchAll();
}

function addGameImg(PDO $pdo, array $jeux)
{
    $receiveGameImg = $pdo->prepare("SELECT * FROM image WHERE jeu_id = :jeu_id;");
    $receiveGameImg->bindParam(':jeu_id', $jeux['ID']);
    $receiveGameImg->execute();
    return $receiveGameImg->fetchAll();
}

function addUsersRoles(PDO $pdo, array $utilisateurs)
{
    $results = [];
    $receiveUsersRoles = $pdo->prepare("SELECT * FROM utilisateur_role_vw WHERE email = :email;");
    foreach ($utilisateurs as $utilisateur) {
        $receiveUsersRoles->bindParam(':email', $utilisateur['email']);
        $receiveUsersRoles->execute();
        $results[] = $receiveUsersRoles->fetchAll();
    }
    return $results;
}



// Récupère la table jeu dans l'ordre décroissant

function getGames(PDO $pdo, int $limit = NULL)
{
    $sql = 'SELECT * FROM jeu ORDER BY id DESC';

    if ($limit) {
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

// Récupère la table statut

function getGameStatut(PDO $pdo)
{
    $statut = $pdo->prepare("SELECT * FROM statut");
    $statut->execute();
    return $statut->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère la table moteur

function getGameMoteur(PDO $pdo)
{
    $moteur = $pdo->prepare("SELECT * FROM moteur");
    $moteur->execute();
    return $moteur->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère la table nombre_joueur

function getGameNombreJoueur(PDO $pdo)
{
    $nombreJoueur = $pdo->prepare("SELECT id_nombre_joueur, nom_nombre_joueur FROM nombre_joueur");
    $nombreJoueur->execute();
    return $nombreJoueur->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère la table support

function getGameSupport(PDO $pdo)
{
    $support = $pdo->prepare("SELECT id_support, nom_support FROM support");
    $support->execute();
    return $support->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère la table style

function getGameStyle(PDO $pdo)
{
    $style = $pdo->prepare("SELECT id_style, style FROM style");
    $style->execute();
    return $style->fetchAll(PDO::FETCH_ASSOC);
}

function getNews(PDO $pdo, int $limit = NULL)
{
    $sql = 'SELECT * FROM actualite ORDER BY id_actu DESC';

    if ($limit) {
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

function getNewsByID(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM actualite WHERE id_actu = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

// Affiche l'image par défaut si aucune image n'est sélectionnée

function getGameImg(string|null $image)
{
    if ($image === null) {
        return _ASSETS_IMG_PATH . 'default.jpg';
    } else {
        return _JEUX_IMG_PATH . $image;
    }
};

function getUsers(PDO $pdo)
{
    $query = $pdo->prepare("SELECT email, role_id FROM utilisateur");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
};

function getRole(PDO $pdo)
{
    $query = $pdo->prepare("SELECT * FROM role");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
};

function getFavoris(PDO $pdo, string $mail)
{
    $query = $pdo->prepare("SELECT * FROM utilisateur_jeu WHERE utilisateur_email = :email");
    $query->bindParam(':email', $mail);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
};

function getGamesTotalCost(PDO $pdo)
{
    $query = $pdo->prepare("SELECT SUM(budget) AS total FROM jeu WHERE jouable = 1");
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
};

function getLastMaj(PDO $pdo, int $id) {
    $query = $pdo->prepare("SELECT * FROM last_maj_user_vw WHERE jeu_ID = :id ORDER BY last_maj");
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



$insertStyle = "INSERT INTO jeu_style (jeu_id, style_id) VALUES (LAST_INSERT_ID(), :style);";
// INSERT TABLE jeu
function saveTableGames(PDO $pdo, string $Titre, string $Description, string|NULL $Image, int $style, int $support, int $statut, int $moteur, int $nombre_joueur, string $dateEstimeeFin, int $budget, int $userId)
{

    $query = $pdo->prepare("INSERT INTO jeu (id, Titre, Description, image, jouable, id_moteur, date_creation, date_estimee_fin, budget, createur_jeu_id) 
    VALUES (NULL, :Titre, :Description, :image, :jouable, :id_moteur, :date_creation, :date_estimee_fin, :budget, :createur_jeu_id);
    INSERT INTO jeu_nombre_joueur (jeu_id, nombre_joueur_id) VALUES (LAST_INSERT_ID(), :id_nombre_joueur);
    INSERT INTO jeu_support (jeu_id, support_id) VALUES (LAST_INSERT_ID(), :support);
    INSERT INTO jeu_style (jeu_id, style_id) VALUES (LAST_INSERT_ID(), :style);   
    ");
    if (empty($Titre) || empty($Description) || empty($style) || empty($support) || empty($statut) || empty($moteur) || empty($nombre_joueur) || empty($dateEstimeeFin) || empty($budget)) {


?>
        <script>
            Javascript: alert('Merci de remplir tous les champs !')
            document.location.replace("ajout_modification_jeu.php");
        </script>
<?php
    } else {
        $query->bindParam(':Titre', $Titre, PDO::PARAM_STR);
        $query->bindParam(':Description', $Description, PDO::PARAM_STR);
        $query->bindParam(':image', $Image, PDO::PARAM_STR);
        $query->bindParam(':style', $style, PDO::PARAM_INT);
        $query->bindParam(':support', $support, PDO::PARAM_INT);
        $query->bindParam(':jouable', $statut, PDO::PARAM_INT);
        $query->bindParam(':id_moteur', $moteur, PDO::PARAM_INT);
        $query->bindParam(':date_creation', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bindParam(':id_nombre_joueur', $nombre_joueur, PDO::PARAM_INT);
        $query->bindParam(':date_estimee_fin', $dateEstimeeFin, PDO::PARAM_STR);
        $query->bindParam(':budget', $budget, PDO::PARAM_INT);
        $query->bindParam(':createur_jeu_id', $userId, PDO::PARAM_INT);
        return $query->execute();
    }
};


function saveNews(PDO $pdo, string $titre, string $Texte, string $image)
{
    $dateActuelle = date('Y-m-d H:i:s');
    $query = $pdo->prepare("INSERT INTO actualite (Titre, Texte, image, date_creation) VALUES (:titre, :Texte, :image, :date_creation)");
    $query->bindParam(':titre', $titre, PDO::PARAM_STR);
    $query->bindParam(':Texte', $Texte, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    $query->bindParam(':date_creation', $dateActuelle, PDO::PARAM_STR);
    return $query->execute();
}







// FUNCTION UPDATE TABLE 

function updateGame(PDO $pdo, int $id, string $Description, int $statut, int $moteur, string $dateEstimeeFin, int $budget)
{
    $date = date('Y-m-d H:i:s');
    $query = $pdo->prepare("UPDATE jeu SET Description = :Description, jouable = :jouable, id_moteur = :id_moteur, date_estimee_fin = :date_estimee_fin, budget = :budget, date_last_maj = :date_last_maj WHERE id = :id;");
    $query->bindParam(':Description', $Description, PDO::PARAM_STR);
    $query->bindParam(':jouable', $statut, PDO::PARAM_INT);
    $query->bindParam(':id_moteur', $moteur, PDO::PARAM_INT);
    $query->bindParam(':date_estimee_fin', $dateEstimeeFin, PDO::PARAM_STR);
    $query->bindParam(':budget', $budget, PDO::PARAM_INT);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':date_last_maj', $date, PDO::PARAM_STR);
    return $query->execute();
};

function updateLastMaj(PDO $pdo, int $id, int $userId, string $commentaire) {
    
    $date = date('Y-m-d H:i:s');
    $query = $pdo->prepare("INSERT INTO last_maj (jeu_ID, last_maj, id_user, commentaire) VALUES (:id, :date_last_maj, :userId, :commentaire)");
    $query->bindParam(':date_last_maj', $date, PDO::PARAM_STR);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    return $query->execute();
}


function updateGameSupport(PDO $pdo, int $id, int $support)
{
    $query = $pdo->prepare("SELECT support_id FROM jeu_support WHERE jeu_id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $supports = $query->fetchAll(PDO::FETCH_COLUMN);

    if (count($supports) < 2 || in_array($support, $supports)) {
        $query = $pdo->prepare("INSERT INTO jeu_support (jeu_id, support_id) VALUES (:id, :support)
                                ON DUPLICATE KEY UPDATE support_id = :support");
        $query->bindParam(':support', $support, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } else {
        return false;
    }
}

function updateGameStyle(PDO $pdo, int $id, int $style)
{
    
    $query = $pdo->prepare("UPDATE jeu_style SET style_id = :style WHERE jeu_id = :id");

        $query->bindParam(':style', $style, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
   
}

function updateGameNombreJoueur(PDO $pdo, int $id, int $nbJoueur)
{
    $query = $pdo->prepare("SELECT nombre_joueur_id FROM jeu_nombre_joueur WHERE jeu_id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $nbJoueurs = $query->fetchAll(PDO::FETCH_COLUMN);

    if (count($nbJoueurs) < 3 || in_array($nbJoueur, $nbJoueurs)) {
        $query = $pdo->prepare("INSERT INTO jeu_nombre_joueur (jeu_id, nombre_joueur_id) VALUES (:id, :nombre_joueur)
                                ON DUPLICATE KEY UPDATE nombre_joueur_id = :nombre_joueur");
        $query->bindParam(':nombre_joueur', $nbJoueur, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } else {
        return false;
    }
}


function updateGameImage(PDO $pdo, int $id, string|NULL $image)
{
    if (!empty($image)) {
        $query = $pdo->prepare("UPDATE jeu SET image = :image WHERE ID = :id");
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } else {
        return false;
    }
};

function updateAdditionnalImages(PDO $pdo, int $id, array $jeux, string|NULL $additionalImage)
{
    if (empty(addGameImg($pdo, $jeux))) {
        $query = $pdo->prepare("INSERT INTO image (jeu_id, nom_image) VALUES (:id, :imageAdditional)");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':imageAdditional', $additionalImage, PDO::PARAM_STR);
        return $query->execute();
    } else {
        $query = $pdo->prepare("UPDATE image SET nom_image = :image WHERE id = :id");
        $query->bindParam(':imageAdditional', $additionalImage, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
};

function updateRole(PDO $pdo, string $email, int $role) 
{
    $query = $pdo->prepare("UPDATE utilisateur SET role_id = :role WHERE email = :email");
    $query->bindParam(':role', $role, PDO::PARAM_INT);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    return $query->execute();
};

function updateBudget(PDO $pdo, int $id, int $budget, string $dateEstimeeFin, int $jouable)
{
    $date = date('Y-m-d H:i:s');
    $query = $pdo->prepare("UPDATE jeu SET budget = :budget, date_estimee_fin = :date_estimee_fin , jouable = :jouable, date_last_maj = :date_last_maj WHERE id = :id");
    $query->bindParam(':budget', $budget, PDO::PARAM_INT);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':date_estimee_fin', $dateEstimeeFin, PDO::PARAM_STR);
    $query->bindParam(':jouable', $jouable, PDO::PARAM_INT);
    $query->bindParam(':date_last_maj',$date, PDO::PARAM_STR);
    return $query->execute();
};

function updateNews(PDO $pdo, int $id, string $titre, string $contenu)
{
    $query = $pdo->prepare("UPDATE actualite SET Titre = :Titre, Texte = :Texte, date_creation = :date_creation WHERE id_actu = :id");
    $query->bindParam(':Titre', $titre, PDO::PARAM_STR);
    $query->bindParam(':Texte', $contenu, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':date_creation', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    return $query->execute();
};

function updateNewsImage(PDO $pdo, int $id, string|NULL $image)
{
    if (!empty($image)) {
        $query = $pdo->prepare("UPDATE actualite SET image = :image WHERE id_actu = :id");
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } else {
        return false;
    }
};






/*

On souhaite ajouter des styles supplémentaire à un jeu.

il faut pouvoir ajouter un champ de type select multiple pour pouvoir ajouter plusieurs styles à un jeu.
Une fois cela fait, il faut boucler sur les styles sélectionnés pour les ajouter à la table jeu_style.

Si Aventure et Action sont sélectionnés,
    il faut ajouter les lignes suivantes dans la table jeu_style :
        - jeu_id = LAST_INSERT_ID(), style_id = 1 -> INSERT INTO jeu_style (jeu_id, style_id) VALUES (1, 1);
        - jeu_id = LAST_INSERT_ID(), style_id = 2  -> INSERT INTO jeu_style (jeu_id, style_id) VALUES (1, 2);
        


*/
