<?php

namespace App\Console\Commands;

use App\Models\Crypto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AvgBigPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:avg {crypto : Simbolo da criptomoeda}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $crypto_name = strtoupper($this->argument('crypto') . 'usdt');

        $crypto = Http::get("https://testnet.binancefuture.com/fapi/v1/ticker/price", [
            'symbol' => $crypto_name,
        ]);

        if (isset($crypto['code'], $crypto['msg'])) {
            echo "Simbolo invalido. \n";
            return 0;
        }

        $crypto_price = $crypto['price'];

        $avg = Crypto::where('cryptocurrency', $crypto_name)->pluck('price')->take(100)->avg();

        if(!$avg) {
            echo "Sem historicos dessa moeda!. \n";
            return 0;
        }

        $discounted_price = $crypto_price - ($crypto_price * 0.5 / 100);

        echo "Preço medio: $avg \n";

        echo "Ultimo preço: $crypto_price \n";

        if ($discounted_price < $avg) {
            echo "Esta menor que o preço medio! \n";
        }

        return 1;
    }
}
