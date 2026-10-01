<?php

namespace App\Core;

class Validator
{
    private array $errors = [];

    public function required(array $data, string $field, string $label): static
    {
        if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
            $this->errors[$field] = t('validation.required', ['label' => $label]);
        }

        return $this;
    }

    public function numeric(array $data, string $field, string $label): static
    {
        if (isset($data[$field]) && $data[$field] !== null && !is_numeric($data[$field])) {
            $this->errors[$field] = t('validation.numeric', ['label' => $label]);
        }

        return $this;
    }

    public function min(array $data, string $field, float $min, string $label): static
    {
        if (isset($data[$field]) && $data[$field] !== null && is_numeric($data[$field]) && (float) $data[$field] < $min) {
            $this->errors[$field] = t('validation.min', ['label' => $label, 'min' => $min]);
        }

        return $this;
    }

    public function email(array $data, string $field, string $label): static
    {
        if (isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = t('validation.email', ['label' => $label]);
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
