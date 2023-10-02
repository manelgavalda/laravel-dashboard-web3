<?php

namespace App\Services;

use PHPSupabase\Service;
use App\Contracts\DatabaseService;

class SupabaseDatabaseService implements DatabaseService
{
    public function __construct($apiKey, $url) {
        $this->apiKey = $apiKey;
        $this->url = $url;
    }

    private function get() {
        return new Service($this->apiKey, $this->url);
    }

    public function getHistoricalBalances() {
        return $this->get()
            ->initializeDatabase('totals', 'id')
            ->fetchAll()
            ->getResult();
    }

    public function getTokens() {
        return $this->get()
            ->initializeDatabase('balances', 'id')
            ->fetchAll()
            ->getResult();
    }
}

