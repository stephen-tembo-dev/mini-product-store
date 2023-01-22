<?php

namespace app\models;

class JsonResponse
{
    private $data;
    private $statusCode;
    private $message;
    private $errors;

    public function __construct($data = null, int $statusCode = 200, string $message = '', $errors = null)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function send(): void
    {
        try {
            http_response_code($this->statusCode);
            header('Content-Type: application/json');

            echo json_encode([
                'data' => $this->data,
                'status' => $this->statusCode,
                'message' => $this->message,
                'errors' => $this->errors,
            ]);
            
        } catch (\Exception $e) {
            // Log the error message and stack trace
            error_log($e->getMessage());
            error_log($e->getTraceAsString());

            // Set the response status code to 500 (Internal Server Error)
            http_response_code(500);

            // Send an error message as the response
            echo json_encode([
                'status' => 500,
                'message' => 'An error occurred while processing the request.',
            ]);
        }
    }

}
