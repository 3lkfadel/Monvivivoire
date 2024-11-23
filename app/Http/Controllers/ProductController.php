<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les catégories pour le filtre
        $categories = Category::all();

        // Récupérer les produits en fonction des filtres
        $products = Product::query();

        // Filtrer par catégorie
        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        // Filtrer par prix (par exemple, prix croissant ou décroissant)
        if ($request->filled('price')) {
            $products->orderBy('price', $request->price);
        }

        // Filtrer par localisation (optionnel, selon la structure des produits)
        if ($request->filled('location')) {
            $products->where('location', 'like', '%' . $request->location . '%');
        }

        // Filtrer par mot-clé (moteur de recherche)
        if ($request->filled('search')) {
            $products->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Récupérer les produits avec pagination
        $products = $products->paginate(10);

        // Retourner la vue avec les produits et catégories
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Obtenir la localisation de l'utilisateur connecté
        $user = Auth::user(); // Utilisation correcte d'Auth
        $location = $user->location; // Accès à la localisation de l'utilisateur

        // Créer le produit en incluant la localisation
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
            'location' => $location,  // Ajout de la localisation
        ]);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès');
    }

    public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

public function getProductsByLocation($location)
{
    // Récupère tous les produits correspondant à une localisation donnée
    $products = Product::where('location', $location)->get();

    return response()->json($products);
}

}
