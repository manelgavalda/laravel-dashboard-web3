<?php

namespace App\Services;

use PHPSupabase\Service;
use App\Contracts\DatabaseService;

class SupabaseDatabaseService implements DatabaseService
{
    protected $service;

    function __construct($apiKey, $url) {
        $this->service = new Service($apiKey, $url);
    }

    public function getHistoricalBalances() {
        return $this->execute('totals', [
            'select' => 'price,balance,created_at',
            'limit' => 25,
            'order' => 'created_at.desc'
        ]);
    }

    public function getTokens() {
        return $this->execute('balances', [
            'select' => 'pool,price,balance,parent',
            'limit' => 15,
            'order' => 'created_at.desc'
        ]);
    }

    protected function execute($table, $query) {
        return collect($this->service
            ->initializeDatabase($table)
            ->createCustomQuery($query)
            ->getResult());
    }
}

