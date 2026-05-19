<?php

namespace App\Services;

class SuccessMessageService
{

    public function __construct(
        protected $message = 'Categorie crée avec succès !'
        )
    {
    }

    public function success()
    {
        return $this->message;

    }
}