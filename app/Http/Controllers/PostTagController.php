<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Collection;

class PostTagController
{
    public function index()
    {
        return dd(Post::with('tags')
            ->get()
            ->toArray());
    }

    public function update(Post $post)
    {
        $incomingTags = [
            'tags' => [
                3,
                'recipes',
                2,
                'kuchen',
            ]
        ];

        $tagIds = $this->normalizeTagsToIds($incomingTags['tags']);

        $post->tags()->sync($tagIds);
    }

    private function normalizeTagsToIds(array $tags): Collection
    {
        return collect($tags)
            ->map(fn($nameOrId) => $this->normalizeTagToIds($nameOrId));
    }

    private function normalizeTagToIds(int|string $nameOrId): int
    {
        if (is_numeric($nameOrId)) {
            return $nameOrId;
        }

        return Tag::create(['title' => $nameOrId])->id;
    }
}
