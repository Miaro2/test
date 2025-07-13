<?php
require('../inc/connection.php');
require('../inc/functions.php');
$departements = getDepartement();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Départements</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4">Recherche</h1>

    <form action="recherche.php" method="get" class="mb-5">
        <div class="mb-3">
            <label for="choix" class="form-label">Choisissez votre département :</label>
            <select id="choix" name="choix" class="form-select">
                <option value=>Tous</option>
                <?php foreach ($departements as $departement): ?>
                    <option value="<?php echo $departement['dept_no']; ?>">
                        <?php echo $departement['dept_name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="employee" class="form-label">Nom de l'employé :</label>
            <input type="text" name="employee" id="employee" class="form-control">
        </div>

        <div class="mb-3">
            <label for="AgeMin" class="form-label">Âge minimum :</label>
            <input type="number" name="AgeMin" id="AgeMin" class="form-control">
        </div>

        <div class="mb-3">
            <label for="AgeMax" class="form-label">Âge maximum :</label>
            <input type="number" name="AgeMax" id="AgeMax" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <h1 class="mb-3">Liste des départements</h1>

    <table class="table table-bordered table-hover table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Manager</th>
                <th>Nombre d'employés</th>
            </tr>
        </thead>
        <tbody>
                    <?php foreach ($departements as $departement): ?>
                <tr>
                    <td>
                        <a href="employees.php?dept_no=<?php echo $departement['dept_no']; ?>">
                            <?php echo $departement['dept_name']; ?>
                        </a>
                    </td>
                    <td>
                        <?php 
                        $managers = getManager($departement['dept_name']); 
                        foreach ($managers as $manager): 
                            echo $manager['first_name'] . ' ' . $manager['last_name'] . '<br>';
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo getnbemployes($departement['dept_no'], $nomEmploye = '');
                        $employees = getEmployees($departement['dept_no']);
                        echo count($employees);
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <div class="text-center mt-5">
        <a href="emploi.php" class="btn btn-lg btn-success px-5 py-3">
            Statistiques par emploi
        </a>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
