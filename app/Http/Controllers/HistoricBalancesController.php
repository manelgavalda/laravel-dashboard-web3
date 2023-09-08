<?php

    namespace App\Http\Controllers;

    class HistoricBalancesController extends ApiController
    {
        public function get()
        {
            $response = $this->getService()
                ->initializeDatabase('totals', 'id')
                ->fetchAll()
                ->getResult();

            return $this->parseResponse($response);
        }

        private function getService()
        {
            return new \PHPSupabase\Service(
                config('supabase.api_key'),
                config('supabase.url')
            );
        }

        private function parseResponse($response) {
            $result = [
                'data' => [],
                'labels' => []
            ];

            collect($response)
                ->sortByDesc('created_at')
                ->take(30)
                ->each(function($item) use (&$result) {
                    $result['data'][] = $item->balance * $item->price;
                    $result['labels'][] = $item->created_at;
                });

            return $result;
        }
    }
