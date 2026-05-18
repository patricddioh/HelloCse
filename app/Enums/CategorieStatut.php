<?php

namespace App\Enums;

enum CategorieStatut: string
{
    case ONLINE = 'en ligne';
    case DESACTIVED = 'désactivée';
    case ARCHIVED = 'archivée';
}