<?php

namespace App\Core;

class Validator
{
    private array $errors = [];

    public function required(array $data, string $field, string $label): static
    {
        if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
            $this->errors[$field] = "$label est obligatoire.";
        }

        return $this;
    }

    public function numeric(array $data, string $field, string $label): static
    {
        if (isset($data[$field]) && $data[$field] !== null && !is_numeric($data[$field])) {
            $this->errors[$field] = "$label doit être un nombre.";
        }

        return $this;
    }

    public function min(array $data, string $field, float $min, string $label): static
    {
        if (isset($data[$field]) && $data[$field] !== null && is_numeric($data[$field]) && (float) $data[$field] < $min) {
            $this->errors[$field] = "$label doit être supérieur ou égal à $min.";
        }

        return $this;
    }

    public function email(array $data, string $field, string $label): static
    {
        if (isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "$label doit être une adresse email valide.";
        }

        return $this;
    }

    public function fails(): bool
    {
        return count($this->errors) > 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
