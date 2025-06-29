<?php

class JsonParserModel {

    private string $filePath = __DIR__ . '/../bin/data/books.json';
    private array $data;
    private $entityManager;

    public function __construct() {
        $this->entityManager = DbModel::getConnection();
    }

    public function getJsonData() {
        $jsonData = file_get_contents($this->filePath);
        $this->data = json_decode($jsonData, true);
        return $this->data;
    }

    public function addBook(array $book): void {
        $this->getJsonData();
        $this->data['Books'][] = $book;
        $newJsonString = json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        file_put_contents($this->filePath, $newJsonString);
    }

    public function importBooks(): void {
        $this->getJsonData();
        foreach ($this->data['Books'] as $book) {
            // 1) Create new entity
            $book = new Book();

            // 2) Hydrate
            $book->setName($book['name'] ?? '');
            $book->setAuthor($book['author'] ?? '');
            $book->setYear((int) ($book['year'] ?? 0));
            $book->setAnotation($book['anotation'] ?? '');
            $book->setScore((string) ($book['score'] ?? '0.0'));

            // 3) Queue for insertion
            $this->entityManager->persist($book);
        }

        // 4) Execute *one* INSERT batch
        $this->entityManager->flush();
    }
}
