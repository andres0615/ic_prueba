<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($clientId)
    {
        $productModel = new Product();

        $data = $productModel->getAll($clientId);

        return response()->json($data);
    }
}
