<?php
require_once('lib/session.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once('templates/header.php');



require_once('lib/jeuxData.php');
require_once('lib/tools.php');






if (isset($_POST['saveGame'])) {


    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        $fileName = NULL;
        // la méthode getimagesize va retourner false si le fichier n'est pas une image
        $checkImage = getimagesize($_FILES['image']['tmp_name']);
        if ($checkImage !== false) {
            // on génère un nom unique et standardisé pour l'image
            $fileName = uniqid() . '-' . slugify($_FILES['image']['name']);

            move_uploaded_file($_FILES['image']['tmp_name'], _JEUX_IMG_PATH . $fileName);
        } else {
            echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">Le fichier n\'est pas une image</div></div>';
        }
    }


    $res = saveNews(
        $pdo,
        $_POST['Titre'],
        $_POST['Description'],
        $fileName
    );


    
    $error;
    if ($res) {
        $error = false;
        echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">L\'article a bien été ajouté</div></div>';
        // echo "<script>location.href = jeu.php?id=".$jeux['ID']." ;</script>";
    } else {
        $error = true;
        echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">L\'article n\'a pas été ajouté</div></div>';
    }
}

?>

<div class="container md:mx-auto md:px-32 py-6 pt-8 flex flex-col">

    <h1 class="text-5xl text-slate-50 text-center py-6">Ajouter un article</h1>

    <form method="POST" enctype="multipart/form-data">

        <!-- Titre -->

        <div class="py-3 px-8 mx-8">
            <label for="Titre"><span class="text-slate-50">Titre de l'actualité: </span></label>
            <input class="w-full rounded" type="text" name="Titre" id="Titre" placeholder="Le titre de votre actualité">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Titre'])) {
                echo '<div class="text-red-500">Veuillez renseigner un Titre</div>';
            }
            ?>
        </div>

        <!-- Description -->

        <div class="py-3 px-8 mx-8">
            <label for="Description"><span class="text-slate-50">Texte de votre actualité: </span></label>
            <textarea class="w-full h-32 rounded" type="Description" name="Description" id="Description" placeholder="Le texte de votre actualité"></textarea>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Description'])) {
                echo '<div class="text-red-500">Veuillez renseigner du texte</div>';
            }
            ?>
        </div>

        <!-- Image -->

        <div class="py-3 px-8 mx-8">
            <label for="Image"><span class="text-slate-50">Image: </span></label>
            <input type="file" name="image" id="Image" class="text-slate-50">

        </div>
        <hr class="my-8">
        <div class="mx-auto text-center">
            <input type="submit" value="Enregistrer" class="bg-slate-50 py-3 px-8 my-2 rounded" name="saveGame">
        </div>

    </form>


</div>



<?php
require('templates/footer.php');
?>