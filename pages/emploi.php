<?php
require('../inc/connection.php');
require('../inc/functions.php');

$statistiques = getStatistiquesParEmploi();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques par emploi</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4">Statistiques des emplbwjhbhgflkjwhkfjygois</h1>

    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Emploi</th>
                <th>Nombre d'hommes</th>
                <th>Nombre de femmes</th>
                <th>Salaire moyen (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statistiques as $ligne): ?>
                <tr>
                    <td><?= htmlspecialchars($ligne['title']) ?></td>
                    <td><?= $ligne['nb_hommes'] ?></td>
                    <td><?= $ligne['nb_femmes'] ?></td>
                    <td><?= $ligne['salaire_moyen'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>klc,dlck,s,s</p>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
