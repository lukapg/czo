<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempGrupaZaposlenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_grupa_zaposleni', function (Blueprint $table) {
	    $table->id();
	    $table->unsignedBigInteger('grupa_id');
	    $table->unsignedBigInteger('zaposleni_id');
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
        Schema::dropIfExists('temp_grupa_zaposleni');
    }
}
