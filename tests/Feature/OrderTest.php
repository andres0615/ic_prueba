<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Client;
use App\Models\Product;
use App\Models\ClientProduct;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_client_can_buy_products()
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

        // se obtienen los productos disponibles para el cliente
        $productModel = new Product();
        $productsResult = $productModel->getAll($clientId);
        $products = $productsResult['products'];

        $productsLen = count($products);

        // Se espera que la cantidad de productos obtenidos sea 1
        $this->assertEquals(1,$productsLen);

        // se definen indices necesarios
        $products = $products->each(function($product){
            $product['productQuantity'] = 1;
            $product['selected'] = false;
            return $product;
        });
        
        $products = $products->toArray();

        // Se indican los productos que se quieren comprar y la cantidad
        $products[0]['selected'] = true;
        $products[0]['productQuantity'] = 1;

        // dump($products);

        // se define la request data
        $requestData = [
            'clientId' => $clientId,
            'products' => $products
        ];

        // Cuando se crea una orden
        $url = 'api/order';

        $response = $this->post($url,$requestData);

        $response->assertOk();

        $result = $response->original;

        // dump(__FILE__, $result);

        // Se espera que el resultado sea exitoso
        $this->assertTrue($result['success']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_client_can_not_buy_products_because_of_invalid_quantity()
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

        // se obtienen los productos disponibles para el cliente
        $productModel = new Product();
        $productsResult = $productModel->getAll($clientId);
        $products = $productsResult['products'];

        $productsLen = count($products);

        // Se espera que la cantidad de productos obtenidos sea 1
        $this->assertEquals(1,$productsLen);

        // se definen indices necesarios
        $products = $products->each(function($product){
            $product['productQuantity'] = 1;
            $product['selected'] = false;
            return $product;
        });
        
        $products = $products->toArray();

        // Se indican los productos que se quieren comprar y la cantidad
        $products[0]['selected'] = true;
        // se indica una cantidad invalida
        $products[0]['productQuantity'] = -2;

        // dump($products);

        // se define la request data
        $requestData = [
            'clientId' => $clientId,
            'products' => $products
        ];

        // Cuando se crea una orden
        $url = 'api/order';

        $response = $this->post($url,$requestData);

        $response->assertOk();

        $result = $response->original;

        // dump(__FILE__, $result);
        
        // Se espera que el resultado no sea exitoso
        $this->assertFalse($result['success']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_client_can_not_buy_products_because_of_unavailable_stock()
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

        // se obtienen los productos disponibles para el cliente
        $productModel = new Product();
        $productsResult = $productModel->getAll($clientId);
        $products = $productsResult['products'];

        $productsLen = count($products);

        // Se espera que la cantidad de productos obtenidos sea 1
        $this->assertEquals(1,$productsLen);

        // se definen indices necesarios
        $products = $products->each(function($product){
            $product['productQuantity'] = 1;
            $product['selected'] = false;
            return $product;
        });
        
        $products = $products->toArray();

        // Se indican los productos que se quieren comprar y la cantidad
        $products[0]['selected'] = true;
        $invalidQuantity = $products[0]['productStock'] + 2;
        // se indica una cantidad invalida
        $products[0]['productQuantity'] = $invalidQuantity;

        // dump($products);

        // se define la request data
        $requestData = [
            'clientId' => $clientId,
            'products' => $products
        ];

        // Cuando se crea una orden
        $url = 'api/order';

        $response = $this->post($url,$requestData);

        $response->assertOk();

        $result = $response->original;

        // dump(__FILE__, $result);

        // Se espera que el resultado no sea exitoso
        $this->assertFalse($result['success']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_client_can_not_buy_products_because_of_invalid_product_for_client()
    {
        // Se crea un cliente y un producto
        $client = Client::factory()->create();
        $clientId = $client->id;

        $this->assertIsInt($clientId);

        $product = Product::factory()->create();
        
        // Se indica que se quiere comprar un producto que no esta asociado al cliente
        $products = [$product];

        // Se indican los productos que se quieren comprar y la cantidad
        $products[0]['selected'] = true;
        $products[0]['productQuantity'] = 1;

        // dump($products);

        // se define la request data
        $requestData = [
            'clientId' => $clientId,
            'products' => $products
        ];

        // Cuando se crea una orden
        $url = 'api/order';

        $response = $this->post($url,$requestData);

        $response->assertOk();

        $result = $response->original;

        // dump(__FILE__, $result);

        // Se espera que el resultado no sea exitoso
        $this->assertFalse($result['success']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_client_can_not_buy_products_because_of_has_not_selected_products()
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

        // se obtienen los productos disponibles para el cliente
        $productModel = new Product();
        $productsResult = $productModel->getAll($clientId);
        $products = $productsResult['products'];

        $productsLen = count($products);

        // Se espera que la cantidad de productos obtenidos sea 1
        $this->assertEquals(1,$productsLen);

        // se definen indices necesarios
        $products = $products->each(function($product){
            $product['productQuantity'] = 1;
            $product['selected'] = false;
            return $product;
        });
        
        $products = $products->toArray();

        // Se indican los productos que se quieren comprar y la cantidad
        // en este caso no se escoge ningun producto
        $products[0]['selected'] = false;
        $products[0]['productQuantity'] = 1;

        // dump($products);

        // se define la request data
        $requestData = [
            'clientId' => $clientId,
            'products' => $products
        ];

        // Cuando se crea una orden
        $url = 'api/order';

        $response = $this->post($url,$requestData);

        $response->assertOk();

        $result = $response->original;

        // dump(__FILE__, $result);

        // Se espera que el resultado sea exitoso
        $this->assertFalse($result['success']);
    }
}