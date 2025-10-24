<?php

namespace App\Controllers\Api;

use App\Controllers\ApiController;

class Health extends ApiController
{
    /**
     * Health check endpoint
     */
    public function index()
    {
        $data = [
            'status' => 'healthy',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0.0',
            'environment' => ENVIRONMENT,
            'database' => $this->checkDatabase(),
            'services' => [
                'web' => 'running',
                'database' => $this->checkDatabase() ? 'connected' : 'disconnected'
            ]
        ];

        return $this->success($data, 'System is healthy');
    }

    /**
     * Check database connection
     */
    private function checkDatabase(): bool
    {
        try {
            $db = \Config\Database::connect();
            $db->query('SELECT 1');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
