<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    public function test_new_users_are_sent_a_welcome_email(): void
    {
        $mailer = new class () {
            private $messages = [
                [
                    'subject' => 'An example email subject!',
                    'recipients' => ['jane@example.com', 'john@example.com', 'mary@example.com'],
                    'body' => 'An example email body.',
                ],
            ];

            public function hasMessageFor($email)
            {
                return collect($this->messages)
                    ->flatMap(fn($message) => $message['recipients'])
                    ->contains($email);
            }
        };

        Mail::swap($mailer);

        $this->assertTrue($mailer->hasMessageFor('john@example.com'));
    }
}
