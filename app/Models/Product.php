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
            ])
            ->join('client_product','products.id','=','client_product.product_id')
            ->join('clients','client_product.client_id','=','clients.id')
            ->where('clients.id',$clientId)
            ->get();

        $data = ['products' => $products];

        return $data;
    }
}
