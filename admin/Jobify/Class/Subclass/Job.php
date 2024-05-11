<?php

namespace WIFI\apvsa\Jobify\Class\Subclass;

class Job extends RowAbstract {
    protected string $tabelle = "jobs";

    public function get_category(): Category {
        return new Category($this->id);
    }
}