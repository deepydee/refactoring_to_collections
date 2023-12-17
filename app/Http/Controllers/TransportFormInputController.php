<?php

namespace App\Http\Controllers;

use App\DTO\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TransportFormInputController extends Controller
{
    public function __invoke()
    {
        Collection::macro('transpose', function () {
            $items = array_map(fn(...$items) => $items, ...$this->values());

            return new static($items);
        });

        $request = collect([
            'names' => [
                'Jane',
                'Bob',
                'Mary',
            ],
            'emails' => [
                'jane@example.com',
                'bob@example.com',
                'mary@example.com',
            ],
            'occupations' => [
                'Doctor',
                'Plumber',
                'Dentist',
            ],
        ]);

        $contacts = [
            'names' => [
                'Jane',
                'Bob',
                'Mary',
            ],
            'emails' => [
                'jane@example.com',
                'bob@example.com',
                'mary@example.com',
            ],
            'occupations' => [
                'Doctor',
                'Plumber',
                'Dentist',
            ],
        ];

        $transposed = array_map(function(...$items) {
            return $items;
        }, ...array_values($contacts));

        $contacts = $request
            ->transpose()
            ->map(fn (array $items) => new Contact(...$items));

    }
}
