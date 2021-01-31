<?php

namespace Bmatovu\ArtisanGui\Tests;

/**
 * @see \Bmatovu\ArtisanGui\Http\CommandController
 */
class CommandControllerTest extends TestCase
{
    public function test_gets_artisan_commands()
    {
        $jsonResponse = $this->json('GET', '/commands');

        $jsonResponse->assertJsonStructure([
            'namespaces' => [
                '*' => [],
            ],
            'definition' => [
                'arguments' => [
                    '*' => [
                        'name',
                        'is_required',
                        'is_array',
                        'description',
                        'value',
                    ],
                ],
                'options' => [
                    '*' => [
                        'name',
                        'shortcut',
                        'is_flag',
                        'is_required',
                        'is_array',
                        'description',
                        'value',
                    ],
                ],
            ],
            'commands' => [
                '*' => [
                    'name',
                    'synopsis',
                    'description',
                    'help',
                    'arguments',
                    'options',
                    'hidden',
                ],
            ],
        ]);
    }

    public function test_cant_execute_unknown_artisan_command()
    {
        $jsonResponse = $this->json('POST', '/commands/command:name');

        $jsonResponse->assertStatus(404);

        $jsonResponse->assertJsonStructure([
            'message',
        ]);
    }

    public function test_validates_artisan_command()
    {
        $jsonResponse = $this->json('POST', '/commands/help');

        $jsonResponse->assertStatus(422);

        $jsonResponse->assertJsonStructure([
            'message',
            'errors' => [
                '--format' => [],
            ],
        ]);
    }

    public function test_can_execute_artisan_command()
    {
        $jsonResponse = $this->json('POST', '/commands/help', [
            '--format' => 'txt',
        ]);

        $jsonResponse->assertSuccessful();

        $jsonResponse->assertJsonStructure([
            'command',
            'parameters',
            'exit-code',
            'output',
        ]);
    }
}
