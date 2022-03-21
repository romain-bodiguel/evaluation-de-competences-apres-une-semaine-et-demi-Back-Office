<?php

namespace App\Controllers;
use App\Models\Teachers;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class TeachersController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        // je crée un modèle teachers pour récupérer leurs données sur la homepage
        $teachersObject = new Teachers;
        $teachersData = $teachersObject->findAll();
        $params['teachersData'] = $teachersData;

        $this->show('teachers/list', $params);
    }

    public function add()
    {
        $this->show('teachers/add');
    }

    public function create()
    {
        // je récupère les données rentrées dans les champs et je les transforme en texte
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname  = filter_input(INPUT_POST, 'lastname',  FILTER_SANITIZE_STRING);
        $job       = filter_input(INPUT_POST, 'job',       FILTER_SANITIZE_STRING);
        $status    = filter_input(INPUT_POST, 'status',    FILTER_VALIDATE_INT);

        // je crée une tableau d'erreur à afficher en cas de champ vide ou false
        $errorList = [];

        if(empty($firstname) || $firstname === false) {
            $errorList[] = "Le prénom est vide ou erroné";
        }
        if(empty($lastname) || $lastname === false) {
            $errorList[] = "Le nom est vide ou erroné";
        }
        if(empty($job) || $job === false) {
            $errorList[] = "Le job est vide ou erroné";
        }
        if(empty($status) || $status === false) {
            $errorList[] = "Le statut est vide ou erroné";
        }

        // si mon tableau d'erreur est vide, je procède à l'ajout en BBD
        if(empty($errorList)) {
            // je crée un nouvel objet Teachers
            $teacher = new Teachers;
            
            // je set les 3 propriétés
            $teacher->setFirstname($firstname);
            $teacher->setLastname($lastname);
            $teacher->setJob($job);
            $teacher->setStatus($status);

            // une fois les propriétés modifiées, je les envoie en BDD
            $isInsertOK = $teacher->insert();

            // si l'insert a fonctionné :
            if ($isInsertOK) {
                // Redirection vers la liste des catégories
                header("Location: /liste-professeurs");

                // on stoppe l'execution du script pour éviter que du code essaie de se lancer pendant la redirection
                exit();
            }
        } else {
            $errorsList[] = "Une erreur est survenue lors de l'ajout du professeur";
        }

        dump($errorList);
    }
}