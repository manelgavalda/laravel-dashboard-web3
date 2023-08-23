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

            $prices = $this->getPrices();

            $ethereumPrice = $prices['0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE']['price']['usd'];

            $networks = $this->getNetworks($prices);

            return view('pages/dashboard/dashboard', compact('dataFeed', 'ethereumPrice', 'networks'));
        }

        protected function getNetworks($prices) {
            $networks = config('addresses.networks');
            
            foreach($networks as $network => $contracts) {
                foreach($contracts as $key => $contract) {
                    $price = $prices[$contract['address']]['price']['usd'];
                    
                    $networks[$network][$key]['price'] = $price;
                    
                    $networks[$network][$key]['balance'] = 1;
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
