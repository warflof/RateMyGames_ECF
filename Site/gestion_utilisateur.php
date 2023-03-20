<?php
require('templates/header.php');
require_once('lib/jeuxData.php');

$utilisateurs = getUsers($pdo);
$roles = addUsersRoles($pdo, $utilisateurs);

// var_dump(intval($roles[2][0]['role_id']));

if (isset($_POST['modifyRole'])) {

    foreach ($utilisateurs as $key => $utilisateur) {
        $role = intval($_POST['role'][$key]);
        $mail = $utilisateur['email'];
        $query = $pdo->prepare("UPDATE utilisateur SET role_id = :role WHERE email = :email");
        $query->bindParam(':role', $role, PDO::PARAM_INT);
        $query->bindParam(':email', $mail, PDO::PARAM_STR);
        $query->execute();
    }
    // rediriger ou afficher un message de confirmation

}

?>

<form method="POST" enctype="multipart/form-data">
    <h1 class="text-4xl text-slate-50 text-center py-6">Modification des utilisateurs</h1>

    <div class="flex flex-col">
        <?php
        foreach ($roles as $key => $role) { ?>
            <div class="container mx-auto md:px-96">
                <div class="border-2 border-slate-50 flex flex-row">
                    <div class="basis-1/2 py-6 md:py-2">
                    <span class="text-slate-50 mx-2 basis-1/2">
                        <?= $role[0]['email'] ?>
                    </span>
                    </div>
                    <div class="basis-1/2 flex justify-end mx-2">
                    <select name="role[<?= $key ?>]" class="my-2 rounded">
                        <?php

                        echo '<option value="' . intval($role[0]['role_id']) . '">' . $role[0]['nom_role'] . '</option>';

                        ?>

                        <?php
                        $rolesInBase = getRole($pdo);
                        foreach ($rolesInBase as $roleInBase) {
                            echo '<option value="' . intval($roleInBase['id_role']) . '">' . $roleInBase['nom_role'] . '</option>';
                        }
                        ?>
                    </select>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>



    <div class="md:mx-auto text-center py-8">
        <input type="submit" value="Enregistrer" class="bg-slate-50 py-3 px-8 my-2 rounded" name="modifyRole">
    </div>
</form>


<?php
require('templates/footer.php');
?>