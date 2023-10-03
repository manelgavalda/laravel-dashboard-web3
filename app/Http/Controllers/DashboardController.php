<?php

namespace App\Http\Controllers;

use App\Contracts\DatabaseService;

class DashboardController extends Controller
{
    public function index(DatabaseService $databaseService)
    {
        $tokens = $databaseService->getTokens();

        $historicalBalances = $this->getHistoricalBalances($databaseService);

        $ethereumPrice = $tokens->firstWhere('pool', 'ETH')->price;

        return view('pages/dashboard/dashboard', compact('tokens', 'historicalBalances', 'ethereumPrice'));
    }

    protected function getHistoricalBalances($databaseService)
    {
        return $databaseService->getHistoricalBalances()
            ->mapWithKeys(fn ($item) => [ $item->created_at => [
                'balance' => $item->balance,
                'price' => $item->price
            ]]);
    }
}
