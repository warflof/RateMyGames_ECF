<?php
require_once('templates/header.php');
require_once('lib/user.php');


$messages = [];
$errors = [];


if (isset($_POST['addUser'])) {

    $res = addUser($pdo, $_POST['email'], $_POST['password'], $_POST['pseudo']);

    if ($res) {
        $messages[] = 'Votre compte a bien été créé';
        echo '<script>location.href = "index.php";</script>';

    } else {
        $errors[] = 'Une erreur est survenue';
    }
}

?>

<?php foreach ($messages as $message) { ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="succes">
        <span class="block sm:inline">
            <?= $message ?>
        </span>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">
            <?= $error ?>
        </span>
    </div>
<?php } ?>

<div class="mx-8 py-4 md:mx-32 md:px-32 space-y-4 md:space-y-6 sm:p-8">
    <div class="md:mx-auto md:px-32">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Créer un compte
        </h1>
        <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data">
            <div>
                <label for="pseudo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Votre Pseudo
                </label>
                <input type="texte" name="pseudo" id="pseudo" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Diablox12" required="">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Votre email
                </label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email@email.com" required="">
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Mot de passe
                </label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            </div>


            <!-- <div class="flex items-start">
                      <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                      </div>
                       <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                      </div> 
                  </div> -->

            <div class="w-48 text-center mx-auto py-8">
                <button type="submit" value="inscription" name="addUser" class="w-full text-center text-white bg-gray-600 border-2 border-lime-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Créer mon compte
                </button>
            </div>

            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Vous avez déjà un compte ? <a href="login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Connecter vous ici</a>
            </p>
        </form>
    </div>
</div>

<?php
require_once('templates/footer.php');
?>