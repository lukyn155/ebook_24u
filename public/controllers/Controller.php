<?php
// Základní kontrolér, ze kterého vychází všechny ostatní kontoléry
abstract class Controller {
    
    // Jednotlivé slovné hodnoty, které budou pak v jednotlivých pohledech dostupné jakožto proměnné
    protected array $data = array();
    // Proměnná do které se ukládá název pohledu, který se má zobrazit
    protected string $view = "";
    //Základní nastavení hodnot v pohledu
    protected array $header = array('title' => '', 'keyWords' => '', 'description' => '');

    /* Process je základní funkce pro všechny kontrolery.
     * Musí ji definovat svým způsobem a slouží pro získání 
     * dat a následnému přiřazení pohledu.
     */
    abstract function process(array $parameters): void;

    // Funkce která najde konkrétní pohled a přilinkuje ho do aktuálního souboru.
    public function getView(): void {
        if ($this->view) {
            extract($this->treat($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require(__DIR__ . "/../views/" . $this->view . ".phtml");
        }
    }
    
    /* Funkce, která převezme převážně pole jako parametr, když parametr není předán automaticky se pracuje s nullovou hodnotou.
     * Je to rekurzivní funkce, která zajistí, že žádné speciální textové hodnoty se nebudou brát jako html prvky, ale pouze jako normální text.
     */
    private function treat(mixed $x = null): mixed {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->treat($v);
            }
            return $x;
        } else
            return $x;
    }

    // Provede se přesměrování na jiné URL
    public function redirect(string $url) {
        header("Location: /$url");
        header("Connection: close");
    }
}
