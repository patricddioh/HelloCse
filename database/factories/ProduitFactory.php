<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Categorie;

/**
 * @extends Factory<User>
 */
class ProduitFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->word(),
            'prix' => fake()->randomNumber(6,false),
            'statut' => fake()->randomElement(array('en ligne', 'brouillon', 'désactivée')),
            'image' => fake()->image(storage_path(path:'app/public/produits'), 360, 360, 'animals', true),
            'categorie_id' => Categorie::factory()
        ];
    }

}
