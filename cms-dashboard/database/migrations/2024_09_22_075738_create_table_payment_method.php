<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTable extends Migration
{
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 2000)->nullable();
            $table->enum('status', ['AVAILABLE', 'NOT AVAILABLE'])->default('NOT AVAILABLE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}
