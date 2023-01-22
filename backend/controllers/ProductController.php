<?php

namespace app\controllers;

use app\database\DB;
use app\models\Product;
use app\factories\ProductFactory;
use app\controllers\BaseController;

use app\validation\{BookValidator, FurnitureValidator, DVDValidator};


class ProductController extends BaseController
{

    protected $db;
    private $product;

    public function __construct()
    {
        $this->db = DB::getInstance()->getDB();
        $this->product = new Product($this->db);
    }

    public function getProducts()
    {
        
        $products = $this->product->findAll();
        return $this->sendSuccessResponse($products, 'Products fetched successfully', 200);
    }


    public function addProduct()
    {
        
        $data = json_decode(file_get_contents('php://input'), true);

        $sanitizedData = array();

        foreach ($data as $key => $value) {

            if (is_array($value)) {

                $sanitizedData[$key] = array();

                foreach ($value as $subKey => $subValue) {
                    $sanitizedData[$key][$subKey] = htmlspecialchars($subValue, ENT_QUOTES, 'UTF-8');
                }

            } else {
                $sanitizedData[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        }


        $product = ProductFactory::create($this->db, $sanitizedData['productType'], $sanitizedData);

        $className = $product->getProductValidator();

        $validation = new $className();

        $errors = $validation->validate($product);


        if (empty($errors)) {

            $data = $product->save();
            header('Content-Type: application/json');
            return $this->sendSuccessResponse($data, 'created ok.',  201);

        } else {
            return $this->sendErrorResponse('Validation errors', $errors , 422);
        }


    }



    public function deleteProducts()
    {
        $rawData = file_get_contents('php://input');
        
        $data = json_decode($rawData, true);

        $ids = $data['products'];

        array_walk($ids, 'htmlspecialchars');

        $deleted = $this->product->deleteMany($ids);

        $responseData = ['records_deleted' => $deleted];

        if ($deleted) {
            return $this->sendSuccessResponse($responseData, "$deleted records deleted successfully", 200);
        } else {
            return $this->sendErrorResponse("Error deleting records", $responseData, 500);
        }
    }


}


