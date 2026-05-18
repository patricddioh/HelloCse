@include('header')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('welcome') }}" class="btn btn-md btn-success mb-3">Retour à l'accueil</a>
                        <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3">Ajouter un categorie</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">NOM</th>
                                    <th scope="col">STATUT</th>
                                    <th scope="col">NB DE PRODUITS EN LIGNE</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $categorie)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/categories/'.$categorie->image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $categorie->nom }}</td>
                                        <td>{{ $categorie->statut }}</td>
                                        <td> Nombre de produits en ligne : 
                                            {{ 
                                                $pdts_categories[0]->produits_count
                                            }}
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                                                <a href="{{ route('categories.show', $categorie->id) }}" class="btn btn-sm btn-dark">Afficher</a>
                                                <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data categories belum ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('footer')>