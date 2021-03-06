<?php

namespace App\Models;

use PDO;
use App\Utils\Database;
use App\Models\CoreModel;

class AppUser extends CoreModel {

    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $password;
    /**
     * @var int
     */
    private $role;
    /**
     * @var int
     */
    private $status;

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return  int
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param  int  $role
     *
     * @return  self
     */ 
    public function setRole(int $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    public static function find($id) 
    {

    }

    public static function findAll() 
    {

    }

    public static function findByEmail($email) 
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `app_user`
                WHERE `email` LIKE :email";

        // On utilise une requ??te pr??par??e car $email provient d'une saisie de l'utilisateur, donc on se m??fie des injections SQL !
        $statement = $pdo->prepare($sql);
        // On dit ?? PDO comment "remplacer" et s??curiser les "??tiquettes" de ma requete pr??par??e
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        // J'execute ma requ??te pr??par??e. Attention, ??a ne retourne pas un jeu de r??sultats !
        $statement->execute();

        if ($statement) {
            $userEmail = $statement->fetchObject(__CLASS__);
            return $userEmail;
        } else {
            return false;
        }
    }

    public function insert() 
    {

    }

    public function update() 
    {

    }

    public function delete() 
    {

    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }
}