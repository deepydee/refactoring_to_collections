<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BuildingLookupTableController extends Controller
{
    public function __invoke()
    {
        /*
        We need to get an array like this
            $emailLookup = [
                'john@example.com' => 'John',
                'jane@example.com' => 'Jane',
                'dave@example.com' => 'Dave',
            ]
        */

        Collection::macro('toAssoc', function () {
            return $this->reduce(function ($assoc, $keyValuePair) {
                $key = key($keyValuePair);
                $value = current($keyValuePair);

                $assoc[$key] = $value;

                return $assoc;
            }, new static);
        });

        Collection::macro('mapToAssoc', function ($callback) {
            return $this->map($callback)->toAssoc();
        });

        $employees = [
            [
                'name' => 'John',
                'department' => 'Sales',
                'email' => 'john@example.com'
            ],
            [
                'name' => 'Jane',
                'department' => 'Marketing',
                'email' => 'jane@example.com'
            ],
            [
                'name' => 'Dave',
                'department' => 'Marketing',
                'email' => 'dave@example.com'
            ],
        ];

        // $emailLookup = collect($employees)
        //     ->map(fn($employee) => [$employee['email'] => $employee['name']])
        //     ->toAssoc();

        $emailLookup = collect($employees)
            ->mapToAssoc(fn($employee) => [$employee['email'] => $employee['name']]);
    }
}
