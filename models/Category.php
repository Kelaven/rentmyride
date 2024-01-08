<?php

require_once __DIR__ . '/../config/init.php';


// ! création de la classe
class Category
{

    // ! création des attributs
    private ?int $id_category; // le ? précise si la donnée est obligatoire ou pas
    private string $name;


    // ! création des méthodes magiques
    public function __construct(string $name = '', ?int $id_category = NULL)
    {
        $this->name = $name;
        $this->id_category = $id_category;
    }
    // public function __toString(): string{
    //     return $this->getAll();
    // }


    // ! création des getters
    /**
     * retourne la valeur de id_category
     * @return int
     */
    public function getIdCategory(): ?int
    {
        return $this->id_category;
    }
    /**
     * retourne la valeur de name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    // ! création des setters
    /**
     * modifies la valeur de id_category
     * @param int $id_category
     * 
     * @return [type]
     */
    public function setIdCategory(?int $id_category)
    {
        $this->id_category = $id_category;
    }
    /**
     * modifies la valeur de name
     * @param string $name
     * 
     * @return [type]
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    // ! création de mes méthodes
    public function insert()
    {
        $pdo = new PDO(DSN, USER, PASSWORD);

        $sql = 'INSERT INTO
            `categories`(`name`)
            VALUES
            (:name);'; // on utilise les marqueurs dans la classe PDO et non pas les variables (sécurité)

        $sth = $pdo->prepare($sql); // méthode de la classe PDO

        $sth->bindValue(':name', $this->getName()); // méthode de la classe PDOStatement, qui est retournée par prepare()

        $result = $sth->execute(); // méthode de la classe PDOStatement

        return $result;
    }

    public function getAll()
    {
        $pdo = new PDO(DSN, USER, PASSWORD);

        $sql = 'SELECT * FROM `categories`;';

        $sth = $pdo->prepare($sql);

        $sth->execute();

        $result = $sth->fetchAll(); // récupération des résultats (on récupère tout en une seule fois)

        return $result;
    }
}
