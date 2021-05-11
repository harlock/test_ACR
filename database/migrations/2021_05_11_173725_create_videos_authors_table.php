<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos_authors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("video_id")->unsigned();
            $table->foreign("video_id")
                ->references("id")
                ->on("videos");
            $table->bigInteger("content_author_id")->unsigned();
            $table->foreign("content_author_id")
                ->references("id")
                ->on("content_authors");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos_authors');
    }
}
