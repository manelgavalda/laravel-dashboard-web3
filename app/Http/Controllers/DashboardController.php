<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Http;
    use App\Models\DataFeed;

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

            $networks = $this->getNetworks();

            return view('pages/dashboard/dashboard', compact('dataFeed', 'networks'));
        }

        protected function getNetworks() {
            $networks = config('addresses.networks');

            $prices = $this->getPrices();
            
            foreach($networks as $network => $contracts) {
                foreach($contracts as $key => $contract) {
                    $price = $prices[$contract['address']]['price']['usd'];
                    
                    $networks[$network][$key]['price'] = $price;
                }
            }

            return $networks;
        }

        protected function getPrices() {
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
