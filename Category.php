<?php

// ! création de la classe
class Category{

    // ! création des attributs
    private ?int $id_category; // le ? précise si la donnée est obligatoire ou pas
    private string $name;

    // ! création des getters
    /**
     * retourne la valeur de id_category
     * @return int
     */
    public function getIdCategory(): ?int{
        return $this->id_category;
    }
    /**
     * retourne la valeur de name
     * @return string
     */
    public function getName(): string{
        return $this->name;
    }

    // ! création des setters
    /**
     * modifies la valeur de id_category
     * @param int $id_category
     * 
     * @return [type]
     */
    public function setIdCategory(?int $id_category){
        $this->id_category = $id_category;
    }
    /**
     * modifies la valeur de name
     * @param string $name
     * 
     * @return [type]
     */
    public function setName(string $name){
        $this->name = $name;
    }


    // ! création de la méthode magique construct
    public function __construct(string $name, ?int $id_category = NULL){
        $this->name = $name;
        $this->id_category = $id_category;
    }

}


// ? test
$audi = new Category('a3', 1);
var_dump($audi);