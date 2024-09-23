<?php

function getPdo() {
    $ligne1 = $_SESSION['pdo']["ligne1"];
    $ligne2 = $_SESSION['pdo']["ligne2"];
    $ligne3 = $_SESSION['pdo']["ligne3"];
    $pdo = new PDO($ligne1);
    $pdo->setAttribute($ligne2, $ligne3);
    return $pdo;
}