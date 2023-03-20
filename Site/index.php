<?php
require_once('lib/session.php');


require('templates/header.php');
require('lib/jeuxData.php');

$jeux = getGames($pdo, _HOME_GAMES_LIMIT);
$news = getNews($pdo);

// var_dump(intval($_SESSION['role']['role']));

?>



<!-- ########### FIRST SECTION ###########-->
<div class=" mx-auto md:px-32 md:pt-8 md:pb-8">
  <div id="carouselFrontPage mt-16">



    <!-- FIRST SECTION -->

    <div class="grid md:grid-cols-3 md:mb-16">

      <!-- CAROUSEL ACTU -->
      <div class="col-span-2 mx-8 py-4">
        <h2 class="text-slate-50 text-5xl text-center mb-8">Actualités</h2>

        <div id="animation-carousel" class="relative" data-carousel="static">
          <!-- Carousel wrapper -->
          <div class="relative h-56 overflow-hidden rounded-lg md:h-96">

            <?php foreach ($news as $key => $new) { 
              include('templates/carouselJeux_partial.php');
            }
            ?>
          </div>
          <!-- Slider controls -->
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
      <!-- QUI SOMMES-NOUS -->
      <div class="col-span-1">
        <h2 class="text-slate-50 text-5xl text-center mb-8">Qui sommes-nous</h2>
        <div class="px-8 pb-8 text-slate-50 text-justify">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
      </div>
    </div>

    <hr class="border-lime-500">

    <h2 class="text-5xl text-slate-50 text-center text pt-16 pb-16 px-4 underline decoration-lime-500">Nos jeux en cours de développement</h2>


    <!-- CAROUSEL -->
    <div class="carousel px-16 pt-16 pb-8 mt-8">

      <figure>
        <?php foreach ($jeux as $key => $jeu) {
          include('templates/recupCarouselAccueil.php');
        }
        ?>
      </figure>

      <nav>
        <button class="nav prev hover:ring-2 focus:ring-4 ring-lime-500">
          < </button>
            <button class="nav next hover:ring-2 focus:ring-4 ring-lime-500"> > </button>
      </nav>

    </div>

  </div>
  <!-- FIN CAROUSEL-->
</div>




<script src="js/carousel.js"></script>

<!-- FOOTER -->
<?php require('templates/footer.php'); ?>