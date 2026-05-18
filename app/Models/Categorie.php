<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\CategorieStatut;
use App\Models\Produit;

class Categorie extends Model
{

    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'image',
        'statut'
    ];

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'statut' => CategorieStatut::class,
        ];
    }
}
