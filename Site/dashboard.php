<?php
require('templates/header.php');
require_once('lib/jeuxData.php');

$jeux = getGames($pdo)

?>
<!-- <h1 class="text-4xl text-slate-50 text-center py-6">Modification des jeux</h1>

<div class="container mx-auto px-auto py-8"> -->

    <table class="table-auto mx-auto">
        <thead>
            <h1 class="text-4xl text-slate-50 text-center py-6">Modification des jeux</h1>

            <div class="container mx-auto px-auto py-4">
                <tr class="border-2 border-slate-50">

                    <th class="text-slate-50 border-2 border-slate-50 py-2 px-2">Titre</th>
                    <th class="text-slate-50 border-2 border-slate-50 text-center py-2 px-2">Date de Création</th>
                    <th class="text-slate-50 border-2 border-slate-50 text-center py-2 px-2">Score</th>
                    <th class="text-slate-50 border-2 border-slate-50 text-center py-2 px-2">Modification</th>

                </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $key => $jeu) { ?>

                <tr class="text-slate-50 border-2 border-slate-500">
                    <td class="border-2 border-slate-50 px-2">
                        <?= $jeu['Titre']; ?>
                    </td>
                    <td class="border-2 border-slate-50 text-center">
                        <?= $jeu['date_creation']; ?>
                    </td>
                    <td class="border-2 border-slate-50 text-center">
                        <?= $jeu['score']; ?>
                    </td>
                    <td class="mx-8 px-auto py-4 border-2 border-slate-50">

                    
                        <a href="Modification_jeu.php?id=<?= $jeu['ID'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-6 border-2 border-slate-50 text-slate-50" type="button">
                            Modifier
                        </a>

                        <a href="lib/suppression_jeu.php?id=<?= $jeu['ID'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-6 border-2 border-slate-50 text-slate-50">
                            Supprimer
                        </a>
                    </td>
                </tr>

            <?php
            }
            ?>
        </tbody>


        




    </table>

</div>

<?php
require('templates/footer.php');
?>