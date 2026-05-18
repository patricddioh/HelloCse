@include('header')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/categories/'.$categorie->image) }}" class="rounded" style="width: 600px">
                </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>Catégorie : {{ $categorie->nom }}</h3>
                        <hr/>
                        <p>Statut : {{ $categorie->statut }}</p>
                        <hr/>
                        <p>Nombre de produits en ligne : {{ $nb_pdts_lignes->produits_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('footer')