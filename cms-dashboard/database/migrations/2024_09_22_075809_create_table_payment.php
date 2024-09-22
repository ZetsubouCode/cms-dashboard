<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payment_method');
            $table->foreignId('order_id')->constrained('order');
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            $table->timestamp('date_payment')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
