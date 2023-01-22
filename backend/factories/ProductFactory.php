<?php

namespace app\factories;

use app\database\DB;
use Exception;
use PDO;



class ProductFactory
{
    public static function create(PDO $db, string $type, array $properties)
    {
        $className = "app\models\\".ucfirst($type);

        if(!class_exists($className)) {
            throw new \Exception("Invalid product type");
        }

        return new $className($db, $properties);
    }
}
