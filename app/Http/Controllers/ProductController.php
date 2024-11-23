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

        // Initialiser la requête pour les produits
        $products = Product::query();

        // Filtrer par catégorie
        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        // Filtrer par prix (croissant ou décroissant)
        if ($request->filled('price')) {
            $products->orderBy('price', $request->price);
        }

        // Filtrer par localisation
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Règle pour l'image
        ]);


        $user = Auth::user();
        $location = $user->location;

        // Gérer l'image
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
            'location' => $location,
            'image' => $imagePath, // Stocker le chemin de l'image
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
