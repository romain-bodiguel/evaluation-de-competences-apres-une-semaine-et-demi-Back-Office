<?php

namespace App\Controllers;

use App\Models\Students;
use App\Models\Teachers;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        // je crée deux modèles teachers et students pour récupérer leurs données sur la homepage
        $teachersObject = new Teachers;
        $teachersData = $teachersObject->findAll();
        $params['teachersData'] = $teachersData;

        $studentsObject = new Students;
        $studentsData = $studentsObject->findAll();
        $params['studentsData'] = $studentsData;

        $this->show('main/home', $params);
    }
}
