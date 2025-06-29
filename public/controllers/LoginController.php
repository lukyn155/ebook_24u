<?php

// Tento kontrolér slouží jako směrovač na pohled přihlašování
class LoginController extends Controller {

    // Hodnota sloužící jako kontrola, zda je uživatel přihlášený
    private bool $authentication = false;
    private LoginModel $login;

    public function process(array $parameters): void {
        // Nastavení základních údajů o stránce
        $this->header = array(
            'title' => 'Přihlašovací obrazovka',
            'keyWords' => 'login, fomulář',
            'description' => 'Přihlašovací formulář našeho webu.'
        );

        $this->data['debug'] = $_POST;

        // Vytvoření objektu z modelu přihlášování
        $this->login = new LoginModel();

        if (isset($parameters[0]) && $parameters[0] === 'logout') {
            $this->login->logOut($this);
        }
        
        // Převezmou se přihlašovací údaje a provedese autentizace.
        // Pokud se provede v pořádku, tak se provede přesměrování na pohled skladu.
        if (isset($_POST['name'])) {
            $this->data['name'] = $_POST['name'];
            $this->data['pass'] = $_POST['pass'];
            $this->authentication = $this->login->authenticate($_POST['name'], $_POST['pass']);
            if (!$this->authentication) {
                $this->data['sign_error'] = "Bad credentials!";
            } else {
                $this->redirect('library');
            }
        } elseif (isset($_POST['regName'])) {
            $this->data['registation'] = $login->register($_POST);
        }

        // Uložení názvu pohledu pro zobrazení
        $this->view = 'login';
    }

    private function authentication(array $parameters) {
        // Pokud jsou nějaké GET parametry a první je logout, tak se provede odhlášení uživatele,
        // jinak 
        if (isset($parameters[0]) && $parameters[0] === 'logout') {
            $this->login->logOut($this);
        } else {
            // Převezmou se přihlašovací údaje a provedese autentizace.
            // Pokud se provede v pořádku, tak se provede přesměrování na pohled skladu.
            if (isset($_POST['name'])) {
                $this->data['name'] = $_POST['name'];
                $this->data['pass'] = $_POST['pass'];
                $this->authentication = $login->authenticate($_POST['name'], $_POST['pass']);
                if (!$this->authentication) {
                    $this->data['sign_error'] = "Bad credentials!";
                } else {
                    $this->redirect('inventory');
                }
            } elseif (isset($_POST['regName'])) {
                $this->data['registation'] = $login->register($_POST);
            }
        }
    }
}
