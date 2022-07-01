<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zaposleni_id');
            $table->date('datum_polaganja');
            $table->unsignedBigInteger('rezultat_id');
            $table->decimal('ocjena_teorija_osvojeno', 10, 2);
	    $table->unsignedBigInteger('prakticna_ocjena_id');
            $table->text('komentar')->nullable();
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
        Schema::dropIfExists('test');
    }
}
