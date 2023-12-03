<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampsAndWalletsController extends Controller
{
    public function __invoke()
    {
        $url = storage_path('json/products.json');
        $productsJson = json_decode(file_get_contents($url), true);
        $products = collect($productsJson['products']);

        $lampsAndWallets = $products
            ->filter(fn($product) => collect(['Lamp', 'Wallet'])->contains($product['product_type']))
            ->flatMap(fn($product) => $product['variants'])
            ->sum('price');

        return 'Sum of lamps and wallets: ' . $lampsAndWallets;
    }
}
