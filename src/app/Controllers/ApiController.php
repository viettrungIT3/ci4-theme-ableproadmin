<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiController extends ResourceController
{
    use ResponseTrait;

    protected $format = 'json';

    /**
     * Return a JSON response
     */
    protected function respond($data = null, ?int $status = null, string $message = '')
    {
        $status = $status ?? 200;
        $response = [
            'status' => $status,
            'message' => $message ?: $this->getStatusMessage($status),
            'data' => $data
        ];

        return $this->response->setJSON($response)->setStatusCode($status);
    }

    /**
     * Return success response
     */
    protected function success($data = null, string $message = 'Success', int $status = 200)
    {
        return $this->respond($data, $status, $message);
    }

    /**
     * Return error response
     */
    protected function error(string $message = 'Error', int $status = 400, $data = null)
    {
        return $this->respond($data, $status, $message);
    }

    /**
     * Return validation error response
     */
    protected function validationError(array $errors)
    {
        return $this->respond($errors, 422, 'Validation failed');
    }

    /**
     * Get status message based on status code
     */
    private function getStatusMessage(int $status): string
    {
        $messages = [
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error'
        ];

        return $messages[$status] ?? 'Unknown';
    }
}
