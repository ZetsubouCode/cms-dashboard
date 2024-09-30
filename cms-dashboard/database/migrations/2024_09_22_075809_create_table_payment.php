<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePayment extends Migration
{
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payment_method');
            $table->foreignId('order_id')->constrained('order');
            $table->string('reference_code', 30);
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            $table->timestamp('date_payment')->nullable();
            $table->text('receipt_image_url')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
