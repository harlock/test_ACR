<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_authors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("image_id")->unsigned();
            $table->foreign("image_id")
                ->references("id")
                ->on("images");
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
        Schema::dropIfExists('image_autors');
    }
}
