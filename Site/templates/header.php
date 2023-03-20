<?php
require_once('lib/session.php');
require_once('lib/config.php');
require_once('lib/pdo.php');

if ($_SESSION == null) {
  $_SESSION['role'] = array('role' => 0);
}

//$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="icon" href="img/logoSMsizePad.png" />
  <script src="https://kit.fontawesome.com/f1835f8fb9.js" crossorigin="anonymous"></script>

  <title>RateMyGames</title>
</head>


<!-- ########## NAVBAR ############# TEST -->

<div class="min-h-screen">

<nav class="px-2 py-4 bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
  <div class="container flex flex-wrap items-center justify-between mx-auto">
    <a href="Index.php" class="flex items-center">
      <img src="img/logoSMsizePad.png" class="h-6 mr-3 sm:h-9" alt="RateMyGames Logo" />
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
        RateMyGames
      </span>
      <span class="text-slate-50 ml-2">by GameSoft</span>
    </a>

    <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-multi-level" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
      <ul class="md:items-center flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li class="">
          <a href="index.php" class="block py-2 pl-3 pr-4 text-slate-500 rounded md:bg-transparent md:text-slate-50 md:p-0 dark:text-white">
            Accueil
          </a>
        </li>
        <li class="">
          <a href="news.php" class="block py-2 pl-3 pr-4 text-slate-50 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-500 md:p-0 dark:text-slate-50 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
            Actualités
          </a>
        </li>
        <li class="">
                <a href="Produits.php" class="block py-2 pl-3 pr-4 text-slate-50 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-500 md:p-0 dark:text-slate-50 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Nos jeux</a>
              
        </li>

        <!-- Accès aux admins, producer et CM -->

        <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2 || (intval($_SESSION['role']['role'])) == 5) { ?>
          <li class="">
            <p id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-center inline-flex block py-2 pl-3 pr-4 text-slate-50 rounded  md:hover:bg-transparent md:hover:text-slate-50 md:p-0">
              Dashboard
              <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </p>
          </li>
          <!-- Dropdown menu -->
        <?php } ?>
        <!-- Accès uniquement aux admins -->

        <div id="dropdownHover" class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
          <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
            <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1) { ?>
              <li>
                <a href="dashboard.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Modification jeux
                </a>
              </li>
            <?php } ?>

            <!-- Accès uniquement aux admins et aux producteurs -->

            <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role']) == 2)) { ?>
              <li>
                <a href="dashboard_producer.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Modifier le Budget
                </a>
              </li>
            <?php } ?>

            <!-- Accès uniquement aux admins -->

            <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1) { ?>
              <li>
                <a href="gestion_utilisateur.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Gestion des utilisateurs
                </a>
              </li>
            <?php } ?>

            <?php if (isset($_SESSION['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2) { ?>
              <li>
                <a href="ajout_modification_jeu.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Ajouter un Jeu
                </a>
              </li>
            <?php }
            ?>
            <!-- Accès uniquement aux admins et aux CM -->

            <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 5) { ?>
              <li>
                <a href="dashboard_CM.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Création Actualités
                </a>
              </li>
              <li>
                <a href="DashboardModifNews.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                  Modification Actualités
                </a>
              </li>
            <?php } ?>


            </li>
          </ul>
        </div>
        <!-- Accès à tous -->

        <?php if (isset($_SESSION['role']) && isset($_SESSION['role']['role']) && (intval($_SESSION['role']['role'])) == 1 || (intval($_SESSION['role']['role'])) == 2 || (intval($_SESSION['role']['role'])) == 5 || (intval($_SESSION['role']['role'])) == 6) { ?>
          <li>

            <a href="favoris.php" class="block py-2 pl-3 pr-4 text-slate-50 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-500 md:p-0 dark:text-slate-50 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              Mes favoris
            </a>
          </li>
        <?php } ?>

        <div class="flex items-center">
          <?php if (!isset($_SESSION['user'])) { ?>
            <a href="login.php">
              <button class="text-slate-50 mx-2 border-2 border-lime-500 rounded-lg py-2 px-2 bg-gray-800">Se connecter</button>
            </a>
            <a href="inscription.php">
              <button class="text-slate-50 mx-2 border-2 border-lime-500 rounded-lg py-2 px-2 bg-gray-800">Créer un compte</button>
            </a>
          <?php } else { ?>
            <div>
              <p class="text-slate-50 mx-2 rounded-lg py-2 px-1 bg-gray-800">Bonjour <?php echo $_SESSION['pseudo']['pseudo']; ?></p>
            </div>
            <a href="lib/logout.php">
              <button class="text-slate-50 mx-2 border-2 border-lime-500 rounded-lg py-2 px-2 bg-gray-800">Se déconnecter</button>
            </a>
          <?php } ?>
        </div>
      </ul>


    </div>



  </div>
  <!-- ####################################### CONNEXION MENU ####################################### -->

          
  
</nav>



<body>
  <div class="bg-black/[.8] md:pb-48">
  <!-- pb-48 -->