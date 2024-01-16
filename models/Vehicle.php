<?php

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/Database.php';
require_once __DIR__ . '/../models/Category.php';


class Vehicle
{

    // ! attributs
    private ?int $id_vehicle;
    private string $brand;
    private string $model;
    private string $registration;
    private int $mileage;
    private ?string $picture;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $deleted_at;
    private ?int $id_category;
    // private object|false $category;


    // ! méthode magique
    public function __construct(
        // int $id_vehicle = NULL, // pas utile de l'écrire
        string $brand = '',
        string $model = '',
        string $registration = '',
        int $mileage = 0,
        ?string $picture = '',
        string $created_at = NULL, // c'est nullable et ça assure que ça ne rentre pas une chaine vide en utilisant '' dans la BDD, ainsi la BDD pourra bien définir la date automatiquement
        string $updated_at = NULL,
        ?string $deleted_at = NULL,
        ?int $id_category = NULL
    ) {
        // $this->id_vehicle = $id_vehicle;
        $this->brand = $brand; // ? il vaudrait mieux utiliser ici les setters
        $this->model = $model;
        $this->registration = $registration;
        $this->mileage = $mileage;
        $this->picture = $picture;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
        $this->id_category = $id_category;
        // $this->category = Category::get($id_category);
    }



    ////////////// ! setters et getters ! //////////////

    // ! setter et getter id_vehicle :
    /**
     * Set the value of id_vehicle
     *
     * @return  self
     */
    public function setIdVehicle(?int $id_vehicle)
    {
        $this->id_vehicle = $id_vehicle;
    }
    public function getIdVehicle(): ?int
    {
        return $this->id_vehicle;
    }
    // ! setter et getter brand :
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }
    public function getBrand(): string
    {
        return $this->brand;
    }
    // ! setter et getter model :
    public function setModel(string $model)
    {
        $this->model = $model;
    }
    public function getModel(): string
    {
        return $this->model;
    }
    // ! setter et getter registration :
    public function setRegistration(string $registration)
    {
        $this->registration = $registration;
    }
    public function getRegistration(): string
    {
        return $this->registration;
    }
    // ! setter et getter mileage :    
    public function setMileage(int $mileage)
    {
        $this->mileage = $mileage;
    }
    public function getMileage(): int
    {
        return $this->mileage;
    }
    // ! setter et getter picture : 
    public function setPicture(?string $picture)
    {
        $this->picture = $picture;
    }
    public function getPicture(): ?string
    {
        return $this->picture;
    }
    // ! setter et getter created_at : 
    public function setCreated_at(?string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): ?string
    {
        return $this->created_at;
    }
    // ! setter et getter updated_at : 
    public function setUpdated_at(?string $updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUpdated_at(): ?string
    {
        return $this->updated_at;
    }
    // ! setter et getter deleted_at : 
    public function setDeleted_at(?string $deleted_at)
    {
        $this->deleted_at = $deleted_at;
    }
    public function getDeleted_at(): ?string
    {
        return $this->deleted_at;
    }
    // ! setter et getter idCategory :     
    public function setIdCategory(?int $id_category)
    {
        $this->id_category = $id_category;
        // $this->category = Category::get($id_category);
    }
    public function getIdCategory(): ?int
    {
        return $this->id_category;
    }
    // ? setter et getter getCategory : 
    // public function setCategory(int $id_category)
    // {
    //     $this->category = Category::get($id_category);
    // }
    // public function getCategory(): object
    // {
    //     return $this->category;
    // }




    ////////////// ! mes méthodes ! //////////////

    // ! méthode insert()
    /**
     * méthode pour insérer les données
     * @return [type]
     */
    public function insert(): bool
    {
        $pdo = Database::connect();

        $sql = "INSERT INTO `vehicles` (`brand`, `model`, `registration`, `mileage`, `picture`, `id_category`)
        VALUES (:brand, :model, :registration, :mileage, :picture, :id_category);";

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':brand', $this->getBrand());
        $sth->bindValue(':model', $this->getModel());
        $sth->bindValue(':registration', $this->getRegistration());
        $sth->bindValue(':mileage', $this->getMileage(), PDO::PARAM_INT);
        $sth->bindValue(':picture', $this->getPicture());
        $sth->bindValue(':id_category', $this->getIdCategory(), PDO::PARAM_INT);

        $sth->execute(); // renvoi true si l'exécution est ok sinon false mais renverra true aussi si l'exécution est ok alors que peut être qu'aucune ligne n'a été insérée

        $result = $sth->rowCount(); // si l'exécution est ok et qu'une a bien été insérée ça retournera 1 sinon 0

        // if ($result > 0) { // donc si une ligne a bien été insérée
        //     return true; // on veut récupérer un booléan (voir typage de la méthode)
        // } else {
        //     return false;
        // }

        return $result > 0 ? 'true' : 'false'; // même chose qu'au dessus en commentaire mais en ternaire :

        // return $sth->rowCount() > 0; // même chose qu'au dessus mais encore plus court, permet de supprimer la ligne $result = $sth->rowCount();

        // return (bool) $sth->rowCount(); // encore une autre façon d'écrire
    }

    // ! méthode isExist()
    public static function isExist(string $brand, string $model, string $registration, int $mileage, int $id_category)
    {
        $pdo = Database::connect();

        $sql = 'SELECT `brand`, `model`, `registration`, `mileage`, `picture`, `id_category`
        FROM `vehicles`
        WHERE `brand` = :brand AND `model` = :model AND `registration` = :registration AND `mileage` = :mileage AND `id_category` = :id_category;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':brand', $brand);
        $sth->bindValue(':model', $model);
        $sth->bindValue(':registration', $registration);
        $sth->bindValue(':mileage', $mileage, PDO::PARAM_INT);
        // $sth->bindValue(':picture', $picture);
        $sth->bindValue(':id_category', $id_category, PDO::PARAM_INT);

        $result = $sth->execute(); // retourne true ou false, à compléter avec fetch

        $result = $sth->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    // ! méthode getAll()
    public static function getAll(): array|false // méthode pour lire les données
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `vehicles`
        LEFT JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`
        ORDER BY `categories`.`name` ASC;'; // pour donner le choix à l'utilisateur : faire un lien à côté de Catégorie :, au clic générer une information dans l'URL, s'en servir dans la requête SQL avec un marqueur pour le ASC ou DESC.

        $sth = $pdo->query($sql); // la méthode query prépare et exécute en même temps à condition qu'il n'y ait pas de marqueurs

        $result = $sth->fetchAll(PDO::FETCH_OBJ); // récupération des résultats sous forme d'objets grâce à FETCH_OBJ (par défaut c'est du tableau indexé associatif)

        return $result;
    }

    // ! méthode update()
    public function update() // méthode pour modifier les données
    {
        $pdo = Database::connect();

        $sql = "UPDATE `vehicles` 
                SET `brand` = :brand, 
                    `model` = :model,
                    `registration`= :registration,
                    `mileage` = :mileage,
                    `picture` = :picture,
                    `id_category` = :id_category
                WHERE `id_vehicle` = :id_vehicle;";

        $sth = $pdo->prepare($sql);


        $sth->bindValue(':brand', $this->getBrand());
        $sth->bindValue(':model', $this->getModel());
        $sth->bindValue(':registration', $this->getRegistration());
        $sth->bindValue(':mileage', $this->getMileage(), PDO::PARAM_INT);
        $sth->bindValue(':picture', $this->getPicture());
        $sth->bindValue(':id_category', $this->getIdCategory());
        $sth->bindValue(':id_vehicle', $this->getIdVehicle());

        $result = $sth->execute();

        return $result;
    }
}
