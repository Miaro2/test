<?php
require('../inc/connection.php');
require('../inc/functions.php');
$employees = getEmployees($_GET['dept_no']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Liste des employés</h1>

    <?php if (empty($employees)): ?>
        <div class="alert alert-warning text-center">
            Aucun employé trouvé pour ce département.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td>
                            <a href="fiche.php?emp_no=<?php echo $employee['emp_no']; ?>">
                                <?php echo $employee['first_name']; ?>
                            </a>
                        </td>
                        <td><?php echo $employee['last_name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>