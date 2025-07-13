<?php
require('../inc/connection.php');
require('../inc/functions.php');


$departement = isset($_GET['choix']) ? $_GET['choix'] : '';
echo $departement;
$employee = isset($_GET['employee']) ? $_GET['employee'] : '';
$ageMin = isset($_GET['AgeMin']) && is_numeric($_GET['AgeMin']) ? (int)$_GET['AgeMin'] : 0;
$ageMax = isset($_GET['AgeMax']) && is_numeric($_GET['AgeMax']) ? (int)$_GET['AgeMax'] : 150;

$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

$recherche = getRecherche($departement, $employee, $ageMin, $ageMax, $limit, $offset);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Résultat de la recherche</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-4">

    <h1 class="mb-4">Résultat de la recherche</h1>

    <?php if (empty($recherche)): ?>
        <div class="alert alert-warning text-center">
            Aucun employé trouvé avec ces critères.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Genre</th>
                    <th>Date de naissance</th>
                    <th>Date d'embauche</th>
                    <th>Département</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recherche as $result): ?>
                    <tr>
                        <td><?= $result['first_name'] ?></td>
                        <td><?= $result['last_name'] ?></td>
                        <td><?= $result['gender'] ?></td>
                        <td><?= $result['birth_date'] ?></td>
                        <td><?= $result['hire_date'] ?></td>
                        <td><?= $result['dept_name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= http_build_query($_GET + ['page' => $page - 1]) ?>">Précédant</a>
                    </li>
                <?php endif; ?>

                <?php if (count($recherche) === $limit): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= http_build_query($_GET + ['page' => $page + 1]) ?>">Suivant</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    <?php endif; ?>

    <a href="javascript:history.back()" class="btn btn-secondary mt-4">← Retour</a>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
