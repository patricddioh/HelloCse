<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\ProduitStatut;
use App\Models\Categorie;

class Produit extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prix',
        'image',
        'statut',
        'categorie_id'
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'statut' => ProduitStatut::class,
        ];
    }
}
