<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_awards', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->bigInteger("project_id")->unsigned();
            $table->foreign("project_id")
                ->references("id")
                ->on("projects");
            $table->bigInteger("award_id")->unsigned();
            $table->foreign("award_id")
                ->references("id")
                ->on("awards");
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
        Schema::dropIfExists('project_awards');
    }
}
