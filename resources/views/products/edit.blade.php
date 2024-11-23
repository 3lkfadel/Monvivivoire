@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Modifier le produit : {{ $product->name }}</h1>

    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Prix (FCFA)</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="category">Catégorie</label>
            <select id="category" name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection
