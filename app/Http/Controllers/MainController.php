<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function accueil()
   
    {
      // dd(Auth::user());
      $user = User::orderByDesc("id")->first();
      // dd($user->isAdmin());
      $collection1 = collect(['orange', 'Banane', 'Avocat','Mangue']);

      $produits = Produit::all();

      //dd($produits);
      $produitsFiltres = $produits->filter(function ($produit, $key){
        return $produit->prix > 100000 && $produit->prix < 500000;
      });



      $produits = Produit::orderByDesc('id')->take(9)->get(); 

      return view('welcome', ['produits' => $produits]);

    }
    
}
