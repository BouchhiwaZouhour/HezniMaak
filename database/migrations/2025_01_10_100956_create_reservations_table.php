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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Clé étrangère vers clients
            $table->unsignedBigInteger('chauffeur_id')->nullable(); // Clé étrangère vers chauffeurs
            $table->date('date_res'); // Date de la réservation
            $table->time('heure_res'); // Heure de la réservation
            $table->string('adresse_dep'); // Adresse de départ
            $table->string('adresse_arr'); // Adresse d'arrivée
            $table->string('statut')->default('en attente'); // Statut de la réservation
            $table->decimal('prix_res', 8, 2)->nullable(); 
            $table->unsignedBigInteger('taxi_id')->nullable(); // Ajouter taxi_id
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chauffeur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('taxi_id')->references('id')->on('taxis')->onDelete('cascade'); // Clé étrangère

    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
