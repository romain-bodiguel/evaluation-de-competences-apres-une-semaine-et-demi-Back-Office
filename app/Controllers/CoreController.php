<?php

namespace App\Controllers;

abstract class CoreController
{
    // Le constructeur de CoreController sera utilisé par tout ses enfants
    // Grace à setControllersArguments() dans index.php, on peut recevoir le router et le match en paramètres !
    public function __construct($router, $match) 
    {
        //==================================================
        // Access Control List
        //==================================================

        // 1. je récupère le nom de la route courante
        $currentRouteName = $match['name'];

        // 2. je définis des permissions pour les routes nécessitant d'être connecté (certaines routes n'ont pas encore été crées)
        $acl = [
            "main-home"       => ["admin", "catalog-manager"],

            "teacher-add"        => ["admin"],
            "teacher-create"     => ["admin"],
            "teachers-list"      => ["admin", "user"],
            "teacher-edit"       => ["admin"],
            "teacher-update"     => ["admin"],
            "teacher-delete"     => ["admin"],

            "student-add"        => ["admin", "user"],
            "student-create"     => ["admin", "user"],
            "students-list"      => ["admin", "user"],
            "student-edit"       => ["admin", "user"],
            "student-update"     => ["admin", "user"],
            "student-delete"     => ["admin", "user"],
        ];

        // 3. je vérifie si la route actuelle est dans la liste ci-dessus
        if(array_key_exists($currentRouteName, $acl))
        {
            // 4. Si c'est le cas, je vérifie que l'user est connecté et que son rôle correspond
            //  Je récupère les rôles autorisés à accéder à la route actuelle
            $authorizedRolesForCurrentRoute = $acl[$currentRouteName];

            // Je vérifie que l'user à les droits avec checkAuthorization
            $this->checkAuthorization($authorizedRolesForCurrentRoute);
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        // On globalise $router pour le moment
        global $router;
        
        extract($viewData);
        
        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

    protected function checkAuthorization($authorizedRoles = []) 
    {
        // Vérifier si l'user est connecté
        if(isset($_SESSION['userObject'])) :
            // S'il est connecté, on récupère l'user, et donc son rôle
            $currentUserRole = $_SESSION['userObject']->getRole();

            // Vérifier si le rôle est autorisé à accéder à la page
            // c'est à dire, vérifier si le rôle est dans le tableau $authorizedRoles
            // Si oui, alors j'ai le droit d'accéder à la page, on return true
            if(in_array($currentUserRole, $authorizedRoles)) :
                // On retourne true et la page va s'afficher normalement vu qu'on a le droit
                return true;

            // Sinon
            else :
                // on envoi le header 403 Forbidden
                http_response_code(403);
                // on affiche l'erreur
                $this->show('error/err403');
                // on arrête le script, sinon la page demandée va s'afficher et potentiellement executer du code auquel l'user n'est pas autorisé à accéder
                exit();
  
          endif;
        // Sinon, on l'envoi vers la page de connexion
        else :

            header("Location: /connexion");
            exit();

        endif;
    }
}
