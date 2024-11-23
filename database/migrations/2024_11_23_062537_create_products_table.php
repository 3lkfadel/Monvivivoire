<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nom du produit
            $table->text('description');     // Description
            $table->decimal('price', 8, 2);  // Prix
            $table->string('location');      // Localisation (hérité du vendeur)
            $table->unsignedBigInteger('category_id'); // Clé étrangère vers la catégorie
            $table->unsignedBigInteger('user_id');     // Clé étrangère vers le vendeur
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
