<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DecBinController extends Controller
{
    public function __invoke()
    {
        $bin = '11010';

        $dec = collect(str_split($bin))
            ->reverse()
            ->values()
            ->map(fn($char, $key) => $char * pow(2, $key))
            ->sum();

        return $dec;
    }
}
