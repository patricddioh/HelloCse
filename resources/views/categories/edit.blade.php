@include('header')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('categories.update', $categorie->id) }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">IMAGE</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" {{ old('image', $categorie->image) }}>
                            
                                <!-- error message untuk image -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NOM</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom', $categorie->nom) }}" placeholder="Nom du categorie">
                            
                                <!-- error message untuk nom -->
                                @error('nom')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Statut</label>
                                        <select name="statut" class="form-control @error('statut') is-invalid @enderror" placeholder="Statut de la catgorie">
                                            @foreach(App\Enums\CategorieStatut::cases() as $statut)
                                                <option value="{{ $statut->value }}" @selected(old('statut', $categorie->statut->value) == $statut->value)>
                                                    {{ $statut->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    
                                        <!-- error message untuk statut -->
                                        @error('statut')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">Modidier</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('footer')