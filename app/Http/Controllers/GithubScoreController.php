<?php

namespace App\Http\Controllers;

use App\Services\GitHubScore;

class GithubScoreController extends Controller
{
    public function __invoke()
    {
        return GitHubScore::forUser('deepydee');
    }
}
