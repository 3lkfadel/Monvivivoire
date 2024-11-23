<?php


// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Ajouter un produit au panier
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $user = Auth::user();

        // Récupérer le panier de l'utilisateur
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Vérifier si l'article existe déjà dans le panier
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Si l'article existe, on augmente la quantité
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Sinon, on ajoute l'article avec quantité 1
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index');
    }

    // Afficher le contenu du panier
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        return view('cart.index', compact('cart'));
    }

    // Supprimer un produit du panier
    public function removeFromCart($productId)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index');
    }
}
