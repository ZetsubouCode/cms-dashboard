<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product');
            $table->foreignId('order_id')->constrained('order');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
