<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVacancyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vacancy', function (Blueprint $table) {
            $table->bigInteger('vacancy_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->primary(['vacancy_id', 'user_id']);
            $table->timestamps();

        });

        Schema::table('user_vacancy', function (Blueprint $table) {
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vacancy');
    }
}
