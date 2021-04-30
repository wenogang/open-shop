<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use App\Mail\AjoutProduit;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use App\Exports\ProduitsExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\NouveauProduit;
use App\Http\Requests\ProduitFormRequest;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'])->except(['index','show']);
    }

    public function index()
    {
        $produits = Produit::orderByDesc('id')->paginate(15);
        return view('front-office.produit.index', ['produits' => $produits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produit=New Produit;
        $categories = Category::all();
        return view('front-office.produit.create', [
            'categories' => $categories,
            'produit' => $produit
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitFormRequest $request)
    {
    


        $imageName = "produit.png";
        if($request->file("image")){
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/produits', $imageName);
        }
        $produit=Produit::create([
            'designation' => $request->designation,
            'prix' => $request->prix,
            'category_id' => $request->category_id,
            'quantite' => $request->quantite,
            'description' => $request->description,
            'image' =>$imageName,
        ]);
        $user = User::first();
        $users = User::all();
        Mail::to($user)->send(new AjoutProduit($produit));
        return redirect()->route('produits.show', $produit)->with('statut', 'Votre nouveau produit a été bien ajouter');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        
        return view('front-office.produit.show', compact('produit'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        $categories = Category::all();
      return view('front-office.produit.edit', [
          'produit' => $produit, 
          'categories' => $categories
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProduitFormRequest $request, $id)
    {
        
        $imageName = "produit.png";
        if($request->file("image")){
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/produits', $imageName);
        }
        $produit = Produit::create([
        'designation'=> $request->designation,
        'prix'=> $request->prix,
        'quantite'=> $request->quantite,
        'description'=> $request->description,
        'category_id'=> $request->category_id,
        'image' =>$imageName,

        ]);
        $user =User::first();
        $produit = Produit::orderByDesc('id')->first();
        $user->notify(new NouveauProduit($produit));
        
        return redirect()->route('produits.show', $id)->with('statut', 'Votre nouveau produit a été bien ajouter');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::destroy($id);
        return redirect()->route('produits.index')->with('statut', 'Votre produit a bien été supprimé !');
    }
    public function export()
    {
        //dd('excel');
      return Excel::download(new ProduitsExport, 'produits.xlsx');
    }
}
