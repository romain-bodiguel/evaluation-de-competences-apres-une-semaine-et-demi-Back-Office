<?php

require_once '../vendor/autoload.php';

// On démarre le système de gestion des sessions de PHP
session_start();

/* ------------
--- ROUTAGE ---
-------------*/

// création de l'objet router
$router = new AltoRouter();

// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
} else { // sinon
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '/';
}

/* ------------
--- ROUTES ----
-------------*/

//MAIN
$router->map('GET' ,'/', '\App\Controllers\MainController::home', 'main-home');

//CONNEXION
$router->map('GET',  '/connexion',   '\App\Controllers\AppController::login',   'connection');
$router->map('POST', '/connexion',   '\App\Controllers\AppController::connect', 'connection-submit');
$router->map('GET',  '/deconnexion', '\App\Controllers\AppController::logout',  'deconnection');

//TEACHERS
$router->map('GET'  ,'/liste-professeurs',   '\App\Controllers\TeachersController::list',    'teachers-list');
$router->map('GET'  ,'/ajout-professeur',    '\App\Controllers\TeachersController::add',     'teacher-add');
$router->map('POST' ,'/ajout-professeur',    '\App\Controllers\TeachersController::create',  'teacher-create');

//STUDENTS
$router->map('GET'  ,'/liste-etudiants',    '\App\Controllers\StudentsController::list',    'students-list');
$router->map('GET'  ,'/ajout-etudiant',    '\App\Controllers\StudentsController::add',     'student-add');
$router->map('POST' ,'/ajout-etudiant',    '\App\Controllers\StudentsController::create',  'student-create');

/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();

$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

// Grace à cette méthode, on peut transmettre des valeurs au constructeur du controlleur
// Ici, c'est le constructeur de CoreController qui s'en charge
$dispatcher->setControllersArguments($router, $match);

// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();