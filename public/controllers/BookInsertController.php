<?php

// Kontrolér sloužící jako směrovač pro reporty
class BookInsertController extends Controller {

    public function process(array $parameters): void {
        // Nastavení základních údajů o stránce
        $this->header = array(
            'title' => 'Import knih',
            'keyWords' => 'form, import, administration',
            'description' => 'Přehledová stránka přidaných knih.'
        );
        

        $jsonParser = new JsonParserModel();

        $this->data['debug'][] = $jsonParser->getJsonData();
        $this->data['debug'][] = $_POST;
                
        if (isset($_POST['name'])) {
            $jsonParser->addBook(array(
                'name' => $_POST['name'],
                'author' => $_POST['author'],
                'year' => intval($_POST['year']),
                'anotation' => $_POST['anotation'],
                'score' => intval($_POST['score']),
            ));
        }

        if (isset($parameters[0]) && $parameters[0] === 'import') {
            $jsonParser->importBooks();
        }

        $this->view = 'bookInsert';
    }
}
