<?php

declare(strict_types=1);

namespace App\Actions;

final class FormatGithubPRAction
{
    public function __invoke(): string
    {
        $messages = $this->messages();

        return $this->buildComment($messages);
    }

    private function buildComment(array $messages): string
    {
        return collect($messages)
            ->map(fn(string $message) => "- {$message}")
            ->join('\n');
    }

    private function messages(): array
    {
        return [
            'Opening brace must be the last content on the line',
            'Closing brace must be on a line by itself',
            'Each PHP statement must be on a line by itself',
        ];
    }
}
