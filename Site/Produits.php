<?php
require('templates/header.php');
require_once('lib/jeuxData.php');


$jeux = getGames($pdo);
if (isset($_SESSION['user']['email'])) {
  $users = $_SESSION['user']['email'];
};

$styles = getGameStyle($pdo);
$status = getGameStatut($pdo);

$favorisQuery = $pdo->prepare('SELECT * FROM utilisateur_jeu WHERE utilisateur_email = :mail');
$favorisQuery->bindParam(':mail', $users, PDO::PARAM_STR);
$favorisQuery->execute();
$favoris = $favorisQuery->fetchAll(PDO::FETCH_ASSOC);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/Produits.js"></script>


<!-- ########### FIRST SECTION ###########-->
<div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">


  <!-- FIRST SECTION -->
  <div class="w-full" id="mainSection">

    <h1 class="text-5xl text-slate-50 text-start text mt-6 mb-16 underline decoration-lime-500">
      Nos jeux
    </h1>
    <!-- 1ST GROUP -->

    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">


      <?php
      foreach ($jeux as $jeu) { ?>
        <div class="group relative">

          <p class="text-slate-50 text-2xl truncate py-8">
            <?= $jeu['Titre'] ?>
          </p>

          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <a href="jeu.php?id=<?= $jeu['ID'] ?>" class="">
              <img class="h-full w-full object-cover object-center lg:h-full lg:w-full" src="<?= getGameImg($jeu['image']); ?>" />
            </a>
          </div>

          <div class="mt-4 flex justify-between">


          <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2 || (intval($_SESSION['role']['role'])) == 5 || (intval($_SESSION['role']['role'])) == 6) {
            foreach ($favoris as $favori) {
              $favori = $favori['jeu_id'];
            }


            if (isset($favori) && $favori == $jeu['ID']) { ?>
              <div>
                <a href="favoris.php" class="text-slate-50 text-right border-2 border-lime-500 px-2 py-2 rounded-md my-2 mx-6">
                  <i class="fas fa-heart text-slate-50"></i> <span class="text-slate-50">Vous aimez ce jeu</span>
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
        </div>
      <?php } ?>
    
    </div>

  </div>

  <!-- 3RD GROUP -->

  <!-- FIN DU CONTENU -->
</div>

<!-- FOOTER -->


<?php
require('templates/footer.php');
?>