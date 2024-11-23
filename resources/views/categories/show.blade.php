@extends('layouts.app2')

@section('title', 'Détails de la catégorie')

@section('content')
    <div class="container">
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
@endsection
