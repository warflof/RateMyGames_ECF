<?php
require('templates/header.php');
require_once('lib/jeuxData.php');


$id = (int)$_GET['id'];
$news = getnews($pdo);

foreach ($news as $new) {
    if ($new['id_actu'] == $id) {
    }
}
?>


<?php
foreach ($news as $new) {
    if ($new['id_actu'] == $id) { ?>

        <div class="container md:mx-auto content-center py-12 pb-20">
            <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 5) { ?>
                <div class="md:py-8 text-center md:text-right md:mr-8">
                    <a href="Modification_article.php?id=<?= $id ?>" 
                    class="bg-lime-500 rounded-md font-bold px-4 py-2 md:ml-1 md:mr-6 border-2 border-slate-50 text-slate-50 text-right">
                        Modifier l'article
                    </a>
                </div>
            <?php } ?>
            <?php if ($new['image'] != null) { ?>
                <img class="py-4 pt-8 md:mx-auto" src="<?= _JEUX_IMG_PATH . $new['image'] ?>" alt="<?= $new['Titre'] ?>" />
            <?php }
            ?>
            <div class="pb-16">
                <h1 class="text-slate-50 text-5xl py-4 px-4"><?= $new['Titre'] ?></h1>
                <p class="text-slate-50 px-6"><?= $new['date_creation'] ?></p>
            </div>
            <p class="text-slate-50 text-center md:text-left"><?= $new['Texte'] ?></p>

    <?php }
}
    ?>


    <?php
    require('templates/footer.php');
    ?>