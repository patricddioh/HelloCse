<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categorie>
 */
class CategorieFactory extends Factory
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
            'statut' => fake()->randomElement(array('en ligne','désactivée','archivée')),
            'image' => fake()->image(storage_path( path:'app/public/categories'), 360, 360, 'animals', true)
        ];
    }
}
