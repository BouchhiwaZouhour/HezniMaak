<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxi extends Model {

    protected $fillable = ['matricule', 'modele', 'adresse', 'prix_par_metre', 'chauffeur_id', 'taxi_id', 'disponible', 'image'];

    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }
    public function reservations()
    {
    return $this->hasMany(Reservation::class,'taxi_id');
    }
}
