<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Client;
use App\Models\ClientProduct;

class ClientProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = Client::all();
        $products = Product::all();

        $clients->each(function($client) use($products) {
            // se seleccionan 3 productos random
            $selectedProducts = $products->shuffle()->take(3);

            $selectedProducts->each(function($product) use($client){
                ClientProduct::factory()
                ->create([
                    'client_id' => $client->id,
                    'product_id' => $product->id
                ]);
            });
        });
    }
}
