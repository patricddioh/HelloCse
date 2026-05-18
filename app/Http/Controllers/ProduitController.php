<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Enums\ProduitStatut;


class ProduitController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    /**
     * filter by category
     *
     * @param  mixed $id
     * @return View
     */
    public function indexByCategory($id): View
    {
        $categorie = Categorie::findOrfail($id);
        $produits = Produit::whereBelongsTo($categorie, 'id')->get();

        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
        $categories = Categorie::all();
        return view('produits.create', [
            'categories' => $categories,
            'produits' => $produits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
        'nom' => 'required|max:255',
        'prix' => 'required',
        'categorie' => 'required|numeric',
        'image' => '',
        'statut' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('produits', $image->hashName());

        //create product
        Produit::create([
            'image' => $image->hashName(),
            'categorie_id' => $request->categorie,
            'nom' => $request->nom,
            'prix' => $request->prix,
            'statut' => $request->enum('statut', ProduitStatut::class)
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit crée avec succès !'); 
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(String $id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(String $id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();

        return view('produits.edit', [
            'categories' => $categories,
            'produit' => $produit
        ]);
    }

    /**
     * update
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate form
        $request->validate([
        'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        'nom'  => 'required|min:3',
        'categorie' => 'required',
        'prix' => 'required|numeric',
        'statut' => 'required'
        ]);

        $produit = Produit::findOrFail($id);
        $categorie = Categorie::findOrFail($request->categorie);

        //check if image is uploaded
        if ($request->hasFile('image')) {

			//delete old image
            Storage::delete('produits/'.$produit->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('produits', $image->hashName());

            //update product with new image
            $produit->update([
                'image' => $image->hashName(),
                'categorie_id' => $categorie->id,
                'nom' => $request->nom,
                'prix' => $request->prix,
                'statut' => $request->enum('statut', ProduitStatut::class)
            ]);

        } else {

            //update product without image
            $produit->update([
                'nom' => $request->nom,
                'categorie_id' => $categorie->id,
                'prix' => $request->prix,
                'statut' => $request->enum('statut', ProduitStatut::class)
            ]);
        }

        //redirect to index
        return redirect()->route('produits.index')->with(['success' => 'Produit mis à jour !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $produit = Produit::findOrFail($id);

        //delete image
        Storage::delete('produits/'. $produit->image);

        //delete product
        $produit->delete();

        //redirect to index
        return redirect()->route('produits.index')->with(['success' => 'Produit supprimé !']);
    }
}
