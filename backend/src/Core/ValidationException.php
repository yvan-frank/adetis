<?php

namespace App\Core;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(private readonly array $errors, string $message = 'Validation échouée')
    {
        parent::__construct($message);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
