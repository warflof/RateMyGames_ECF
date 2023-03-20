<?php
require_once('lib/session.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
require_once('templates/header.php');



require_once('lib/jeuxData.php');
require_once('lib/tools.php');


$userId = $_SESSION['id']['id'];



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
    };
    // if (empty($_POST['Titre']) || empty($_POST['Description']) || empty($_POST['jouable']) || empty($_POST['id_moteur']) || empty($_POST['date_estimee_fin']) || empty($_POST['budget']) || empty($_POST['support']) || empty($_POST['style']) || empty($_POST['nb_joueurs']) || empty($_POST['statut'])|| empty($fileName)) {
    //     echo $errors[] = '<div class="px-64 mx-64 py-8"><div class="px-32 mx-32 py-8 text-slate-50 text-center text-2xl border-2 border-red-500 rounded-md">Veuillez remplir tous les champs</div></div>';
    // } else {


    $res = saveTableGames(
        $pdo,
        $_POST['Titre'],
        $_POST['Description'],
        $fileName,
        $_POST['style'],
        $_POST['id_support'],
        $_POST['Statut'],
        $_POST['moteur'],
        $_POST['nombre_joueurs'],
        $_POST['date_estimee_fin'],
        $_POST['budget'],
        $userId
    );
    
    $id = $pdo->query('SELECT LAST_INSERT_ID()')->fetchColumn();
    echo '<script>location.href = "Jeu.php?id='.$id.'";</script>';


    var_dump($_POST);


    $error;
    if ($res) {
        $error = false;
        echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">Le jeu a bien été ajouté</div></div>';
        echo "<script>location.href = jeu.php?id=".$jeux['ID']." ;</script>";
    } else {
        $error = true;
        echo '<div class="w-96 mx-auto py-4"><div class="text-slate-50 text-center text-2xl py-8 border-2 border-solid rounded-md">Le jeu n\'a pas été ajouté</div></div>';
    }
}

?>

<div class="container md:mx-auto md:px-32 py-6 pt-8 flex flex-col">

    <h1 class="text-5xl text-slate-50 text-center py-6">Ajouter un jeu</h1>

    <form method="POST" enctype="multipart/form-data">

        <!-- Titre -->

        <div class="py-3 px-8 mx-8">
            <label for="Titre"><span class="text-slate-50">Nom du jeu: </span></label>
            <input class="w-full rounded" type="text" name="Titre" id="Titre" placeholder="Le titre de votre jeu">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Titre'])) {
                echo '<div class="text-red-500">Veuillez renseigner un Titre</div>';
            }
            ?>
        </div>

        <!-- Description -->

        <div class="py-3 px-8 mx-8">
            <label for="Description"><span class="text-slate-50">Description: </span></label>
            <textarea class="w-full h-32 rounded" type="Description" name="Description" id="Description" placeholder="La description de votre jeu"></textarea>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Description'])) {
                echo '<div class="text-red-500">Veuillez renseigner une description</div>';
            }
            ?>
        </div>


        <!-- Style -->

        <div class="py-3 px-8 mx-8">
            <label for="style"><span class="text-slate-50">Style: </span></label>
            <select class="w-full rounded" type="input" name="style" id="style">
                <option value="0"> -- Choisissez un style --</option>
                <?php
                $styles = getGameStyle($pdo);
                foreach ($styles as $style) {
                    echo '<option value="' . $style['id_style'] . '">' . $style['style'] . '</option>';
                }
                ?>
            </select>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['style'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un style</div>';
            }
            ?>
        </div>

        <!-- Support -->

        <div class="py-3 px-8 mx-8">
            <label for="id_support"><span class="text-slate-50">support: </span></label>
            <select class="w-full rounded" type="input" name="id_support" id="id_support">
                <option value="0"> -- Choisissez un support --</option>

                <?php
                $supports = getGameSupport($pdo);
                foreach ($supports as $support) {
                    echo '<option value="' . $support['id_support'] . '">' . $support['nom_support'] . '</option>';
                }
                ?>
            </select>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_support'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un support</div>';
            }
            ?>
        </div>

        <!-- Statut -->

        <div class="py-3 px-8 mx-8">
            <label for="Statut"><span class="text-slate-50">Statut: </span></label>
            <select class="w-full rounded" type="Statut" name="Statut" id="Statut">
                <option value="0"> -- Choisissez un statut --</option>

                <?php
                $statuts = getGameStatut($pdo);
                foreach ($statuts as $statut) {
                    echo '<option value="' . $statut['id_jouable'] . '">' . $statut['Statut'] . '</option>';
                }
                ?>

            </select>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Statut'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un statut</div>';
            }
            ?>
        </div>

        <!-- Moteur -->

        <div class="py-3 px-8 mx-8">
            <label for="moteur"><span class="text-slate-50">Moteur de développement: </span></label>
            <select class="w-full rounded" type="moteur" name="moteur" id="moteur">
                <option value="0"> -- Choisissez un moteur --</option>

                <?php
                $moteurs = getGameMoteur($pdo);
                foreach ($moteurs as $moteur) {
                    echo '<option value="' . $moteur['id'] . '">' . $moteur['moteur_nom'] . '</option>';
                }
                ?>
            </select>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['moteur'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un moteur</div>';
            }
            ?>
        </div>

        <!-- Nombre de joueurs -->

        <div class="py-3 px-8 mx-8">
            <label for="nombre_joueurs"><span class="text-slate-50">Nombre de joueur(s): </span></label>
            <select class="w-full rounded" type="moteur" name="nombre_joueurs" id="nombre_joueurs">
                <option value="0"> -- Choisissez un nombre de joueurs --</option>

                <?php
                $nombre_joueurs = getGameNombreJoueur($pdo);
                foreach ($nombre_joueurs as $nombre_joueur) {
                    echo '<option value="' . $nombre_joueur['id_nombre_joueur'] . '">' . $nombre_joueur['nom_nombre_joueur'] . '</option>';
                };
                ?>
            </select>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_joueurs'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un nombre de joueur</div>';
            }
            ?>
        </div>

        <!-- Date de fin estimée -->

        <div class="py-3 px-8 mx-8">
            <div class="py-3">
                <label for="date_estimee_fin"><span class="text-slate-50">Date de fin estimée: </span></label>
                <input type="date" name="date_estimee_fin" id="date_estimee_fin" value="2024-12-31">
            </div>

            <!-- Budget -->

            <div class="py-3">
                <label for="budget"><span class="text-slate-50">Budget: </span></label>
                <input type="number" name="budget" id="budget" placeholder="100000" value="0"><span class="text-slate-50">€</span>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['budget'])) {
                    echo '<div class="text-red-500">Veuillez renseigner un budget</div>';
                }
                ?>
            </div>
        </div>

        <!-- Image -->

        <div class="py-3 px-8 mx-8">
            <label for="Image"><span class="text-slate-50">Image <span id="nbImage">1</span>: </span></label>
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