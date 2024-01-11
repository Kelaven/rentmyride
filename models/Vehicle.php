<?php

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/Database.php';



class Vehicle
{

    // ! attributs
    private string $brand;
    private string $model;
    private string $registration;
    private int $mileage;
    private ?string $picture;
    private string $created_at;
    private string $updated_at;
    private ?string $deleted_at;
    // ? private int $id_categories;


    // ! méthode magique
    public function __construct(
        string $brand = '',
        string $model = '',
        string $registration = '',
        int $mileage = NULL,
        ?string $picture = '',
        string $created_at = '',
        string $updated_at = '',
        ?string $deleted_at = '',
        int $id_categories = NULL
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->registration = $registration;
        $this->mileage = $mileage;
        $this->picture = $picture;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
        // ? $this->id_categories = $id_categories;
    }

    // ! getters
    public function getBrand(): string
    {
        return $this->brand;
    }
    public function getModel(): string
    {
        return $this->model;
    }
    public function getRegistration(): string
    {
        return $this->registration;
    }
    public function getMileage(): int
    {
        return $this->mileage;
    }
    public function getPicture(): ?string
    {
        return $this->picture;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }
    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }
    public function getDeleted_at(): ?string
    {
        return $this->deleted_at;
    }
    // ? public function getId_categories(): int
    // {
    //     return $this->id_categories;
    // }

    // ! setters
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }
    public function setModel(string $model)
    {
        $this->model = $model;
    }
    public function setRegistration(string $registration)
    {
        $this->registration = $registration;
    }
    public function setMileage(int $mileage)
    {
        $this->mileage = $mileage;
    }
    public function setPicture(?string $picture)
    {
        $this->picture = $picture;
    }
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function setDeleted_at(?string $deleted_at)
    {
        $this->deleted_at = $deleted_at;
    }
    // ? public function setId_categories(int $id_categories)
    // {
    //     $this->id_categories = $id_categories;
    // }
}
