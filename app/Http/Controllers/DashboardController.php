<?php

namespace App\Http\Controllers;

use App\Contracts\DatabaseService;

class DashboardController extends Controller
{
    public function index(DatabaseService $databaseService)
    {
        $tokens = $this->getTokens($databaseService);

        $ethereumPrice = $tokens->firstWhere('pool', 'ETH (Mainnet)')->price;

        $historicalBalances = $this->getHistoricalBalances($databaseService);

        return view('pages/dashboard/dashboard', compact('tokens', 'ethereumPrice', 'historicalBalances'));
    }

    protected function getTokens($databaseService)
    {
        $tokens = $databaseService->getTokens();

        $rewards = $tokens->whereNotNull('parent');

        foreach($tokens as $token) {
            $token->rewards = [];

            foreach($rewards as $index => $reward) {
                if($reward->parent == $token->pool) {
                    unset($tokens[$index]);

                    $token->rewards[] = $reward;
                }
            }
        }

        return $tokens;
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
