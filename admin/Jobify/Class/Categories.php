<?php

namespace WIFI\apvsa\Jobify\Class;

use WIFI\apvsa\Jobify\Mysql;
use WIFI\apvsa\Jobify\Class\Subclass\Category;

class Categories {
    public function all_categories(): array {
        $all_categories = array();
        $db = Mysql::getInstanz();
        $result = $db->query("SELECT * FROM kategorien ORDER BY name ASC");
        while ($row = $result->fetch_assoc()) {
            $all_categories[] = new Category($row);
        }
        return $all_categories;
    }
}