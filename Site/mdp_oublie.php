<?php
include 'templates/header.php';
include 'lib/pdo.php';

if(isset($_POST['email'])) {
    $token = uniqid();
    $url = "http://localhost" . _TOKEN_URL. 'indexToken?token='.$token.'';
    
    
    $message = "Bonjour, voici un lien pour réinitialiser votre mot de passe : $url";
    $headers ='Content-Type: text/html; charset="UTF-8"'."\n";
    $headers .='From: l.warflof@gmail.com\r\n';

    if(mail($_POST['email'], 'Nouveau mot de passe', $message, $headers)) {
        $stmt = $pdo->prepare('UPDATE utilisateur SET token = ? WHERE email = ?');
        $stmt->execute([$token, $_POST['email']]);
        echo "<script>alert('Un mail vous a été envoyé')</script>";
    } else {
        echo 'Une erreur est survenue';
    }
}


?>

<div class="w-full md:mx-auto md:px-32 bg-gray rounded-lg shadow">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Mot de passe oublié
        </h1>

        <div>
            <p class="text-slate-50">Nous allons vous envoyer un mail afin de réinitiliser votre mot de passe.</p>
        </div>

        <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-slate-50 dark:text-white">Votre email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-lime-700 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email@mail.com" required="">
            </div>
            
            <div class="text-center">
                <button type="submit" name="loginUser" class="text-white bg-gray-600 font-medium rounded-lg border-2 border-lime-700 text-sm px-5 py-2.5 text-center">Envoyer un mail de réinitialisation</button>
            </div>

            <p class="text-sm font-light text-gray-400 dark:text-gray-400">
                Vous n'avez pas encore de compte ?<a href="#" class="font-medium text-primary-500 hover:underline dark:text-primary-500"> Créez votre compte</a>
            </p>
        </form>
    </div>
</div>

<?php
include 'templates/footer.php';
?>