<?php

// Namespace besteht aus Firma und dann dem Projektnamen
namespace WIFI\apvsa\Jobify; // in diesem Verzeichnis liegt diese Datei "Validieren.php"

class Validieren {

    private array $errors = array();

    public function ist_ausgefuellt(string $wert, string $feldname): bool { // $wert wird auf Leerheit überprüft; $feldname = Variable, die Überprüft wird, wird in der Fehlermeldung verwendet
        if (empty($wert)) {
            $this->errors[] = $feldname . " war leer.";
            return false;
        }
        return true;
    }

    public function fehler_aufgetreten(): bool {  //überprüft, ob das Array $this->errors leer ist. 
        if (empty($this->errors)) {
            return false;
        }
        return true;
    }

    public function fehler_html(): string {

        // Ausnahme: Ohne Fehler leeren string zurückgeben
        if (!$this->fehler_aufgetreten()) {
            return "";
        }

        // Eigentliche Fehlermeldungen zusammenbauen
        $ret = "<ul>";
        foreach ($this->errors as $error) {
            $ret .= "<li>" . $error . "</li>";
        }
        $ret .= "</ul>";
        return $ret;
    }

    public function fehler_hinzu(string $fehler):void {
        $this->errors[] = $fehler;
    }
}