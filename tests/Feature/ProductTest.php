<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Product;
use App\Models\ClientProduct;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_available_products_by_client()
    {

        // Se crea un cliente y se le asocia un producto
        $client = Client::factory()->create();
        $clientId = $client->id;

        $this->assertIsInt($clientId);

        $product = Product::factory()->create();
        $productId = $product->id;

        $this->assertIsInt($productId);

        $clientProduct = ClientProduct::factory()->create([
            'client_id' => $clientId,
            'product_id' => $productId
        ]);

        $this->assertIsInt($clientProduct->id);

        // Cuando se consultan los productos del cliente creado
        $url = 'api/product/' . $clientId;

        $response = $this->get($url);
        $result = $response->original;
        $products = $result['products'];
        $productsLen = count($products);

        // Se espera que la cantidad de productos obtenidos sea 1
        $this->assertEquals(1,$productsLen);

        $response->assertStatus(200);
    }
}
