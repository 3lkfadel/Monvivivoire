<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
Route::post('/chat', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Gestion des catégories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::resource('categories', CategoryController::class);

// Gestion des produits
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/panier/supprimer/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::post('/chat/conversation/{userId}', [ChatController::class, 'createConversation'])->name('chat.create');
Route::get('/chat/conversation/{conversationId}', [ChatController::class, 'showConversation'])->name('chat.show');
Route::post('/chat/conversation/{conversationId}/message', [ChatController::class, 'sendMessage'])->name('chat.send');


Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');



Route::get('products/location/{location}', [ProductController::class, 'getProductsByLocation']);




Route::post('/chat', function (Request $request) {
    $client = new Client();

    // Envoie une requête à l'API OpenAI
    $response = $client->post('https://api.openai.com/v1/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ],
        'json' => [
            'model' => 'text-davinci-003',
            'prompt' => "Réponds comme un assistant intelligent à : " . $request->input('message'),
            'max_tokens' => 150,
            'temperature' => 0.7,
        ],
    ]);

    // Retourne la réponse sous forme JSON
    return response()->json(json_decode($response->getBody(), true));
});
