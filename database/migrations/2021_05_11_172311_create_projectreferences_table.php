<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectreferences', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->bigInteger("project_id")->unsigned();
            $table->foreign("project_id")
                ->references("id")
                ->on("projects");
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
        Schema::dropIfExists('projectreferences');
    }
}
