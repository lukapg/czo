<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZaposlenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zaposleni', function (Blueprint $table) {
            $table->id();
            $table->string('ime');
	    $table->string('prezime');
	    $table->string('telefon')->nullable();
	    $table->string('email')->nullable();
	    $table->string('adresa')->nullable();
            $table->unsignedBigInteger('sektor_id');
	    $table->unsignedBigInteger('sluzba_id');
            $table->boolean('pripada_regionu')->default(1);
            $table->unsignedBigInteger('region_id')->nullable();
	    $table->string('radno_mjesto');
	    $table->string('mjesto_rada')->nullable();
	    $table->boolean('zastita_na_radu')->default(false);
	    $table->boolean('organizacija_smjestaja')->default(false);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('zaposleni');
    }
}
