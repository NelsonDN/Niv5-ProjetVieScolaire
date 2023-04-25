<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCahierdetextesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cahierdetextes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('contenu');
            $table->string('piece_jointe')->nullable();
            $table->unsignedBigInteger('classe_matiere_id');
            $table->foreign('classe_matiere_id')->references('id')->on('classe_matiere')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('typedecour_id');
            $table->foreign('typedecour_id')->references('id')->on('typedecours')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cahierdetextes');
    }
}
