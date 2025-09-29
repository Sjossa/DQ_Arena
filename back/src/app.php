<?php

use Dotenv\Dotenv;
use Dq\Dq\config\Database;
use Bramus\Router\Router;

// Charger Dotenv
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$database = new Database();
try {
    $conn = $database->getConnection();
    echo "Connexion à la base OK !";
} catch (Exception $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}

$router = new Router();

$router->before('GET', '/.*', function () {
    header('X-Powered-By: bramus/router');
});

require_once __DIR__ . '/routes/movies.php';

$router->run();
