<?php

$pdo = getPdo();

// kill la session
session_destroy();

// reset la bdd
//returnToBaseBDD($pdo);

header('Location: index.php');