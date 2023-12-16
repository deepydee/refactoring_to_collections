<?php

use App\Http\Controllers\GithubController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/github-score', [GithubController::class, 'score']);
Route::get('/github-pr', [GithubController::class, 'formatPR']);

Route::get('/examples', function () {


    $names = collect(['Adam', 'Tracy', 'Ben', 'Beatrice', 'Kyle']);

    // return $names->first(
    //     fn($name) => $name[0] == 'Z',
    //     fn() => throw new \Exception('No matching name found!')
    // );

    $digits = collect([1, 3, 4, 6]);

    return $digits
        ->ifAny(function($c) use ($digits) {
            return $digits->filter(fn($d) => $d % 2 == 0);
        });
});
