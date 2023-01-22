<?php

namespace app\validation;

class ProductValidator
{
    public function validate($product): array
    {
        $errors = [];
        if (empty($product->getSku())) {
            $errors['sku'] = 'SKU is required';
        }
        if (empty($product->getName())) {
            $errors['name'] = 'Name is required';
        }
        if ($product->getPrice() <= 0) {
            $errors['price'] = 'Price must be greater than 0';
        }
        return $errors;
    }
}
