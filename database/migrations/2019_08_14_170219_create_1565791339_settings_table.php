<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1565791339SettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key')->nullable();
                $table->integer('order')->nullable();
                $table->text('description')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });

            Schema::create('setting_translations', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('setting_id')->unsigned();
                $table->string('locale')->index();

                $table->string('name', 500);

                $table->unique(['setting_id','locale'], 'setting__locale');

                $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
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
        Schema::dropIfExists('settings');
        Schema::dropIfExists('setting_translations');
    }
}
