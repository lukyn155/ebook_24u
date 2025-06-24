<?php

// Entita sloužící jako představení tabulky 'users' v databázi

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id;

    #[ORM\Column(type: 'string')]
    private string $firstName;

    #[ORM\Column(type: 'string')]
    private string $lastName;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', unique: true)]
    private string $login;

    #[ORM\Column(type: 'string')]
    private string $password;

    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function setLogin(string $login): self {
        $this->login = $login;
        return $this;
    }

    public function setFirstName(string $name): void {
        $this->firstName = $name;
    }

    public function setLastName(string $lastname): void {
        $this->lastName = $lastname;
    }
    
    public function setEmail(string $email): void {
        $this->lastName = $email;
    }
    
    public function setPassword(string $password): self {
        // Uložení hesla v MD5 hash
        $this->password = md5($password);
        return $this;
    }

    public function getLogin(): string {
        return $this->login;
    }


    public function getPassword(): string {
        return $this->password;
    }

    public function getId(): string {
        return $this->id;
    }
    
    public function getEmail(): string {
        return $this->email;
    }
}
