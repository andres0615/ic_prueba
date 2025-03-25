<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    protected $primaryKey='id';

    public $timestamps = false;

    public function getAll(){
        $clients = Client::all();

        $data = ['clients' => $clients];

        return $data;
    }
}
