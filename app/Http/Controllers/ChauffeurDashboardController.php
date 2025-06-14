<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Taxi;

class ChauffeurDashboardController extends Controller
{
    public function index(Request $request)
    {// Récupérer l'utilisateur connecté (chauffeur)
        $chauffeur = auth()->user();

        // Obtenir les taxis liés au chauffeur connecté
        $taxis = $chauffeur->taxis;

         // Charger les réservations associées aux taxis
        $reservations = Reservation::whereIn('taxi_id', $taxis->pluck('id'))->get();


        // Vérifier si une mise à jour du statut est envoyée
        if ($request->isMethod('post')) {
            $request->validate([
                'statut' => 'required|string|in:disponible,non disponible',
            ]);

            // Mettre à jour le statut
            $chauffeur->update([
                'statut' => $request->input('statut'),
            ]);

            // Message flash de succès
            return redirect()->route('chauffeur.dashbord')->with('status', 'Statut mis à jour avec succès.');
        }

        // Passer les informations nécessaires à la vue (chauffeur et taxis)
        return view('chauffeur.dashbord', compact('chauffeur', 'taxis','reservations'));
    }
    public function showDashboard()
    {
     // Récupérer un taxi spécifique
     $taxi = Taxi::find($taxiId);

     // Vérifier si le taxi existe
     if (!$taxi) {
         return redirect()->route('welcome')->with('error', 'Taxi introuvable.');
     }
 
     // Charger les réservations associées
     $reservations = $taxi->reservations;
 
     // Passer les données à la vue
     return view('chauffeur.dashbord', compact('taxi', 'reservations'));
    }
   public function updateStatus(Request $request)
    {
        $chauffeur = Auth::user();
    
        if ($chauffeur->role !== 'chauffeur') {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    
        $request->validate(['disponible' => 'required|boolean']);
    
        $chauffeur->update(['disponible' => $request->disponible]);
    
        return redirect()->route('chauffeur.dashboard')->with('success', 'Statut mis à jour avec succès.');
    }
    
}
