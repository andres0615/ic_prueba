<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        $model = new Client();

        $data = $model->getAll();

        return response()->json($data);
    }
}
