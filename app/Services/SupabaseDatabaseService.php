<?php

namespace App\Services;

use PHPSupabase\Service;
use App\Contracts\DatabaseService;

class SupabaseDatabaseService implements DatabaseService
{
    protected $url;
    protected $apiKey;

    function __construct($apiKey, $url) {
        $this->apiKey = $apiKey;
        $this->url = $url;
    }

    public function getHistoricalBalances() {
        return $this->execute('totals', [
            'select' => 'price,balance,created_at',
            'limit' => 30,
            'order' => 'created_at.desc'
        ]);
    }

    public function getTokens() {
        return $this->execute('balances', [
            'select' => 'pool,price,balance',
            'limit' => 15,
            'order' => 'created_at.desc'
        ]);
    }

    protected function execute($table, $query) {
        return collect((new Service($this->apiKey, $this->url))
            ->initializeDatabase($table)
            ->createCustomQuery($query)
            ->getResult());
    }
}

