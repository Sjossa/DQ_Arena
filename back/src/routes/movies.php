<?php

use Dq\Dq\Controllers\MonsterController;

// Supposons que $database est ton objet de connexion déjà initialisé

$router->mount('/monsters', function () use ($router, $database) {

    $router->get('/', function () use ($database) {
        // Instancie le controller
        $controller = new MonsterController($database);
        // Appelle la méthode pour récupérer tous les monstres et les afficher en JSON
        $controller->all_monster();
    });

});
