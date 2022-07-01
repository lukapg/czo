<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredavacVrstaObukesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predavac_vrsta_obuke', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('predavac_id');
            $table->unsignedBigInteger('vrsta_obuke_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predavac_vrsta_obuke');
    }
}
