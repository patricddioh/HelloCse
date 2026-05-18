<?php

namespace App\Enums;

enum ProduitStatut: string
{
    case ONLINE = 'en ligne';
    case DRAFT = 'brouillon';
    case DESACTIVED = 'désactivée';
}