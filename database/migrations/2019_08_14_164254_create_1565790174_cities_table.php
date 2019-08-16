<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1565790174CitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key')->nullable();
                $table->integer('order')->nullable();
                $table->tinyInteger('active')->nullable()->default('1');

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });

            Schema::create('city_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('city_id')->unsigned();
                $table->string('locale')->index();

                $table->string('name', 500);

                $table->unique(['city_id', 'locale'], 'city__locale');

                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_translations');
    }
}
