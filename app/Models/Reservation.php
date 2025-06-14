<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['client_id', 'chauffeur_id','taxi_id', 'date_res', 'heure_res', 'adresse_dep', 'adresse_arr', 'statut', 'prix'];

    // Relation avec Personne (Client)
    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'taxi_id');
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
    // Relation avec Chauffeur
    public function chauffeur() {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }

}
