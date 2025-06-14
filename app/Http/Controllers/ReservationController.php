<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxi;
class ReservationController extends Controller
{
 
public function store(Request $request)
{
    // Vérifier si l'utilisateur est connecté
    
    if (!Auth::check() || Auth::user()->role !== 'client') {
        return redirect()->route('login')->with('error', 'Vous devez être connecté en tant que client pour réserver.');
    }

    // Vérifier si l'utilisateur est un chauffeur
    if (Auth::user()->role === 'chauffeur') {
        return back()->with('error', 'Un chauffeur ne peut pas effectuer une réservation.');
    }

    $request->validate([
        'taxi_id' => 'required|exists:taxis,id',
        'adresse_dep' => 'required|string|max:255',
        'adresse_arr' => 'required|string|max:255',
        'date_res' => 'required|date',
        'heure_res' => 'required|date_format:H:i',
    ]);

    // Créer la réservation en utilisant l'ID du client authentifié
    Reservation::create([
        'client_id' => Auth::id(),  
        'taxi_id' => $request->taxi_id,
        'chauffeur_id' => Taxi::find($request->taxi_id)->chauffeur_id,
        'adresse_dep' => $request->adresse_dep,
        'adresse_arr' => $request->adresse_arr,
        'date_res' => $request->date_res,
        'heure_res' => $request->heure_res,
        'statut' => 'en attente',
    ]);

    return redirect()->route('welcome')->with('reservation_confirmed', true);
    

}

public function listAvailableTaxis(Request $request)
    {
        // Récupérer l'adresse entrée par l'utilisateur
        $adresseDep = $request->input('adresse_dep');
        $adresseArr = $request->input('adresse_arr');
        $date_res = $request->input('date_res');
        $heure_res = $request->input('heure_res');
        // Rechercher les taxis disponibles
        $taxis = Taxi::where('adresse', 'LIKE', "%{$adresseDep}%")
            ->where('disponible', true)
            ->get();


        // Retourner la vue welcome avec les résultats
        return view('welcome', compact('taxis', 'adresseDep', 'adresseArr', 'date_res', 'heure_res'))
        ->with('adresse_dep', $adresseDep)
        ->with('adresse_arr', $adresseArr); 
        
    }

public function getReservationsByTaxi(Request $request,$taxi_id){
    $reservations=Reservation::where('taxi_id',$taxi_id)->get();

    if($reservations->isEmpty()){
        return redirect()->back()->with('message','aucune reservations pour ce taxi');
    }
    return view('reservations.taxi',compact('reservations', 'taxi_id'));
}

public function getReservationsByChauffeur(Request $request,$chauffeur_id){
    $reservations=Reservation::where('chauffeur_id',$chauffeur_id)->with(['client', 'taxi'])->get();;

    if($reservations->isEmpty()){
        return redirect()->back()->with('message','aucune reservations pour ce chauffeur');
    }
    return view('reservations.chauffeur',compact('reservations', 'chauffeur_id'));
  }
public function getReservationsByClient(Request $request,$client_id)
{
    $reservations=Reservation::where('client_id',$client_id)->with(['chauffeur', 'taxi'])->get();

    if($reservations->isEmpty()){
        return redirect()->back()->with('message','aucune reservations pour ce client');
    }
    return view('reservations.client',compact('reservations', 'client_id'));
}

public function confirmReservation($reservation_id)
{
    // Vérification du rôle de l'utilisateur
    if (Auth::user()->role !== 'chauffeur') {
        return redirect()->back()->with('error', 'Seuls les chauffeurs peuvent confirmer une réservation.');
    }

    // Trouver la réservation associée au chauffeur
    $reservation = Reservation::where('id', $reservation_id)
                              ->where('chauffeur_id', Auth::id())
                              ->firstOrFail();

    // Si la réservation n'existe pas
    if (!$reservation) {
        return redirect()->route('chauffeur.dashbord')->with('error', 'Aucune réservation trouvée.');
    }

    // Mettre à jour le statut de la réservation
    $reservation->update(['statut' => 'confirmee']);

    // Mettre à jour le taxi associé
    $taxi = Taxi::find($reservation->taxi_id);
    if ($taxi) {
        $taxi->update([
            'disponible' => false,  // Le taxi devient indisponible
            'adresse' => $reservation->adresse_arr  // Mettre à jour l'adresse avec l'adresse d'arrivée
        ]);
    }

    // Mettre à jour le statut global du chauffeur (optionnel)
    Auth::user()->update(['statut' => 'non disponible']);

    // Rediriger avec un message de succès
    return redirect()->route('chauffeur.dashbord')->with('success', 'Réservation confirmée avec succès.');
}

public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->delete();

    return redirect()->route('reservations.client', ['client_id' => $reservation->client_id])
        ->with('success', 'Réservation supprimée avec succès.');
}

}
