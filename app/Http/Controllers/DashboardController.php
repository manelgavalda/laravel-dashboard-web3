<?php

namespace App\Http\Controllers;

use App\Contracts\DatabaseService;

class DashboardController extends Controller
{
    public function index(DatabaseService $databaseService)
    {
        $tokens = $databaseService->getTokens();

        $ethereumPrice = $tokens->firstWhere('pool', 'ETH')->price;

        $historicalBalances = $databaseService->getHistoricalBalances()
            ->mapWithKeys(fn ($item) => [ $item->created_at => [
                'balance' => $item->balance,
                'price' => $item->price
            ]]);

        return view('pages/dashboard/dashboard', compact('tokens', 'ethereumPrice', 'historicalBalances'));
    }
}
