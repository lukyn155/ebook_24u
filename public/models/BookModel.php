<?php

class BookModel {

    // Databázové připojení
    private $entityManager;

    public function __construct() {
        $this->entityManager = DbModel::getConnection();
    }

    public function getWholeLibrary() {
        $book_repository = $this->entityManager->getRepository('Book');
        $library = $book_repository->findBy(
                [],
                ['id' => 'ASC']
        );

        return $library;
    }
}
