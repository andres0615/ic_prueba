<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => function(){
                $client = Client::factory()->create();
                return $client->id;
            },
            'product_id' => function(){
                $product = Product::factory()->create();
                return $product->id;
            }
        ];
    }
}
