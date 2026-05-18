@include('header')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('welcome') }}" class="btn btn-md btn-success mb-3">Retour à l'accueil</a>
                        <a href="{{ route('produits.create') }}" class="btn btn-md btn-success mb-3">Ajouter un produit</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NOM</th>
                                    <th scope="col">PRIX</th>
                                    <th scope="col">STATUT</th>
                                    <th scope="col">CATEGORIE</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produits as $produit)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/produits/'.$produit->image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $produit->nom }}</td>
                                        <td>{{ "$ " . number_format($produit->prix,2,',','.') }}</td>
                                        <td>{{ $produit->statut }}</td>
                                        <td>{{ $produit->categorie->nom }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                                <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-dark">Afficher</a>
                                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-primary">Modidier</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data produits 
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')