<div class="flex flex-col border-l-2 border-gray-800 items-center py-2">
    <!-- <div class="w-32 h-12">
        <p class="text-slate-50">
            <?= $jeu['Titre'] ?>
        </p>
    </div> -->
    <a href="jeu.php?id=<?= $jeu['ID'] ?>" class="">
        <img class="rounded-lg hover:brightness-150 transition duration object-content" src="<?= getGameImg($jeu['image']); ?>" />
    </a>
    <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2 || (intval($_SESSION['role']['role'])) == 5 || (intval($_SESSION['role']['role'])) == 6) {

    if (isset($favoris[0]['jeu_id']) && intval($favoris[0]['jeu_id']) === $jeu['ID']) { ?>
                        <div class="text-right py-6">
                            <a href="favoris.php" class="text-slate-50 text-right border-2 border-lime-500 px-2 py-2 rounded-md my-2 mx-6">
                                <i class="fas fa-heart text-slate-50"></i> <span class="text-slate-50">Ce jeu est déjà dans vos favoris</span>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="text-right py-6">
                            <a href="ajouter_favoris.php?id=<?= $jeu['ID'] ?>&mail=<?= $users ?>" style="cursor: pointer;" class="text-slate-50 text-right border-2 border-lime-500 px-2 py-2 rounded-md my-2 mx-6">
                                <i class="fa-regular fa-heart"></i> Ajouter aux favoris
                            </a>
                        </div>

                <?php }
                } ?>
</div>