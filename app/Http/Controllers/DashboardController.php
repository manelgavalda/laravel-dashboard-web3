<?php

    namespace App\Http\Controllers;

    use App\Models\DataFeed;
    use Illuminate\Support\Facades\Http;

    class DashboardController extends Controller
    {

        /**
         * Displays the dashboard screen
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
         */
        public function index()
        {
            $dataFeed = new DataFeed();

            $tokens = $this->getTokensWithPrices();
            $networks = $this->getNetworks($tokens);

            return view('pages/dashboard/dashboard', compact('dataFeed', 'networks', 'tokens'));
        }

        protected function getNetworks($prices) {
            $networks = config('addresses.networks', []);

            foreach($networks as $network => $contracts) {
                foreach($contracts as $key => $contract) {
                    $networks[$network][$key]['price'] = 0;
                    $networks[$network][$key]['balance'] = 0;

                    if(array_key_exists($contract['address'], $prices)) {
                        $networks[$network][$key]['price'] = $prices[$contract['address']]['price']['usd'];
                    }
                }
            }

            return $networks;
        }

        protected function getTokensWithPrices() {
            $tokens = config('addresses.tokens');

            $ids = implode(',', array_map(fn ($token) => $token['coingeckoId'], $tokens));

            $url = "https://api.coingecko.com/api/v3/simple/price?ids={$ids}&vs_currencies=usd,eur";

            $response = Http::get($url);

            $data = json_decode($response->body(), true);

            foreach ($tokens as &$token) {
                $token['price'] = $data[$token['coingeckoId']];
            }

            return $tokens;
        }
    }
