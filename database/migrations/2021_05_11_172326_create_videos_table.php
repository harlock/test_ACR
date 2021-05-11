<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("video");
            $table->string("description");
            $table->bigInteger("position");
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger("proyects_id")->unasigned();
            $table->foreign("projects_id")
                ->references("id")
                ->on("proyect");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
