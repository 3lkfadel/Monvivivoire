@extends('layouts.app2')

@section('content')

<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>{{ $product->price }} FCFA</strong></p>
    <p><small class="text-muted">{{ $product->location }}</small></p>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">

    <!-- Ajouter au panier -->
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Ajouter au panier</button>
    </form>

    <!-- Bouton pour contacter le vendeur -->
    <form action="{{ route('message.create', $product->user_id) }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-success mt-3">Écrire au vendeur</button>
    </form>
</div>

@endsection
