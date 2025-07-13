<?php
function getDatabase() {
    $database = mysqli_connect("localhost", "root", "", "employees");
    return $database;
}
?>