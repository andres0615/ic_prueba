<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    protected $primaryKey='id';

    public function createOrder($requestData)
    {
        DB::beginTransaction();

        $data = [];
        $errorMessages = [];
        $clientId = $requestData['clientId'];
        $products = $requestData['products'];
        $productModel = new Product();

        $order = new self();
        $order->client_id = $clientId;
        $order->save();

        $selectedProducts = 0;

        foreach($products as $product) {
            if($product['selected'] === true){

                $selectedProducts++;

                // se valida que la cantidad escogida sea un valor valido
                $isValidQuantity = $productModel->isValidQuantity($product);
                if(!$isValidQuantity){
                    $message = 'Escoja una cantidad valida para el producto <b>"' . $product['productName'] . '"</b>, debe ingresar un numero mayor a 0.';
                    array_push($errorMessages,$message);
                    continue;
                }

                // Se valida que la cantidad no supere el stock
                $isStockAvailable = $productModel->isStockAvailable($product);
                if(!$isStockAvailable){
                    $message = 'Escoja una cantidad valida para el producto <b>"' . $product['productName'] . '"</b>, la cantidad seleccionada supera el stock.';
                    array_push($errorMessages,$message);
                    continue;
                }

                // Se valida que el producto sea valido para el cliente
                $isValidProductForClient = $productModel->isValidProductForClient($product, $clientId);
                if(!$isValidProductForClient){
                    $message = 'El producto seleccionado <b>"' . $product['productName'] . '"</b> es invalido.';
                    array_push($errorMessages,$message);
                    continue;
                }

                // se crea el order detail
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product['productId'];
                $orderDetail->quantity = $product['productQuantity'];
                $orderDetail->save();

                // se actualiza el stock del producto
                $updatedProductStock = $productModel->updateProductStock($product);
            }
        }

        // se valida que se hallan escogido productos
        $hasSelectedProducts = ($selectedProducts > 0)?true:false;
        if(!$hasSelectedProducts){
            $message = 'No se ha seleccionado ningun producto. Por favor seleccione al menos un producto.';
            array_push($errorMessages,$message);
        }

        // dump(__FILE__, $errorMessages);

        $success = (count($errorMessages) === 0)?true:false;

        // si pasan las validaciones se hace el commit
        if($success){
            DB::commit();
        } else {
            DB::rollBack();
        }

        $data = [
            'success' => $success,
            'errorMessages' => $errorMessages,
            'orderId' => $order->id
        ];

        return $data;
    }

    public function show($orderId)
    {
        $data = [];

        $order = self::select([
            'orders.id as orderId',
            'clients.name as clientName'
        ])
        ->join('clients','orders.client_id','=','clients.id')
        ->where('orders.id',$orderId)
        ->first();

        $orderDetails = OrderDetail::select([
            'products.id as productId',
            'products.name as productName',
            'order_details.quantity as productQuantity',
        ])
        ->join('products','order_details.product_id','=','products.id')
        ->where('order_details.order_id', $orderId)
        ->get();

        $data['order'] = $order;
        $data['orderDetails'] = $orderDetails;

        return $data;
    }
}
