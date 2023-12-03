<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GitHubScore
{
    public function __construct(private string $username)
    {
    }

    public static function forUser($username)
    {
        return (new self($username))->score();
    }

    private function score(): int
    {
        return $this
            ->events()
            ->map(fn($event) => $this->lookupScore($event['type']))
            ->sum();
    }

    private static function lookupScore(string $eventType): int
    {
        return match($eventType) {
            'PushEvent' => 5,
            'CreateEvent' => 4,
            'IssuesEvent' => 3,
            'CommitCommentEvent' => 2,
            default => 1
        };
    }

    private function events(): Collection
    {
        return Http::get("https://api.github.com/users/{$this->username}/events")
            ->collect();
    }
}
