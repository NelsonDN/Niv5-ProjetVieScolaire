<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('eleve_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('justifier')->default('0')->nullable();
            $table->string('commentaires')->nullable();
            $table->datetime('date_seance');
            $table->foreignId('typedecour_id')->unsigned()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
