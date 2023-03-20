<?php
require_once('lib/session.php');
if (intval($_SESSION['role']['role'])==6) {
    header('Location: index.php');
} 
require_once('templates/header.php');
require_once('lib/jeuxData.php');
require_once('lib/tools.php');


$id = (int)$_GET['id'];

$news = getNewsByID($pdo, $id);




if (isset($_POST['modifyGame'])) {

    // if (empty($_POST['Titre']) || empty($_POST['Description']) || empty($_POST['jouable']) || empty($_POST['id_moteur']) || empty($_POST['date_estimee_fin']) || empty($_POST['budget']) || empty($_POST['support']) || empty($_POST['style']) || empty($_POST['nb_joueurs']) || empty($_POST['statut'])) {
    //     echo $errors[] = '<div class="px-64 mx-64 py-8"><div class="px-32 mx-32 py-8 text-slate-50 text-center text-2xl border-2 border-red-500 rounded-md">Veuillez remplir tous les champs</div></div>';
    // } else {

        $fileName = NULL;

        // Vérifie si une seule image a été uploadée
        if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
            // la méthode getimagesize va retourner false si le fichier n'est pas une image
            $checkImage = getimagesize($_FILES['file']['tmp_name']);
            if ($checkImage !== false) {
                // on génère un nom unique et standardisé pour l'image
                $fileName = uniqid() . '-' . slugify($_FILES['file']['name']);

                move_uploaded_file($_FILES['file']['tmp_name'], _JEUX_IMG_PATH . $fileName);
            } else {
                echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">Le fichier n\'est pas une image</div></div>';
            }
        };

        // Vérifie si plusieurs images ont été uploadées
        // if (isset($_FILES['imageAdditional']['tmp_name']) && !empty($_FILES['imageAdditional']['tmp_name'][0])) {
        //     // prépare la requête d'insertion
        //     $stmt = $pdo->prepare('INSERT INTO image (jeu_id, nom_image) VALUES (:jeu_id, :name)');

        //     // boucle sur chaque fichier téléchargé
        //     foreach ($_FILES['imageAdditional']['tmp_name'] as $key => $tmp_name) {
        //         // la méthode getimagesize va retourner false si le fichier n'est pas une image
        //         $checkImage = getimagesize($tmp_name);
        //         if ($checkImage !== false) {
        //             // on génère un nom unique et standardisé pour l'image
        //             $multipleFileName = uniqid() . '-' . slugify($_FILES['imageAdditional']['name'][$key]);

        //             move_uploaded_file($tmp_name, _JEUX_IMG_PATH . $multipleFileName);

        //             // insère les informations de l'image dans la table images
        //             $stmt->execute([
        //                 'jeu_id' => $id,
        //                 'name' => $multipleFileName
        //             ]);
        //         } else {
        //             echo $errors[] = 'Le fichier ' . $_FILES['imageAdditional']['name'][$key] . ' n\'est pas une image';
        //         }
        //     }
        // };

      

        $res = updateNews(
            $pdo,
            $id,
            $_POST['Titre'],
            $_POST['Description'],
            $fileName
        );
        $res2 = updateNewsImage(
            $pdo,
            $id,
            $fileName
        );
      
        echo '<script>window.location.href = "article.php?id='.$id.'";</script>';
    }

  

?>


<div class="container md:mx-auto md:px-32 py-6 pt-8 flex flex-col">

    <h1 class="text-5xl text-slate-50 text-center py-6">Modification de <br /><?= $news['Titre'] ?></h1>

    <form method="POST" enctype="multipart/form-data" action="">

        <!-- Titre -->

        <div class="py-3 px-8 mx-8">
            <label for="Titre"><span class="text-slate-50">Nom du jeu: </span></label>
            <input class="w-full rounded" type="text" name="Titre" id="Titre" value="<?= $news['Titre'] ?>">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST['Titre'])) {
                echo '<div class="text-red-500">Veuillez renseigner un Titre</div>';
            }
            ?>
        </div>

        <!-- Description -->

        <div class="py-3 px-8 mx-8">
            <label for="Description"><span class="text-slate-50">Description: </span></label>
            <textarea class="w-full h-32 rounded" type="Description" name="Description" id="Description"><?= $news['Texte'] ?></textarea>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST['Description'])) {
                echo '<div class="text-red-500">Veuillez renseigner une description</div>';
            }
            ?>
        </div>

       

        <!-- Image -->

        <div class="py-3 px-8 mx-8">
            <label for="file"><span class="text-slate-50">Image de couverture: </span></label>
            <input type="file" name="file" id="file" class="text-slate-50">
            <div class="flex items-center">
                <?php
                if (!empty($news['image'])) {
                    echo '<img src="' . _JEUX_IMG_PATH . $news['image'] . '" alt="image du jeu" class="w-1/6 ml-0 py-4 object-cover">
                    <a href="lib/suppression_imageArticle.php?id=' . $news['id_actu'] . '&nom_image=' . $news['image'] . '" class="ml-4 py-2 px-4 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                    Supprimer l\'image de couverture
                    </a>';
                }
                ?>


            </div>
        </div>

      

        <hr class="my-8">


        <!-- Bouton d'envoi du formulaire -->

        <div class="mx-auto text-center">
            <input type="submit" value="Enregistrer" class="bg-slate-50 py-3 px-8 my-2 rounded" name="modifyGame" action="">
        </div>

    </form>

</div>






    <?php
    require('templates/footer.php');
    ?>