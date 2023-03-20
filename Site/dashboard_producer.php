<?php
require('templates/header.php');
require_once('lib/jeuxData.php');

$jeux = getGames($pdo);
$totalCost[] = getGamesTotalCost($pdo);


?>

<div class="container mx-auto px-auto pt-8 pb-16 overflow-x-auto">

    <table class="table-auto mx-auto py-8">
        <thead>
            <h1 class="text-4xl text-slate-50 text-center py-6">Modification des jeux</h1>

            <div class="container mx-auto px-auto py-4">
                <tr class="border-2 border-slate-50">

                    <th class="text-slate-50 border-2 border-slate-50">Titre</th>
                    <th class="text-slate-50 text-center">Budget</th>
                    <th class="text-slate-50 text-center">Statut</th>
                    <th class="text-slate-50 text-center">Date de fin estimée</th>
                    <th class="text-slate-50 text-center">Modification</th>

                </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $key => $jeu) { ?>
                <tr class="text-slate-50 border-2 border-slate-50">
                    <td class="px-4">
                        <?= $jeu['Titre']; ?>
                    </td>
                    <td class="text-center px-4 border-2 border-slate-50">
                        <?= $jeu['budget']; ?>
                    </td>
                    <td class="text-center px-4 border-2 border-slate-50">
                        <?php
                        $statuts = getGameStatut($pdo);

                        foreach ($statuts as $key => $statut) {
                            if ($jeu['jouable'] == $statut['id_jouable']) {
                                echo $statut['Statut'];
                            }
                        } ?>
                    </td>
                    <td class="text-center px-4 border-2 border-slate-50">
                        <?= $jeu['date_estimee_fin']; ?>
                    </td>
                    <td class="mx-8 px-auto py-4 border-2 border-slate-50">
                        <a href="Modification_budget.php?id=<?= $jeu['ID'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-6 border-2 border-slate-50 text-slate-50" type="button">
                            Modifier le jeu
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="border-2 border-slate-50">
                <td colspan="5" class="text-2xl text-slate-50">
                    <p class="text-right mx-2 py-2">Cout total des jeux en cours de développement: <?= $totalCost[0]['total'] ?> € </p>
                </td>
            </tr>
        </tfoot>







    </table>

</div>

<?php
require('templates/footer.php');
?>