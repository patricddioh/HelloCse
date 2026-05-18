@include('header')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/produits/'.$produit->image) }}" class="rounded" style="width: 600px">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $produit->nom }}</h3>
                        <hr/>
                        <p>{{ "Rp " . number_format($produit->prix,2,',','.') }}</p>
                        <hr/>
                        <p>Statut : {{ $produit->statut }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')