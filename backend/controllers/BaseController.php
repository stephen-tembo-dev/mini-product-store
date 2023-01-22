<?php

namespace app\controllers;

use app\models\JsonResponse;

class BaseController
{

    protected function sendErrorResponse($message, $errors = null, $status = 500)
    {
        $response = new JsonResponse(null, $status, $message, $errors);
        return $response->send();
    }

    protected function sendSuccessResponse($data, $message = 'Success', $status = 200)
    {
        $response = new JsonResponse($data, $status, $message);
        return $response->send();
    }
}

