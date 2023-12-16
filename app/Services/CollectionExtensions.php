<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\Macroable;

class CollectionExtensions extends ServiceProvider
{
    use Macroable;

    public function boot(): void
    {
        Collection::macro('odd',
            fn() => $this->values()->filter(fn($value, $key) => $key % 2 !== 0)
        );

        Collection::macro('ifEmpty', function ($callback) {
            if ($this->isEmpty()) {
                $callback();
            }

            return $this;
        });

        Collection::macro('ifAny', function ($callback) {
            if ($this->isNotEmpty()) {
                $callback($this);
            }

            return $this;
        });
    }

    public function register(): void
    {

    }
}
