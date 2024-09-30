<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategory extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 400);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category');
    }
}

