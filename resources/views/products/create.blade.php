@extends('layouts.app2')

@section('content')
<div class="container">
    <h1>Créer un nouveau produit</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Prix (FCFA)</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="category">Catégorie</label>
            <select id="category" name="category_id" class="form-control" required>
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
