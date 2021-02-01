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
        $jsonResponse = $this->json('POST', '/commands/unknown');

        $jsonResponse->assertStatus(404);

        $jsonResponse->assertJsonStructure([
            'message',
        ]);
    }

    public function test_validates_artisan_command()
    {
        $jsonResponse = $this->json('POST', '/commands/command:dummy');

        $jsonResponse->assertStatus(422);

        $jsonResponse->assertJsonStructure([
            'message',
            'errors' => [
                'arg' => [],
                'array-args' => [],
            ],
        ]);
    }

    public function test_can_execute_commands()
    {
        $this->artisan('command:dummy', [
                'arg' => 'arg',
                'array-args' => ['arg1'],
                '--bool-opt' => true,
                '--value-opt' => 'opt',
                '--array-opts' => ['opt1'],
            ])
            ->expectsOutput('Dummy command ran successful.')
            ->assertExitCode(0);
    }

    public function test_can_execute_artisan_command()
    {
        $jsonResponse = $this->json('POST', '/commands/command:dummy', [
            'arg' => 'arg',
            'array-args' => ['arg1'],
            '--bool-opt' => true,
            '--value-opt' => 'opt',
            '--array-opts' => ['opt1'],
        ]);

        $jsonResponse->assertSuccessful();

        $jsonResponse->assertJson([
            'command' => 'command:dummy',
            'parameters' => ' arg="arg" array-args="arg1" --bool-opt --value-opt="opt" --array-opts="opt1" --no-interaction',
            'exit-code' => 0,
            'output' => 'Dummy command ran successful.'.PHP_EOL,
        ]);
    }

    public function test_can_command_execution_fails_gracefully()
    {
        $jsonResponse = $this->json('POST', '/commands/command:dummy', [
            'arg' => 'exception',
            'array-args' => ['arg1'],
        ]);

        $jsonResponse->assertStatus(500);

        $jsonResponse->assertJson([
            'code' => 0,
            'message' => 'We ran into an exception!',
        ]);
    }
}
