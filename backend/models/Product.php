<?php

namespace app\models;

use PDO;

class Product 
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function findAll(): array
    {
        $query = 'SELECT * FROM products';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne(string $sku): ?array
    {
        $query = 'SELECT * FROM products WHERE sku = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $sku, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function deleteMany(array $ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        var_dump($placeholders);

        $query = "DELETE FROM products WHERE id IN ($placeholders)";
        $stmt = $this->db->prepare($query);
        $stmt->execute($ids);

        // Return the number of rows affected by the DELETE query
        return $stmt->rowCount();
    }
}

       


