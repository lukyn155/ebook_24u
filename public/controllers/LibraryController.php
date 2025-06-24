<?php

// Kontrolér sloužící jako směrovač pro reporty
class LibraryController extends Controller {

    public function process(array $parameters): void {
        // Nastavení základních údajů o stránce
        $this->header = array(
            'title' => 'Přehled knih',
            'keyWords' => 'books, library, overview',
            'description' => 'Přehledová stránka přidaných knih.'
        );

        $this->view = 'library';
    }
}
