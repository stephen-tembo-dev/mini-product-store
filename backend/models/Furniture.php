<?php

namespace app\models;

use app\abstracts\ProductAbstract;
use PDO;

class Furniture extends ProductAbstract
{
    protected $width;
    protected $height;
    protected $length;
    protected $db;
    protected $size;
    protected $product_type;


    public function __construct(PDO $db, array $properties)
    {

        $this->db = $db;
        $this->height = $properties['height'];
        $this->width = $properties['width'];
        $this->length = $properties['length'];
        $this->product_type = $properties['productType'];

        parent::__construct($db, $properties['sku'], $properties['name'], (float) $properties['price']);
        
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): void
    {
        $this->length = $length;
    }

    public function getProductValidator()
    {
      return "app\\validation\\".$this->product_type."Validator"; 
    }

    public function save()
    {

        try {

        $query = 'INSERT INTO products (sku, name, price, width, height, length, product_type) VALUES (:sku, :name, :price, :width, :height, :length, :product_type)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':sku', $this->sku, PDO::PARAM_STR);
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindParam(':width', $this->width, PDO::PARAM_STR);
        $stmt->bindParam(':height', $this->height, PDO::PARAM_STR);
        $stmt->bindParam(':length', $this->length, PDO::PARAM_STR);
        $stmt->bindParam(':product_type', $this->product_type, PDO::PARAM_STR);
        $stmt->execute();

        // Get the ID of the inserted record
        $id = $this->db->lastInsertId();

        // Select the inserted record from the database
        $query = 'SELECT * FROM products WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the record as an associative array
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the record
        return $record;
            
        } catch (\PDOException $e) {
            throw $e;
        }

        
    }
}
