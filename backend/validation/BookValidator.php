<?php

namespace app\validation;

use app\validation\ProductValidator;

class BookValidator extends ProductValidator
{
    public function validate($product): array
    {
        $errors = parent::validate($product);

        if ($product->getWeight() <= 0) {
            $errors['weight'] = 'Weight must be greater than 0';
        }

        return $errors;
    }
}
