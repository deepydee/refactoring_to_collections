<?php

namespace App\Http\Controllers;

use App\Actions\FormatGithubPRAction;
use App\Services\GitHubScore;

class GithubController extends Controller
{
    public function __construct(private FormatGithubPRAction $formatGithubPRAction)
    {
    }

    public function score()
    {
        return GitHubScore::forUser('deepydee');
    }

    public function formatPR()
    {
        return ($this->formatGithubPRAction)();
    }
}
