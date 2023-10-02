<?php

namespace App\Services;

use PHPSupabase\Service;
use App\Contracts\DatabaseService;

class SupabaseDatabaseService implements DatabaseService
{
    protected $url;
    protected $apiKey;

    public function __construct($apiKey, $url) {
        $this->apiKey = $apiKey;
        $this->url = $url;
    }

    private function get() {
        return new Service($this->apiKey, $this->url);
    }

    public function getHistoricalBalances() {
        return $this->get()
            ->initializeDatabase('totals')
            ->createCustomQuery([
                'select' => 'price,balance,created_at',
                'from'   => 'totals',
                'limit' => 30,
                'order' => 'created_at.desc'
            ])->getResult();
    }

    public function getTokens() {
        return $this->get()
            ->initializeDatabase('balances')
            ->createCustomQuery([
                'select' => 'pool,price,balance',
                'from'   => 'balances',
                'limit' => 12,
                'order' => 'created_at.desc'
            ])->getResult();
    }
}

