<?php
require_once('templates/header.php');
require_once('lib/config.php');
require_once('lib/jeuxData.php');

$news = getnews($pdo);


?>

<script>
    window.setTimeout( function() {
  window.location.reload();
}, 15000);
</script>

<!-- Container for demo purpose -->
<div class="container py-24 px-6 mx-auto">

  <!-- Section: Design Block -->
  <section class="mb-32 text-slate-50 text-center md:text-left">

    <h2 class="text-3xl font-bold mb-12 text-center">Dernières actualités de GameSoft</h2>
<?php foreach ($news as $new) { ?>
    <a href="article.php?id=<?=$new['id_actu'] ?>">
    <div class="md:grid md:grid-cols-2 gap-x-6 xl:gap-x-12 items-center mb-12">
      <div class="mb-6 md:mb-0">
        <div
          class="object-cover w-full h-64 rounded-lg overflow-hidden shadow-l "
          data-mdb-ripple="true" data-mdb-ripple-color="light">
          <img src="<?= _JEUX_IMG_PATH . $new['image'] ?>"
            class="w-full" alt="<?= $new['Titre'] ?>" />
        </div>
      </div>

      <div class="mb-6 md:mb-0">
        <h3 class="text-2xl font-bold mb-3"><?= $new['Titre'] ?></h3>
        <div class="mb-3 text-red-600 font-medium text-sm flex items-center justify-center md:justify-start">
        <!-- Possibilité de mettre des catégories -->
        </div>
        <p class="text-lime-500 mb-6">
          <small>Publiée le <u><?= $new['date_creation'] ?></u></small>
        </p>
        <p class="text-gray-500 truncate">
          <?= $new['Texte'] ?>
        </p>
      </div>
    </div>
    </a>
<?php } ?>

  </section>
  <!-- Section: Design Block -->

</div>
<!-- Container for demo purpose -->

<?php require_once ('templates/footer.php'); ?>