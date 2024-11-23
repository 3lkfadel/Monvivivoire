@extends('layouts.app2')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tous les produits</h1>

        <!-- Formulaire de filtre -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Recherche par mot-clé -->
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Recherche..." value="{{ request('search') }}">
                </div>

                <!-- Filtre par catégorie -->
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">Catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre par prix -->
                <div class="col-md-3">
                    <select name="price" class="form-control">
                        <option value="">Trier par prix</option>
                        <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="desc" {{ request('price') == 'desc' ? 'selected' : '' }}>Prix décroissant</option>
                    </select>
                </div>

                <!-- Filtre par localisation -->
                <div class="col-md-3">
                    <input type="text" name="location" class="form-control" placeholder="Localisation" value="{{ request('location') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <!-- Liste des produits -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>{{ $product->price }} FCFA</strong></p>
                            <p class="card-text"><small class="text-muted">{{ $product->location }}</small></p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Voir le produit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $products->links() }}
    </div>
@endsection
