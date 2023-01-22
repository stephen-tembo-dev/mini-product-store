<?php

namespace app\validation;

use app\validation\ProductValidator;

class FurnitureValidator extends ProductValidator
{
    public function validate($product): array
    {
        $errors = parent::validate($product);

        if ($product->getWidth() <= 0) {
            $errors['width'] = 'Width must be greater than 0';
        }
        if ($product->getHeight() <= 0) {
            $errors['height'] = 'Height must be greater than 0';
        }
        if ($product->getLength() <= 0) {
            $errors['length'] = 'Length must be greater than 0';
        }

        return $errors;
    }
}
