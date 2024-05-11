<?php

namespace WIFI\apvsa\Jobify\Class\Subclass;

class Jobcategories extends RowAbstract {   // die Klasse "Category" erbt alle Methoden und Eigenschaften von RowAbstract und kann diese überschreiben oder erweitern
    protected string $tabelle = "kategorien_zu_jobs";  //  um auf die Tabelle "Marken von Unterklassen aus zugreifen zu können 
}