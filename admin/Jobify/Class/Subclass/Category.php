<?php

namespace WIFI\apvsa\Jobify\Class\Subclass;

class Category extends RowAbstract {   // die Klasse "Category" erbt alle Methoden und Eigenschaften von RowAbstract und kann diese überschreiben oder erweitern
    protected string $tabelle = "kategorien";  //  um auf die Tabelle "Marken von Unterklassen aus zugreifen zu können 
}