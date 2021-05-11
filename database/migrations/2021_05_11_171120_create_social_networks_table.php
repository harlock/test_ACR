<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_networks', function (Blueprint $table) {
            $table->id();
            $table->string("address");
            $table->bigInteger("ally_id")->unsigned();
            $table->foreign("ally_id")
                ->references("id")
                ->on("allies");
            $table->bigInteger("social_network_type_id")->unsigned();
            $table->foreign("social_network_type_id")
                ->references("id")
                ->on("social_network_types");
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
        Schema::dropIfExists('social_networks');
    }
}
