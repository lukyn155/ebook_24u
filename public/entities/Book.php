<?php

// Entita sloužící jako představení tabulky 'materials' v databázi

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'books')]
class Book {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $author;

    #[ORM\Column(type: 'integer')]
    private int $year;

    #[ORM\Column(type: 'text')]
    private string $anotation;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 1)]
    private string $score;

    public function getId(): int|null {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function getAnotation(): string {
        return $this->anotation;
    }

    public function getScore(): string {
        return $this->score;
    }

    public function setId(int|null $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    public function setYear(int $year): void {
        $this->year = $year;
    }

    public function setAnotation(string $anotation): void {
        $this->anotation = $anotation;
    }

    public function setScore(string $score): void {
        $this->score = $score;
    }
}
