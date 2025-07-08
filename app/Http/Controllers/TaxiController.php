<?php

namespace App\Http\Controllers;
use App\Models\Taxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TaxiController extends Controller
{
public function create()
{
        $chauffeurId = auth()->user()->id;

        return view('taxis.ajoutTaxi',compact('chauffeurId')); // Retourner la vue de création de taxi
}
public function store(Request $request)
{
    // Validation des données du formulaire
    $validated = $request->validate([
        'matricule' => 'required|unique:taxis',
        'modele' => 'required|string',
        'adresse' => 'required|string',
        'prix_par_metre' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'disponible' => 'required|boolean', 
    ]);

    // Récupérer l'ID du chauffeur depuis l'utilisateur authentifié
    $chauffeurId = auth()->user()->id;

    // Définir une valeur par défaut pour l'image
    $imagePath = null;

    if ($request->hasFile('image')) {
        // Stocker l'image dans le dossier public
        $imagePath = $request->file('image')->store('taxis', 'public');
    }

    // Enregistrer le taxi dans la base de données
    $taxi = Taxi::create([
        'matricule' => $validated['matricule'],
        'modele' => $validated['modele'],
        'adresse' => $validated['adresse'],
        'prix_par_metre' => $validated['prix_par_metre'],
        'image' => $imagePath,
        'chauffeur_id' => $chauffeurId,
        'disponible' => $validated['disponible'],
    ]);

    // Rediriger avec un message de succès
    return redirect()->route('chauffeur.dashbord')->with('status', 'Taxi ajouté avec succès.');
}

public function edit($id){

    $taxi = Taxi::findOrFail($id);
    return view('taxis.edit', compact('taxi'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'matricule' => 'required|string|unique:taxis,matricule,' . $id,
        'modele' => 'required|string',
        'adresse' => 'required|string',
        'prix_par_metre' => 'required|numeric',
        'disponible' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $taxi = Taxi::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($taxi->image && Storage::disk('public')->exists($taxi->image)) {
            Storage::disk('public')->delete($taxi->image);
        }
        $taxi->image = $request->file('image')->store('taxis', 'public');
    }

    // Mettre à jour les autres champs hors image
    $taxi->matricule = $validated['matricule'];
    $taxi->modele = $validated['modele'];
    $taxi->adresse = $validated['adresse'];
    $taxi->prix_par_metre = $validated['prix_par_metre'];
    $taxi->disponible = $validated['disponible'];

    $taxi->save();

    return redirect()->route('chauffeur.dashbord')->with('status', 'Taxi mis à jour avec succès.');
}


public function destroy($id)
    {
    $taxi = Taxi::findOrFail($id);
    $taxi->delete();
    
    
    if ($taxi->image && Storage::disk('public')->exists($taxi->image)) {
        Storage::disk('public')->delete($taxi->image);
    }
    return redirect()->route('chauffeur.dashbord')->with('status', 'Taxi supprimé avec succès.');
    }

// Ajoutez cette méthode dans TaxiController
/*public function nearby(Request $request)
{
    $request->validate([
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'radius' => 'sometimes|numeric|max:50' // rayon en km
    ]);

    $taxis = Taxi::where('disponible', true)
                ->selectRaw("*, 
                    (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * 
                    cos(radians(longitude) - radians(?)) + 
                    sin(radians(?)) * sin(radians(latitude)))) 
                    AS distance", [
                        $request->lat,
                        $request->lng,
                        $request->lat
                    ])
                ->having('distance', '<', $request->radius ?? 10)
                ->orderBy('distance')
                ->with('chauffeur')
                ->get();

    return response()->json($taxis);
}*/
}
