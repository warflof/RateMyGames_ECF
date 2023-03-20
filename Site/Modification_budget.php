<?php
require_once('lib/session.php');
if (intval($_SESSION['role']['role']) == 6 || intval($_SESSION['role']['role']) == 5) {
    header('Location: index.php');
}
require_once('templates/header.php');
require_once('lib/jeuxData.php');
require_once('lib/tools.php');


$id = (int)$_GET['id'];

$jeux = getGamesByID($pdo, $id);
$statuts = addGameStatut($pdo, $jeux);
$last_maj = getLastMaj($pdo, $id);
$userID = intval($_SESSION['id']['id']);


if (isset($_POST['modifyGame'])) {

    if (empty($_POST['budget'])) {
        echo $errors[] = '<div class="px-64 mx-64 py-8"><div class="px-32 mx-32 py-8 text-slate-50 text-center text-2xl border-2 border-red-500 rounded-md">Veuillez remplir tous les champs</div></div>';
    } else {

        $res = updateBudget(
            $pdo,
            $id,
            $_POST['budget'],
            $_POST['date_estimee_fin'],
            $_POST['jouable']
        );
        $res1 = updateLastMaj(
            $pdo,
            $id,
            $userID,
            $_POST['commentaire']
        );

        echo '<script>window.location.href = "Jeu.php?id=' . $id . '";</script>';
    }
}
?>


<div class="container md:mx-auto md:px-32 py-6 pt-8 flex flex-col text-center">

    <h1 class="text-5xl text-slate-50 text-center py-6">Modification de <br /><?= $jeux['Titre'] ?></h1>
    <div class="container flex justify-around py-2">
        <img class="object-contain object-center h-48 w-48" src="<?= getGameImg($jeux['image']) ?>" alt="">
    </div>
        <form method="POST" enctype="multipart/form-data" action="">
        <!-- Budget -->
        <div class="py-3 px-8 mx-8 text-center">
            <label for="budget"><span class="text-slate-50">Budget: </span></label>
            <input type="number" name="budget" id="budget" placeholder="" <?= $budgetvalue = $jeux['budget']; ?> value="<?= $budgetvalue; ?>"><span class="text-slate-50">€</span>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['budget'])) {
                echo '<div class="text-red-500">Veuillez renseigner un budget</div>';
            }
            ?>
        </div>
        <!-- Date de fin estimée -->

        <div class="py-3 px-8 mx-8">
            <div class="py-3">
                <label for="date_estimee_fin"><span class="text-slate-50">Date de fin estimée: </span></label>
                <input type="date" name="date_estimee_fin" id="date_estimee_fin" value="<?= $jeux['date_estimee_fin'] ?>">
            </div>
        </div>

        <!-- Statut -->

        <div class="py-3 mb-4 px-8 mx-8">
            <label for="jouable"><span class="text-slate-50">Statut: </span></label>
            <select class="rounded" type="Statut" name="jouable" id="jouable">
                <?php
                if (empty($statuts['Statut'])) {
                    echo '<option value="">Aucun statut</option>';
                } else {
                    echo '<option value="' . intval($statuts['jouable']) . '">' . $statuts['Statut'] . '</option>';
                };
                ?>
                <?php
                $statutsInBase = getGameStatut($pdo);
                foreach ($statutsInBase as $statutInBase) {
                    echo '<option value="' . intval($statutInBase['id_jouable']) . '">' . $statutInBase['Statut'] . '</option>';
                }
                ?>

            </select>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Statut'])) {
                echo '<div class="text-red-500">Veuillez renseigner au moins un statut</div>';
            }
            ?>
        </div>

        <div class="py-8">
            <p class="text-slate-50 pb-4" >Justification de la modification de budget:</p>
            <textarea class="w-2/3 h-64 rounded-md" placeholder="Veuillez justifier la modification du budget"type="textarea" name="commentaire" id="commentaire"></textarea>
        </div>


        <hr>



        <?php if($jeux['date_last_maj'] == null) { ?>
            <p class="text-slate-50 text-xl text-center pt-6">Le jeu n'a pas encore reçu de modification</p>
        <?php } else { ?>
            <?php foreach ($last_maj as $key => $maj) { ?>
        <div>
            <p class="text-slate-50 text-xl text-center pt-6">Dernière date de modification: <?= $maj['last_maj'] ?> par <span class="text-lime-500"><?= $maj['pseudo']?></span></p>
            <?php if($maj['commentaire'] != NULL){ ?>
            <p class="text-slate-50"><span class="text-lime-500 underline">Commentaire:</span> <?=$maj['commentaire'] ?></p>
            <?php } ?>
        </div>
        <?php } }; ?>




        <hr class="my-8">


        <!-- Bouton d'envoi du formulaire -->

        <div class="mx-auto text-center">
            <input type="submit" value="Enregistrer" class="bg-slate-50 py-3 px-8 my-2 rounded" name="modifyGame" action="dashboard_producer.php">
        </div>

    </form>

</div>





<?php
require_once('templates/footer.php');
?>