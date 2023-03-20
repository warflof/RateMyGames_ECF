<?php
require_once('lib/session.php');
if (isset($_SESSION['user'])) {
    header('location: index.php');
}

require_once('templates/header.php');
require_once('lib/user.php');

$messages = [];
$errors = [];

?>
<?php
if (isset($_POST['loginUser'])) {

    $users = verifyUser($pdo, $_POST['email'], $_POST['password']);

    if ($users) {
        $_SESSION['user'] = ['email' => $users['email']];
        $_SESSION['role'] = ['role' => $users['role_id']];
        $_SESSION['id'] = ['id' => $users['user_id']];
        $_SESSION['pseudo'] = ['pseudo' => $users['pseudo']];
        $messages[] = 'Vous êtes connecté';
        ?>
        <script>
            window.location.href = "index.php";
        </script>
        <?php
    } else {
        $errors[] = 'Email ou mot de passe incorrect';
    }

    
}


?>
<div class="w-full md:mx-auto md:px-32 bg-gray rounded-lg shadow">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Connexion à votre compte
        </h1>

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


        <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email@mail.com" required="">
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
            </div>
            <div class="flex items-center justify-between">
                <a href="mdp_oublie.php" class="text-sm font-medium text-slate-50 hover:underline">Vous avez oublié votre mot de passe ?</a>
            </div>

            <div class="text-center">
                <button type="submit" name="loginUser" class="w-32 text-white bg-gray-600 font-medium rounded-lg border-2 text-sm px-5 py-2.5 text-center">Connexion</button>
            </div>

            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Vous n'avez pas encore de compte ?<a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500"> Créez votre compte</a>
            </p>
        </form>
    </div>
</div>

<?php
require_once('templates/footer.php');
?>