<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('role');
            $table->string('username', 100);
            $table->string('email', 100);
            $table->string('password', 256);
            $table->text('address')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('phone_number', 16);
            $table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}

