<?php

declare(strict_types=1);

namespace App\DTO;

final readonly class Contact
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $occupation,
    ) {
    }
}
