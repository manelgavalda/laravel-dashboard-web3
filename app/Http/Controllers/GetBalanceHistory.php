<?php

    namespace App\Http\Controllers;

    use App\Contracts\DatabaseService;

    class GetBalanceHistory extends ApiController
    {
        public function __invoke(DatabaseService $databaseService)
        {
            return collect($databaseService->getResults())
                ->sortByDesc('created_at')
                ->take(30)
                ->mapWithKeys(fn ($item) => [
                    $item->created_at => [
                        'balance' => $item->balance,
                        'price' => $item->price
                    ]
                ]);
        }
    }
