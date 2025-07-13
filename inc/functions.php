<?php
function getDepartement() {
    $requete = 'SELECT * FROM departments';
    $resultat = mysqli_query(getDatabase(), $requete);
    $departements = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $departements;
}

function getManager($department) {
    $requete = "SELECT first_name, last_name FROM v_departement_manager
    WHERE dept_name = '%s' AND dept_from_date <  NOW() AND (dept_to_date IS NULL OR dept_to_date > NOW())";

    $requete = sprintf($requete, $department);

    $resultat = mysqli_query(getDatabase(), $requete);
    $managers = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $managers;
}

function getEmployees($department_id) {
    $requete = 'SELECT emp_no, first_name, last_name FROM v_departement_employe
    WHERE dept_no = "%s"
    ORDER BY first_name ASC';

    $requete = sprintf($requete, $department_id);

    $resultat = mysqli_query(getDatabase(), $requete);
    $employees = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $employees;
}

function getFiche($emp_no) {
    $requete = 'SELECT emp_no, first_name, last_name, birth_date, hire_date, gender, dept_name
    FROM v_departement_employe 
    WHERE emp_no = "%s"';

    $requete = sprintf($requete, $emp_no);

    $resultat = mysqli_query(getDatabase(), $requete);
    $fiche = mysqli_fetch_assoc($resultat);
    return $fiche;
}

function getSalaire($emp_no) {
    $requete = 'SELECT salaries.salary, salaries.from_date, salaries.to_date, employees.first_name, employees.last_name FROM salaries
    JOIN employees ON salaries.emp_no = employees.emp_no
    WHERE employees.emp_no = "%s"
    AND salaries.to_date < (SELECT MAX(s.to_date) FROM salaries s WHERE s.emp_no = employees.emp_no)';

    // $requete = 'SELECT salary, from_date, to_date, first_name, last_name FROM v_emp_salaire
    // WHERE emp_no = "%s"
    // AND to_date < (SELECT MAX(s.to_date)';

    $requete = sprintf($requete, $emp_no);
    $resultat = mysqli_query(getDatabase(), $requete);
    $salaire = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $salaire;
}

function getTitles($emp_no) {
    $requete = 'SELECT titles.title, titles.from_date, titles.to_date FROM titles
    JOIN employees ON titles.emp_no = employees.emp_no
    WHERE employees.emp_no = "%s"';

    $requete = sprintf($requete, $emp_no);
    $resultat = mysqli_query(getDatabase(), $requete);
    $titles = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $titles;
}

function getRecherche($departements, $employee, $ageMin, $ageMax, $limit, $offset) {
    if ($ageMax == NULL) {
        $ageMax = 150;
    }

    $requete = 'SELECT employees.emp_no, employees.first_name, employees.last_name, employees.gender, employees.hire_date, employees.birth_date, departments.dept_name
    FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON dept_emp.dept_no = departments.dept_no
    WHERE departments.dept_name LIKE "%%%s%%"
    AND employees.first_name LIKE "%%%s%%"
    AND (YEAR(CURDATE()) - YEAR(employees.birth_date)) BETWEEN %d AND %d
    ORDER BY employees.first_name ASC
    LIMIT %d OFFSET %d';

    $requete = sprintf($requete, $departements, $employee, $ageMin, $ageMax, $limit, $offset);

    $resultat = mysqli_query(getDatabase(), $requete);

    $recherche = [];
    while ($row = mysqli_fetch_assoc($resultat)) {
        $recherche[] = $row;
    }
    return $recherche;
}

function getnbemployes($departements, $employee) {

    $requete = 'SELECT COUNT(*) as total FROM employees
    JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
    JOIN departments ON dept_emp.dept_no = departments.dept_no
    WHERE departments.dept_no = "%s"
    AND employees.first_name LIKE "%%%s%%"';

    $requete = sprintf($requete, $departements, $employee);

    $resultat = mysqli_query(getDatabase(), $requete);
    $nbemployes = mysqli_fetch_assoc($resultat);
    return $nbemployes['total'];
}

function getStatistiquesParEmploi() {
    $conn = getDatabase();

    $requete = "SELECT 
            titles.title,
            SUM(CASE WHEN employees.gender = 'M' THEN 1 ELSE 0 END) AS nb_hommes,
            SUM(CASE WHEN employees.gender = 'F' THEN 1 ELSE 0 END) AS nb_femmes,
            ROUND(AVG(salaries.salary), 2) AS salaire_moyen
        FROM titles
        JOIN employees ON titles.emp_no = employees.emp_no
        JOIN salaries ON salaries.emp_no = employees.emp_no
        GROUP BY titles.title
        ORDER BY titles.title ASC
    ";

    $result = mysqli_query($conn, $requete);
    $statistiques = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $statistiques[] = $row;
    }

    return $statistiques;
}

?>