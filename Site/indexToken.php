<?php
require 'lib/pdo.php';

if (isset($_GET['token']) && $_GET['token'] != '') {
    $stmt = $pdo->prepare('SELECT email FROM utilisateur WHERE token = ?');
    $stmt->execute([$_GET['token']]);
    $email = $stmt->fetchColumn();

    if ($email) {
        require 'templates/header.php';
?>
        <div class="container mx-auto py-8">
            <h1 class="text-slate-50 text-center text-4xl">
                Modification de votre mot de passe
            </h1>
            <form method="post" class="text-center pt-8">
                <div class="py-8">
                    <label for="newPassword" class="text-slate-50">Nouveau mot de passe: </label>
                    <input type="password" name="newPassword" class="rounded-md">
                </div>
                <div class="pt-4">
                    <input type="submit" value="Confirmer" class="border-2 rounded-md border-lime-700 text-slate-50 px-2 py-2">
                </div>
            </form>
        </div>


        <?php
        // }
        // }
        require 'templates/footer.php';
        if (isset($_POST['newPassword'])) {
            $hashedPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE utilisateur SET token = ?, password = ? WHERE email = ?');
            $stmt->execute([null, $hashedPassword, $email]);
        ?>
            <script>
                window.location.href = "login.php";
            </script>
<?php
        }
    }
}
