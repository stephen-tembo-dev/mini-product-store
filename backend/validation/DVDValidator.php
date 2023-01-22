<?php

namespace app\validation;

use app\validation\ProductValidator;

class DVDValidator extends ProductValidator
{
    public function validate($product): array
    {
        $errors = parent::validate($product);

        if ($product->getSize() <= 0) {
            $errors['size'] = 'Size must be greater than 0';
        }

        return $errors;
    }
}
