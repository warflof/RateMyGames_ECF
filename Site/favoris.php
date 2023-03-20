<?php
require('templates/header.php');
require_once('lib/jeuxData.php');

$jeux = getGames($pdo);
$usersFavoris = getFavoris($pdo, $_SESSION['user']['email']);


?>
<?php
if (getFavoris($pdo, $_SESSION['user']['email']) == null) {
    echo '<div class="text-slate-50 text-center text-5xl py-8 mx-32">
        <div class="border-2 border-slate-50 rounded-md px-2 py-8">
            Vous n\'avez pas encore de favoris
        </div>
    </div>';
} else { ?>


    <div class="container mx-auto">
        <h1 class="text-slate-50 text-5xl text-center py-6">Mes Favoris</h1>
        <div class="mx-32 py-8 px-8 flex flex-row flex-wrap justify-center ">
            <?php
            foreach ($usersFavoris as $favoris) {
                $favoris['jeu_id'];
                $jeuId = intval($favoris['jeu_id']);
                foreach ($jeux as $jeu) {
                    if ($jeu['ID'] == $jeuId) { ?>
                        <div class="text-slate-50 mx-4 my-4 w-64">
                            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow h-68">
                                <div>
                                    <a href="Jeu.php?id=<?= $jeuId ?>">
                                        <img class="rounded-t-lg w-96 h-32 object-cover" src="<?= _JEUX_IMG_PATH . $jeu['image'] ?>" alt="" />
                                    </a>
                                </div>
                                <div class="p-5">
                                    <a href="Jeu.php?id=<?= $jeuId ?>">
                                        <h5 class="mb-2 text-2xl font-bold text-slate-50"><?= $jeu['Titre'] ?></h5>
                                        <h6 class="mb-2 text-xl font-bold text-slate-50">Score: <?= $jeu['score'] ?><i class="fa-sharp fa-regular fa-star text-lime-500"></i></h6>
                                    </a>
                                    <p class="mb-3 text-slate-50 truncate"><?= $jeu['Description'] ?></p>
                                    <a href="Jeu.php?id=<?= $jeuId ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-lime-700 rounded-lg hover:bg-lime-800">
                                        Aller à la page du jeu
                                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="lib/suppression_favoris.php?id=<?= $jeuId ?>&mail=<?=$favoris['utilisateur_email']?>" class="inline-flex items-center px-3 py-2 my-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800">
                                        Retirer des favoris
                                        <i class="fa-solid fa-circle-xmark ml-2"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
            <?php }
                }
            }
            ?>
        </div>
    </div>
<?php } ?>






<?php
require('templates/footer.php');
?>