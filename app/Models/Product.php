<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $primaryKey='id';

    public $timestamps = false;

    public function getAll($clientId)
    {
        $products = self::query()
            ->select([
                'products.id as productId',
                'products.name as productName',
                'products.stock as productStock',
            ])
            ->join('client_product','products.id','=','client_product.product_id')
            ->join('clients','client_product.client_id','=','clients.id')
            ->where('clients.id',$clientId)
            ->get();

        $data = ['products' => $products];

        return $data;
    }

    public function isStockAvailable($product){
        $valid = true;
        if($product['productQuantity'] > $product['productStock']){
            $valid = false;
        }

        return $valid;
    }

    public function isValidQuantity($product)
    {
        $valid = true;
        $quantity = $product['productQuantity'];

        if(is_numeric($quantity)){
            if($quantity <= 0){
                $valid = false;
            }
        } else {
            $valid = false;
        }

        return $valid;
    }

    public function updateProductStock($buyedProduct)
    {
        $product = self::find($buyedProduct['productId']);
        $newStock = $product->stock - $buyedProduct['productQuantity'];
        $product->stock = $newStock;
        $product->save();

        return true;
    }

    public function isValidProductForClient($product,$clientId)
    {
        $valid = true;

        $availableProducts = $this->getAll($clientId);
        $availableProducts = $availableProducts['products'];
        $availableProducts = collect($availableProducts)->pluck('productId');

        if(!$availableProducts->contains($product['productId'])){
            $valid = false;
        }

        return $valid;
    }
}
