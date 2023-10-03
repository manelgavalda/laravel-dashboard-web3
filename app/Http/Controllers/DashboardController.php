<?php

namespace App\Http\Controllers;

use App\Contracts\DatabaseService;

class DashboardController extends Controller
{
    public function index(DatabaseService $databaseService)
    {
        $tokens = $databaseService->getTokens();

        foreach($tokens as $token) {
            $token->rewards = [];

            foreach($tokens->whereNotNull('parent') as $index => $reward) {
                if($reward->parent == $token->pool) {
                    unset($tokens[$index]);

                    $token->rewards[] = $reward;
                }
            }
        }

        $ethereumPrice = $tokens->firstWhere('pool', 'ETH (Mainnet)')->price;

        $historicalBalances = $databaseService->getHistoricalBalances()
            ->mapWithKeys(fn ($item) => [ $item->created_at => [
                'balance' => $item->balance,
                'price' => $item->price
            ]]);

        return view('pages/dashboard/dashboard', compact('tokens', 'ethereumPrice', 'historicalBalances'));
    }
}
