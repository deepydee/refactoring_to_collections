<?php

namespace App\Http\Controllers;

use App\DTO\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RankingCompetitionController extends Controller
{
    public function __invoke()
    {
        Collection::macro('pipe', fn($callback) => $callback($this));

        $scores = collect([
            ['score' => 76, 'team' => 'A'],
            ['score' => 62, 'team' => 'B'],
            ['score' => 82, 'team' => 'C'],
            ['score' => 86, 'team' => 'D'],
            ['score' => 91, 'team' => 'E'],
            ['score' => 67, 'team' => 'F'],
            ['score' => 67, 'team' => 'G'],
            ['score' => 82, 'team' => 'H'],
        ]);


        return $this->rankScores($scores);
    }

    private function rankScores(Collection $scores): Collection
    {
        return $scores
            ->pipe(fn($scores) => $this->assignInitialRankings($scores))
            ->pipe(fn($rankedScores) => $this->adjustRankingsForTies($rankedScores))
            ->sortBy('rank');
    }

    private function assignInitialRankings(Collection $scores): Collection
    {
        return $scores
            ->sortByDesc('score')
            ->zip(range(1, $scores->count()))
            ->map(function ($scoreAndRank) {
                [$score, $rank] = $scoreAndRank;

                return [...$score, 'rank' => $rank];
            });
    }

    private function adjustRankingsForTies(Collection $scores): Collection
    {
        return $scores
            ->groupBy('score')
            ->map(fn($tiedScores) => $this->applyMinRank($tiedScores))
            ->collapse();
    }

    private function applyMinRank(Collection $tiedScores): Collection
    {
        $lowestRank = $tiedScores->pluck('rank')->min();

        return $tiedScores->map(
            fn($rankedScore) => [...$rankedScore, 'rank' => $lowestRank]
        );
    }
}
