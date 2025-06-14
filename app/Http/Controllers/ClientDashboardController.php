<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retourne la vue avec les données du client
        return view('client.dashbord', compact('user'));

    }
}
