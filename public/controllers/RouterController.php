<?php

// Tento kontrolér, který funguje jako obecný směrovač
class RouterController extends Controller {

    // Uložení kontroléru, který bude následně zobrazovat konkrétní pohled
    protected Controller $controller;

    public function process(array $parameters): void {
        $parsedURL;
        // Začne session ve webovém prohlížeči
        session_start();

        $controllerClass = 'library';
        // Nastavení kontroléru z URL stringu
        $controllerClass = $this->dashToCamelCase(array_shift($parsedURL)) . 'Controller';

        // Pokud se povede najít kontrolér, tak se načte do atributu třídy jinak se provede přesměrování na chybovou stránku
        if (file_exists('controllers/' . $controllerClass . '.php')) {
            $this->controller = new $controllerClass;
        } else {
            $this->redirect('error');
        }

        // Provede se zobrazení pohledu z kontroleru uloženého v atributu
        $this->controller->process($parsedURL);
        $this->data['title'] = $this->controller->header['title'];
        $this->data['description'] = $this->controller->header['description'];
        $this->data['keyWords'] = $this->controller->header['keyWords'];
        // Uložení názvu pohledu pro zobrazení
        $this->view = 'layout';
    }

    // Provede rozdělení URL cesty a vytvoří se z ní pole s jednotlivými parametry
    public function parseURL(string $url): array {
        $parsedURL = parse_url($url);
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = trim($parsedURL["path"]);

        $dividedPath = explode("/", $parsedURL["path"]);

        return $dividedPath;
    }

    // Nahradí pomlčky mezerama, které vytvoří ve stringu slova.
    // První písmeno v každém slově je převedeno na velké.
    // Následně se zruší mezery ve slovech
    public function dashToCamelCase(string $text): string {
        $sentense = str_replace('-', ' ', $text);
        $sentense = ucwords($sentense);
        $sentense = str_replace(' ', '', $sentense);

        return $sentense;
    }
}
