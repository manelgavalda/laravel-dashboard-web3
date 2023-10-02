<?php

namespace App\Http\Controllers;

use App\Contracts\DatabaseService;

class DashboardController extends Controller
{
    /**
     * Displays the dashboard screen
     */
    public function index(DatabaseService $databaseService)
    {
        // dd($this->getTokens($databaseService));

        $historicalBalances = $this->getHistoricalBalances($databaseService);

        return view('pages/dashboard/dashboard', compact('historicalBalances'));
    }

    protected function getHistoricalBalances($databaseService)
    {
        return collect($databaseService->getHistoricalBalances())
            ->sortByDesc('created_at')
            ->take(30)
            ->mapWithKeys(fn ($item) => [
                $item->created_at => [
                    'balance' => $item->balance,
                    'price' => $item->price
                ]
            ]);
    }

    protected function getTokens($databaseService)
    {
        return collect($databaseService->getTokens());
    }
}
