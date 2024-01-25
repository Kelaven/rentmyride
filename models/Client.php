<?php

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/Database.php';


class Client
{
    // ! attributs
    private ?int $id_client;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $birthday;
    private string $phone;
    private string $city;
    private string $zipcode;
    private ?string $created_at;
    private ?string $updated_at;


    ////////////// ! setters et getters ! //////////////
    // ! setter et getter id_client :
    public function setIdClient(?int $id_client)
    {
        $this->id_client = $id_client;
    }
    public function getIdClient(): ?int
    {
        return $this->id_client;
    }
    // ! setter et getter lastname :
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    // ! setter et getter firstname :
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    // ! setter et getter email :
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    // ! setter et getter birthday :
    public function setBirthday(string $birthday)
    {
        $this->birthday = $birthday;
    }
    public function getBirthday(): string
    {
        return $this->birthday;
    }
    // ! setter et getter phone :
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    // ! setter et getter city :
    public function setCity(string $city)
    {
        $this->city = $city;
    }
    public function getCity(): string
    {
        return $this->city;
    }
    // ! setter et getter zipcode :
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }
    public function getZipcode(): string
    {
        return $this->zipcode;
    }
    // ! setter et getter created_at :
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;
    }
    public function getCreated_at(): string
    {
        return $this->created_at;
    }
    // ! setter et getter updated_at :
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }
    
}
