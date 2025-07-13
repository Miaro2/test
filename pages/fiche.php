<?php
require('../inc/connection.php');
require('../inc/functions.php');
$fiche = getFiche($_GET['emp_no']);
$historiqueSalaire = getSalaire($_GET['emp_no']);
$historiqueTitre = getTitles($_GET['emp_no']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche employé</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4">Fiche de l'employé</h1>

    <?php if (!$fiche): ?>
        <div class="alert alert-danger text-center">
            Aucune fiche trouvée pour cet employé.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Date d'embauche</th>
                    <th>Genre</th>
                    <th>Département</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $fiche['first_name'] ?></td>
                    <td><?= $fiche['last_name'] ?></td>
                    <td><?= $fiche['birth_date'] ?></td>
                    <td><?= $fiche['hire_date'] ?></td>
                    <td><?= $fiche['gender'] ?></td>
                    <td><?= $fiche['dept_name'] ?></td>
                </tr>
            </tbody>
        </table>

        <h2 class="mt-5">Historique des salaires</h2>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Salaire</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historiqueSalaire as $salaire): ?>
                    <tr>
                        <td><?= $salaire['salary'] ?></td>
                        <td><?= $salaire['from_date'] ?></td>
                        <td><?= $salaire['to_date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="mt-5">Historique des titres</h2>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historiqueTitre as $titre): ?>
                    <tr>
                        <td><?= $titre['title'] ?></td>
                        <td><?= $titre['from_date'] ?></td>
                        <td><?= $titre['to_date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="javascript:history.back()" class="btn btn-secondary mt-4">← Retour</a>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
