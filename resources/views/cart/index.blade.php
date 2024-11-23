@extends('layouts.app2')

@section('content')

<h1>Votre Panier</h1>

@if ($cart && $cart->items->count() > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }} FCFA</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->quantity * $item->product->price }} FCFA</td>
                    <td>
                        <a href="{{ route('cart.remove', $item->product->id) }}" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total : {{ $cart->items->sum(fn($item) => $item->quantity * $item->product->price) }} FCFA</h3>
@else
    <p>Votre panier est vide.</p>
@endif

@endsection
