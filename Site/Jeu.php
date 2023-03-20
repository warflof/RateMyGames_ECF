<?php
require('templates/header.php');
require_once('lib/jeuxData.php');


$id = (int)$_GET['id'];

$jeux = getGamesByID($pdo, $id);
$statut = addGameStatut($pdo, $jeux);
$supports = addGameSupport($pdo, $jeux);
$styles = addGameStyle($pdo, $jeux);
$nbJoueurs = addGameNbJoueur($pdo, $jeux);
$moteur = addGameMoteur($pdo, $jeux);
$image = addGameImg($pdo, $jeux);

if (isset($_SESSION['user']['email'])) {
    $users = $_SESSION['user']['email'];
};


$favorisQuery = $pdo->prepare('SELECT * FROM utilisateur_jeu WHERE jeu_id = :id AND utilisateur_email = :mail');
$favorisQuery->bindParam(':id', $id, PDO::PARAM_INT);
$favorisQuery->bindParam(':mail', $users, PDO::PARAM_STR);
$favorisQuery->execute();
$favoris = $favorisQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="md:py-8">
    <div class="container mx-auto px-2">

        <!-- Si l'utilisateur n'est pas un admin, il ne peut pas modifier ou supprimer le jeu -->
        <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1) { ?>

            <div class="flex item-center md:text-right">
                <a href="Modification_jeu.php?id=<?= $jeux['ID'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-1 border-2 border-slate-50 text-slate-50" type="button">
                    Modifier
                </a>
                <a href="lib/suppression_jeu.php?id=<?= $jeux['ID'] ?>" onclick="return confirmBox()" class="bg-lime-500 rounded-md font-bold px-4 py-2 ml-1 border-2 border-slate-50 text-slate-50" type="button">
                    Supprimer
                </a>
                <script>
                    function confirmBox() {
                        if (confirm("Voulez-vous vraiment supprimer ce jeu ?")) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>

            <?php } ?>

            <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2) { ?>
                <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 2) { ?>
                    <div class="text-right pt-4">
                    <?php } ?>
                    <a href="Modification_budget.php?id=<?= $jeux['ID'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 ml-1 mr-6 border-2 border-slate-50 text-slate-50 text-center" type="button">
                        Modifier le budget
                    </a>
                    </div>
                <?php } ?>

                <!-- Si l'utilisateur n'est pas enregistrer, il ne peut pas mettre le jeu en favoris -->
                <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2 || (intval($_SESSION['role']['role'])) == 5 || (intval($_SESSION['role']['role'])) == 6) {

                    // Retirer le bouton si le jeu est déjà dans les favoris de l'utilisateur
                    // Afficher un bouton retirer de mes favoris à la place


                    if (isset($favoris[0]['jeu_id']) && intval($favoris[0]['jeu_id']) === $id) { ?>
                        <div class="text-right py-6">
                            <a href="favoris.php" class="text-slate-50 text-right border-2 border-lime-500 px-2 py-2 rounded-md my-2 mx-6">
                                <i class="fas fa-heart text-slate-50"></i> <span class="text-slate-50">Ce jeu est déjà dans vos favoris</span>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="text-right py-6">
                            <a href="lib/ajouter_favoris.php?id=<?= $id ?>&mail=<?= $users ?>" style="cursor: pointer;" class="text-slate-50 text-right border-2 border-lime-500 px-2 py-2 rounded-md my-2 mx-6">
                                <i class="fa-regular fa-heart"></i> Ajouter aux favoris
                            </a>
                        </div>

                <?php }
                } ?>


                <div class="md:flex">
                    <div class="w-full h-full md:w-1/2">
                        <div class="pt-12">
                            <h3 class="text-3xl text-center mb-2 font-bold uppercase lg:text-5xl text-slate-50"><?= $jeux['Titre'] ?></h3>
                            <div class="mt-8 text-center">
                                <label class="text-1xl text-slate-50 ">
                                    Developper par GameSoft
                                </label>
                                <div class="mx-auto md:w-1/3 px-auto border-2 rounded border-lime-500 my-2">
                                    <p class="justify-center px-2 py-4 text-slate-50 text-2xl font-bold"><?= $statut['Statut'] ?> </p>
                                </div>

                            </div>
                        </div>
                        <!-- Début image Galery -->
                        <?php
                        if(empty($image)){ ?>
                        <div class="text-center py-6">
                            <p class="text-slate-50">Le jeu ne contient pas encore d'images</p>
                        </div>
                    <?php } else {?>
                        <div id="default-carousel" class="relative py-8" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                <?php
                                foreach ($image as $img) { ?>
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg" src="<?= getGameImg($img['nom_image']) ?>">
                                    </div>
                                <?php } ?>

                                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Fin image Galery -->





                    </div>

                    <!-- Partie Droite -->

                    <div class="max-w-lg mx-auto mt-5 md:ml-auto md:mt-0 md:w-1/2 lg:py-12 flex flex-col justify-center">
                        <img class="w-full content-center rounded-md object-cover max-w-lg mx-auto object-cover" src="<?= getGameImg($jeux['image']); ?>" alt="<?= $jeux['Titre'] ?>">
                    </div>
                </div>

            </div>
</main>

<div class="py-8 px-4 md:my-16 md:mx-48 md:px-48 content-center md:my-4 md:mx-24">
    <h3 class="text-slate-50 text-2xl font-medium md:py-12"><?= $jeux['Description'] ?></h3>
</div>

<div class="bg-gray-700 w-full  md:h-48 md:flex md:flex-row border-y-2 border-lime-500 py-2">
    <div class="md:basis-1/6"></div>
    <div class="basis-2/6 md:basis-1/6 py-4 px-2 md:border-r md:border-lime-500 lg:border-b-0 border-b border-lime-500 ">
        <div class="text-slate-50 text-center md:text-left">
            <div class="py-2.5">
                <?php
                if (!isset($supports)) {
                    echo '<kbd class="px-2 py-1.5 text-xl font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">Aucun</kbd>';
                } else {
                    foreach ($supports as $support) {
                        echo '<kbd class="mx-0.5 px-2 py-1.5 text-xl font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $support['nom_support'] . '</kbd>';
                    }
                } ?>

                <!-- ###############  STYLE  ################# -->

            </div>
            <div class="py-2.5">
                <?php
                if (!isset($styles)) {
                    echo '<kbd class="px-2 py-1.5 text-xl font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">Aucun</kbd>';
                } else {
                    foreach ($styles as $style) {

                        // Trouver un moyen de mettre les pastilles à la ligne.
                        echo '<kbd class="mx-0.5 px-2 py-1.5 text-xl font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $style['style'] . '</kbd>';
                    }
                } ?>
            </div>
            <div class="py-2.5">
                <!-- Boucler pour afficher les nombres de joueurs -->

                <?php
                if (empty($nbJoueurs[0]['nom_nombre_joueur'])) {
                    echo '<kbd class="px-2 py-1.5 text-base font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">Non-Référencé</kbd>';
                } else {
                    foreach ($nbJoueurs as $nbJoueur) {
                        echo '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $nbJoueur['nom_nombre_joueur'] . '</kbd>';
                    }
                } ?>



            </div>
        </div>

    </div>

    <div class="basis-1/6 md:basis-2/6 lg:border-b-0 md:border-r md:border-lime-500 border-b border-lime-500">
        <div class="py-12">
            <!-- Score  -->
            <?php
            if (empty($jeux['score'])) {
                echo '<p class="text-slate-50 text-2xl font-bold text-center flex flex-wrap justify-around">Ce jeu n\'a pas encore reçu de note</p>';
            } else { ?>
                <p class="text-center text-slate-50 text-2xl md:text-5xl font-bold">Note: <?= $jeux['score'] ?><i class="fa-sharp fa-regular fa-star text-lime-500"></i></p>
            <?php }
            ?>
        </div>
    </div>

    <!-- Date De Création -->

    <div class="basis-1/6 md:basis-2/6 mx-0.5 my-auto text-center md:text-left">
        <div class="mx-2 py-2">
            <?php
            if (empty($jeux['date_creation'])) {
                echo '<p class="text-slate-50 mx-2 font-bold">Date estimée de fin: ' . '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $jeux['date_estimee_fin'] . '</kbd>' . '</p>';
            } else {
                echo '<p class="text-slate-50 font-bold">Date de création: ' . '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $jeux['date_creation'] . '</kbd>' . '</p>';
            }
            ?>
        </div>

        <!-- Dernière Mise à Jour -->

        <div class="mx-2 py-2">
            <?php
            if (empty($jeux['date_last_maj'])) {
                echo '<p class="text-slate-50 font-bold">Dernière mise à jour: ' . '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . ' Doucement bijou ' . '</kbd>' . '</p>';
            } else {
                echo '<p class="text-slate-50 font-bold">Dernière mise à jour: ' . '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . $jeux['date_last_maj'] . '</kbd>' . '</p>';
            }
            ?>
        </div>

        <!-- Moteur -->

        <div class="mx-2 py-2">
            <?php
            if (empty($jeux['id_moteur'])) {
                echo '<p class="text-slate-50 mx-2 font-bold">Moteur: ' . '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' . ' On se tâte encore ' . '</kbd>' . '</p>';
            } else {
                echo '<p class="text-slate-50 font-bold">Moteur: ' .
                    '<kbd class="mx-0.5 px-2 py-1.5 text-sm font-bold text-slate-50 bg-lime-500 border border-gray-200 rounded-lg">' .
                    $moteur[0]['moteur_nom'] .
                    '</kbd>' .
                    '</p>';
            }
            ?>
        </div>
    </div>



</div>


<?php
require('templates/footer.php');
?>