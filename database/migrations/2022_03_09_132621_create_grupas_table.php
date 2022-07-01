<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupa', function (Blueprint $table) {
	    $table->id();
	    $table->string('naziv')->nullable();
	    $table->date('pocetak_obuke');
	    $table->date('kraj_obuke');
	    $table->date('datum_polaganja');
	    $table->integer('ukupno_bodova');
	    $table->integer('bodova_za_prolaz');
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
        Schema::dropIfExists('grupa');
    }
}
