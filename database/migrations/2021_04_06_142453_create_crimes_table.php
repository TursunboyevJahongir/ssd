<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('law_id')->nullable();
            $table->unsignedBigInteger('prisoner_id')->nullable();
            $table->timestamps();

            $table->foreign('prisoner_id')->references('id')->on('prisoners')->cascadeOnDelete()->cascadeOnDelete();
            $table->foreign('law_id')->references('id')->on('laws');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crimes');
    }
}
