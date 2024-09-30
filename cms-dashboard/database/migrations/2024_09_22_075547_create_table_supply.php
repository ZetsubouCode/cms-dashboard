<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableSupply extends Migration
{
    public function up()
    {
        Schema::create('supply', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1000);
            $table->integer('price_per_unit');
            $table->date('date_aquired');
            $table->text('description')->nullable();
            $table->string('unit_of_measurement', 100);
            $table->decimal('quantity', 10, 2);
            $table->string('location', 100)->nullable();
            $table->string('supplier_name', 200)->nullable();
            $table->enum('status', ['IN STOCK', 'LOW STOCK', 'OUT OF STOCK', 'PRE-ORDER', 'DISCONTINUED'])->default('IN STOCK');
            $table->decimal('low_stock_percentage', 5, 2)->default(10);
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('supply');
    }
}

