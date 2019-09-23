<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->bigIncrements('id');           
            $table->string('vacancy_name');              
            $table->integer('workers_amount')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable()->unsigned()->index();
            $table->integer('salary')->nullable();
            $table->timestamps();
        });
        Schema::table('vacancies', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

        //     $table->unsignedBigInteger('organizationmy_id')->nullable()->unsigned()->index();
        //     Schema::table('vacancies', function (Blueprint $table) {
        //     $table->foreign('organizationmy_id')->references('id')->on('organizations')->onDelete('cascade');
        // });
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
