<?php

namespace App\Http\Controllers;
use App\Models\Taxi;
use Illuminate\Http\Request;

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
    // Validation des données du formulaire
    $validated = $request->validate([
        'matricule' => 'required|string|unique:taxis,matricule,' . $id,
        'modele' => 'required|string',
        'adresse' => 'required|string',
        'prix_par_metre' => 'required|numeric',
        'disponible' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Récupérer le taxi
    $taxi = Taxi::findOrFail($id);

    // Gérer l'upload de l'image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($taxi->image && Storage::disk('public')->exists($taxi->image)) {
            Storage::disk('public')->delete($taxi->image);
        }

        // Stocker la nouvelle image
        $imagePath = $request->file('image')->store('taxis', 'public');
        $taxi->image = $imagePath;
    }

    // Mettre à jour les autres champs
    $taxi->update($validated);

    // Rediriger avec un message de succès
    return redirect()->route('chauffeur.dashbord')->with('status', 'Taxi mis à jour avec succès.');
}


public function destroy($id)
    {
    $taxi = Taxi::findOrFail($id);
    $taxi->delete();

    return redirect()->route('chauffeur.dashbord')->with('status', 'Taxi supprimé avec succès.');
    }
}