<?php

use App\Models\User;
use App\Contracts\DatabaseService;

it('gets the balance history', function () {
    $this->app->bind(DatabaseService::class, fn() =>
        new FakeDatabaseService('fakeApiKey', 'fakeUrl')
    );

    $this->actingAs(User::factory()->create());

    $this->get('get-balance-history')
         ->assertJsonCount(30)
         ->assertSeeTextInOrder([
             '2023-09-06' => 60000,
             '2023-09-07' => 30000,
             '2023-09-08' => 10000,
         ]);
});

class FakeDatabaseService implements DatabaseService
{
    public function __construct($apiKey, $url){}

    public function getResults() {
        return json_decode(File::get(
            base_path() . '/tests/Feature/responses/get_historical_balances.json'
        ));
    }
}
