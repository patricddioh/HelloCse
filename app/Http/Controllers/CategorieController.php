<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Enums\CategorieStatut;
use Illuminate\Database\Eloquent\Builder;
use App\Services\SuccessMessageService;

class CategorieController
{

    public function __construct (
        protected SuccessMessageService $successMessage
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        $pdts_categories = Categorie::withCount(['produits' => function (Builder $query) {
                                $query->where('statut', 'en ligne');
                            }])->get();

        return view('categories.index', [
            'categories' => $categories,
            'pdts_categories' => $pdts_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'nom' => 'required|max:255',
        'image' => '',
        'statut' => 'required',
        ]);
        //upload image
        $image = $request->file('image');
        $image->storeAs('categories', $image->hashName());

        //create categorie
        Categorie::create([
            'image' => $image->hashName(),
            'nom' => $request->nom,
            'statut' => $request->enum('statut', CategorieStatut::class)
        ]);

        return redirect()->route('categories.index')->with('success', $this->successMessage->success()); 
    }

    /**
     * show
     */
    public function show(String $id)
    {
        $categorie = Categorie::findOrFail($id);
        $nb_pdts_lignes = $categorie->loadCount(['produits' => function (Builder $query) {
                        $query->where('statut', 'en ligne');
                    }]);
        return view('categories.show',  [
            'categorie' => $categorie,
            'nb_pdts_lignes' => $nb_pdts_lignes
        ]);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(String $id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('categories.edit', compact('categorie'));
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
            'statut' => 'required'
        ]);

        $categorie = Categorie::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

			//delete old image
            Storage::delete('categories/'.$categorie->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('categories', $image->hashName());

            //update categorie with new image
            $categorie->update([
                'image' => $image->hashName(),
                'nom' => $request->nom,
                'statut' => $request->enum('statut', CategorieStatut::class)
            ]);

        } else {

            //update categorie without image
            $categorie->update([
                'image' => $image->hashName(),
                'nom' => $request->nom,
                'statut' => $request->enum('statut', CategorieStatut::class)
            ]);
        }

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Categorie mis à jour !']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $categorie = Categorie::findOrFail($id);

        //delete image
        Storage::delete('categories/'. $categorie->image);

        //delete categorie
        $categorie->delete();

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Categorie supprimé !']);
    }
}
