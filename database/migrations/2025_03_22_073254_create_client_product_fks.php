<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProductFks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_product', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
            ->restrictOnUpdate()
            ->restrictOnDelete();

            $table->foreign('product_id')->references('id')->on('products')
            ->restrictOnUpdate()
            ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_product', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['product_id']);
        });
    }
}
