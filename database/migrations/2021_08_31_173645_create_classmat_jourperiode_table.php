<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassmatJourperiodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classmat_jourperiode', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classe_matiere_id');
            $table->foreign('classe_matiere_id')->references('id')->on('classe_matiere')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('jour_periode_id');
            $table->foreign('jour_periode_id')->references('id')->on('jour_periode')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('classmat_jourperiode');
    }
}
