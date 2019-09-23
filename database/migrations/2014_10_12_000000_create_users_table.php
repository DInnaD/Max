<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name')->default();
            $table->string('country')->default();
            $table->string('city')->default();
            $table->string('phone')->default();
            $table->string('role')->default();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            //$table->integer('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            //$table->softDeletes();
            //user_id has many Thr
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
