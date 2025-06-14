<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'telephone', 'statut', 'taxi_id', 'role', 'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec Taxi (1..n, seulement pour chauffeurs)
    public function taxis()
    {
        //return $this->belongsTo(Taxi::class, 'chauffeur_id');
        return $this->hasMany(Taxi::class,'chauffeur_id');

    }

    // Relation avec Reservations (1..n, seulement pour clients)
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }
    
    // Fonction qui permet de vérifier si la personne est un chauffeur
    public function isChauffeur()
    {
        return $this->role === 'chauffeur';
    }

    // Fonction qui permet de vérifier si la personne est un client
    public function isClient()
    {
        return $this->role === 'client';
    }
  
    // Les réservations effectuées en tant que client
public function reservationsAsClient()
{
    return $this->hasMany(Reservation::class, 'client_id');
}

// Les réservations prises en charge en tant que chauffeur
public function reservationsAsChauffeur()
{
    return $this->hasMany(Reservation::class, 'chauffeur_id');
}
}
