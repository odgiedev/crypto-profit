<?php

namespace App\Console\Commands;

use App\Models\Crypto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BidPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:c {crypto : Simbolo da criptomoeda}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Salva valor da criptomoeda no banco de dados.';

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

        Crypto::create([
            'cryptocurrency' => $crypto_name,
            'price' => $crypto['price']
        ]);

        # comente o trecho de codigo acima e descomente o de baixo
        # caso queira salvar 100 valores de uma vez.

        /* for ($i=0; $i <= 100; $i++) { 
            echo 'Isso pode demorar um pouco!';

            $crypto = Http::get("https://testnet.binancefuture.com/fapi/v1/ticker/price", [
                'symbol' => $crypto_name,
            ]);
            
            if (isset($crypto['code'], $crypto['msg'])) {
                echo 'Simbolo invalido.';
                return 0;
            }

            Crypto::create([
                'cryptocurrency' => $crypto_name,
                'price' => $crypto['price']
            ]);
        } */

        echo 'Valor salvo: ' . $crypto['price'];

        return 1;
    }
}
