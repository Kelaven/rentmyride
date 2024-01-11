<?php

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/Database.php';

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
    /**
     * méthode pour insérer les données
     * @return [type]
     */
    public function insert() // méthode pour insérer les données
    {
        // $pdo = new PDO(DSN, USER, PASSWORD); // Voici une façon d'optimiser le code pour ne modifier les infos qu'à un endroit si besoin (voire éviter la répétition de code) : 
        $pdo = Database::connect(); // on appelle une méthode static avec ::

        $sql = 'INSERT INTO
            `categories`(`name`)
            VALUES
            (:name);'; // on utilise les marqueurs dans la classe PDO et non pas les variables (sécurité)

        $sth = $pdo->prepare($sql); // méthode de la classe PDO

        $sth->bindValue(':name', $this->getName()); // méthode de la classe PDOStatement, qui est retournée par prepare()

        $result = $sth->execute(); // méthode de la classe PDOStatement

        return $result;
    }

    /**
     * méthode pour lire les données, retourne un tableau
     * @return [type]
     */
    public static function getAll() // méthode pour lire les données
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `categories`;';

        // $sth = $pdo->prepare($sql);
        // $sth->execute();
        $sth = $pdo->query($sql); // la méthode query prépare et exécute en même temps à condition qu'il n'y ait pas de marqueurs

        $result = $sth->fetchAll(PDO::FETCH_OBJ); // récupération des résultats sous forme d'objets grâce à FETCH_OBJ (par défaut c'est du tableau indexé associatif)

        return $result;
    }


    /**
     * méthode pour récupérer les informations de la catégorie séléctionnée pour la modifier (update)
     * @param int $id
     * 
     * @return object
     */
    public static function get(int $id): object|false // méthode pour update, afin de récupérer les infos de l'id sélectionné
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `categories`
        WHERE id_category = :id_category;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':id_category', $id, PDO::PARAM_INT); // car l'utilisateur rentre de nouveau une donnée, je la récupère sous form d'entier

        $result = $sth->execute();

        $result = $sth->fetch(PDO::FETCH_OBJ); // pour récupérer les données de l'objet portant l'id. Le fetch recupère la première info uniquement (contrairement au fetchAll qui récupère tout)

        return $result;
    }

    /**
     * méthode pour retourner les données
     * @return [type]
     */
    // public static function update(int $id) // méthode pour modifier les données
    public function update() // méthode pour modifier les données
    {
        $pdo = Database::connect();

        $sql = 'UPDATE `categories`
        SET `name` = :name
        WHERE `id_category` = :id_category;';

        $sth = $pdo->prepare($sql);


        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':id_category', $this->getIdCategory(), PDO::PARAM_INT);

        $result = $sth->execute();

        return $result;
    }

    /**
     * méthode pour supprimer une catégorie
     * @param int $id
     * 
     * @return [type]
     */
    public static function delete(int $id) // méthode pour supprimer une catégorie
    {
        $pdo = Database::connect();

        $sql = 'DELETE FROM `categories`
        WHERE `id_category` = :id_category;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':id_category', $id, PDO::PARAM_INT); // Attention il est important de préciser PARAM_INT ici pour éviter que la requête sql ne soit affectée et traite la valeur comme s'il s'agissait d'une string (l'option par défaut étant PARAM_STR)

        $result = $sth->execute();

        return $result;
    }

    public static function isExist($name)
    {
        $pdo = Database::connect();

        $sql = 'SELECT `name` 
        FROM `categories`
        WHERE `name` = :name;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':name', $name, PDO::PARAM_STR);

        $result = $sth->execute(); // retourne true ou false, à compléter avec fetch

        $result = $sth->fetch(PDO::FETCH_OBJ);

        return $result;
    }
}
