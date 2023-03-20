<?php
require('templates/header.php');
require_once('lib/jeuxData.php');

$news = getNews($pdo);




?>

<div class="container mx-auto px-auto pt-8 pb-16">

    <table class="table-auto mx-auto py-8">
        <thead>
            <h1 class="text-4xl text-slate-50 text-center py-6">Modification des jeux</h1>

            <div class="container mx-auto px-auto py-4">
                <tr class="border-2 border-slate-50">

                    <th class="text-slate-50 border-2 border-slate-50">Titre</th>
                    <th class="text-slate-50 border-2 border-slate-50">Date de publication</th>
                    <th class="text-slate-50">Modification</th>
                    

                </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $key => $new) { ?>
                <tr class="text-slate-50 border-2 border-slate-50">
                    <td class="px-4">
                        <?= $new['Titre']; ?>
                    </td>
                    <td class="text-center px-4 border-2 border-slate-50">
                        <?= $new['date_creation']; ?>
                    </td>
                   
                    <td class="mx-8 px-auto py-4 border-2 border-slate-50">
                        <a href="Modification_article.php?id=<?= $new['id_actu'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-6 border-2 border-slate-50 text-slate-50" type="button">
                            Modifier l'article
                        </a>
                    
                        <a href="lib/supprimer_article.php?id=<?= $new['id_actu'] ?>" class="bg-lime-500 rounded-md font-bold px-4 py-2 mx-6 border-2 border-slate-50 text-slate-50" type="button">
                            Supprimer l'article
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