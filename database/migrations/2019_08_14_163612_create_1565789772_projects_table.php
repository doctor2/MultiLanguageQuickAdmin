<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1565789772ProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('year')->nullable();
                $table->integer('order')->nullable();
                $table->tinyInteger('active')->nullable()->default('1');

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });

            Schema::create('project_translations', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('project_id')->unsigned();
                $table->string('locale')->index();

                $table->string('title');
                $table->text('additional');
                $table->json('additional_multi');

                $table->unique(['project_id','locale']);

                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_translations');
    }
}
