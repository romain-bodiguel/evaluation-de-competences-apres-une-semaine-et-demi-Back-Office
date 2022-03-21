<?php

namespace App\Models;

use PDO;
use App\Utils\Database;
use App\Models\CoreModel;

class Students extends CoreModel {

    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $teacherId;

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

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

    /**
     * Get the value of teacherId
     *
     * @return  int
     */ 
    public function getTeacherId()
    {
        return $this->teacherId;
    }

    /**
     * Set the value of teacherId
     *
     * @param  int  $teacherId
     *
     * @return  self
     */ 
    public function setTeacherId(int $teacherId)
    {
        $this->teacherId = $teacherId;

        return $this;
    }

    public static function find($id) 
    {

    }

    public static function findAll() 
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, __CLASS__);

        return $results;
    }

    public function insert() 
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `student` (`firstname`, `lastname`, `status`, `teacher_id`)
                VALUES (:firstname, :lastname, :status, :teacherId)";

        // je prépare ma requête SQL
        $statement = $pdo->prepare($sql);

        // j'associe mes étiquettes à mes valeurs
        $statement->bindValue(':firstname',   $this->firstname, PDO::PARAM_STR);
        $statement->bindValue(':lastname',    $this->lastname,  PDO::PARAM_STR);
        $statement->bindValue(':status',      $this->status,    PDO::PARAM_STR);
        $statement->bindValue(':teacherId',   $this->teacherId, PDO::PARAM_STR);

        // je peux maintenant exécuter cette requête
        $insertIsOK = $statement->execute();

        // si au moins une ligne a été ajoutée
        if($insertIsOK) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return $insertIsOK;
    }

    public function update() 
    {

    }

    public function delete() 
    {

    }
}