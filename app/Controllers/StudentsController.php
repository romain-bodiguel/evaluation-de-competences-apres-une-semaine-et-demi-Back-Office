<?php

namespace App\Controllers;
use App\Models\Students;
use App\Models\Teachers;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class StudentsController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function list()
    {
        // je crée un modèle students pour récupérer leurs données sur la page
        $studentsObject = new Students;
        $studentsData = $studentsObject->findAll();
        $params['studentsData'] = $studentsData;

        $this->show('students/list', $params);
    }

    public function add()
    {
        $teachersObject = new Teachers;
        $teachersData = $teachersObject->findAll();
        $params['teachersData'] = $teachersData;
        
        $this->show('students/add', $params);
    }

    public function create()
    {
        // je récupère les données rentrées dans les champs et je les transforme en texte
        $firstname   = filter_input(INPUT_POST, 'firstname',   FILTER_SANITIZE_STRING);
        $lastname    = filter_input(INPUT_POST, 'lastname',    FILTER_SANITIZE_STRING);
        $status      = filter_input(INPUT_POST, 'status',      FILTER_VALIDATE_INT);
        $teacherId   = filter_input(INPUT_POST, 'teacherId',   FILTER_VALIDATE_INT);

        // je crée une tableau d'erreur à afficher en cas de champ vide ou false
        $errorList = [];

        if(empty($firstname) || $firstname === false) {
            $errorList[] = "Le prénom est vide ou erroné";
        }
        if(empty($lastname) || $lastname === false) {
            $errorList[] = "Le nom est vide ou erroné";
        }
        if(empty($status) || $status === false) {
            $errorList[] = "Le nom est vide ou erroné";
        }
        if(empty($teacherId) || $teacherId === false) {
            $errorList[] = "Le nom est vide ou erroné";
        }

        // si mon tableau d'erreur est vide, je procède à l'ajout en BBD
        if(empty($errorList)) {
            // je crée un nouvel objet Teachers
            $student = new Students;
            
            // je set les 3 propriétés
            $student->setFirstname($firstname);
            $student->setLastname($lastname);
            $student->setStatus($status);
            $student->setteacherId($teacherId);

            // une fois les propriétés modifiées, je les envoie en BDD
            $isInsertOK = $student->insert();

            // si l'insert a fonctionné :
            if ($isInsertOK) {
                // Redirection vers la liste des catégories
                header("Location: /liste-etudiants");

                // on stoppe l'execution du script pour éviter que du code essaie de se lancer pendant la redirection
                exit();
            }
        } else {
            $errorsList[] = "Une erreur est survenue lors de l'ajout du professeur";
        }

        dump($errorList);
    }
}
