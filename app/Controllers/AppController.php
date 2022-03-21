<?php

namespace App\Controllers;
use App\Models\AppUser;
use App\Controllers\CoreController;

class AppController extends CoreController {
    
    public function login() {

        $this->show('user/connection');
    }

    public function connect() {
        //je récupère la saisie utilisateur dans le champ email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        //je crée un tableau vide qui va récupérer les éventuelles erreurs
        $errorsList = [];

        //si l'email ou mdp sont vides, je mets une erreur dans le $errorsList
        if(empty($email) || $email === false || empty($password) || $password === false) {
            $errorsList[] = "L'adresse email ou le mot de passe saisi est vide ou erroné";
            dump($errorsList);
            exit();
        }
        
        //si le $errorsList est vide, je crée un objet qui appelle la function findByEmail
        if(empty($errorsList)) {
            $connectModel = AppUser::findByEmail($email);
            //je vérifie juste que l'email est bien valide, sinon j'arrête le code
            if($connectModel === false) {
                echo "Email ou mot de passe incorrect";
                exit();
            }
        }
        
        //je récupère le mot de passe
        $passwordInDB = $connectModel->getPassword();
        
        //je vérifie si le mot de passe entré et celui haché dans la BDD correspondent
        if(password_verify($_POST['password'], $passwordInDB)) {

            // On enregistre dans la session l'id de l'user connecté
            $_SESSION['userId'] = $connectModel->getId();
            //... et même tout l'objet
            $_SESSION['userObject'] = $connectModel;

            header('Location: /');
            exit();
        } else {
            echo "Email ou mot de passe incorrect";
        }
    }

    public function logout() {

        $_SESSION = [];
        // On le redirige ensuite vers la page d'accueil
        header("Location: /");
        exit();
    }
}