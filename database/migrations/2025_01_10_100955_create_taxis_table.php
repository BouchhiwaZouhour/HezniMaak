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
        Schema::create('taxis', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('modele');
            $table->string('adresse'); // Adresse d'emplacement
            $table->decimal('prix_par_metre', 8, 2);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('chauffeur_id')->nullable();
            $table->foreign('chauffeur_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('disponible')->default(true);

            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxis');
    }
};
