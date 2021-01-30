<?php

namespace Bmatovu\AristanGui\Http;

use Bmatovu\AristanGui\Support\Commander;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommandController
{
    use ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @param Kernel $kernel
     *
     * @return void
     */
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Get artisan commands.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $commander = new Commander($this->kernel);

        return response([
            'namespaces' => $commander->getNamespaces(),
            'definition' => $commander->getDefinition(),
            'commands' => $commander->getCommands(),
        ]);
    }

    /**
     * Execute artisan command.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Illuminate\Http\Response
     */
    public function execute(Request $request)
    {
        $command = $this->resolve($request->command);

        $validated = $this->validate($request, $this->rules($command));

        $parameters = array_merge($validated, config('artisan.options'));

        $outputBuffer = new BufferedOutput();

        try {
            $exitCode = $this->kernel->call($command->getName(), $parameters, $outputBuffer);
            // $output = $this->kernel->output();
            $output = $outputBuffer->fetch();
        } catch (\Exception $exception) {
            $exitCode = $exception->getCode() ?? 500;
            $output = $exception->getMessage();
        }

        return response([
            'command' => $command->getName(),
            'parameters' => $this->flatten($parameters),
            'exit-code' => $exitCode,
            'output' => $output,
        ]);
    }

    /**
     * Flatten command parameters.
     *
     * @param array $parameters
     *
     * @return string
     */
    protected function flatten(array $parameters)
    {
        $cli_params = '';

        foreach ($parameters as $name => $value) {
            if (empty($value)) {
                continue;
            }

            if (strpos($name, '--') === 0) {
                if (is_bool($value)) {
                    $cli_params .= " {$name}";

                    continue;
                }
            }

            if (is_array($value)) {
                // foreach ($value as $item) {
                //   $cli_params .= " {$name}=\"{$item}\"";
                // }

                $items = implode(',', $value);
                $cli_params .= " {$name}=\"{$items}\"";

                continue;
            }

            $cli_params .= " {$name}=\"{$value}\"";
        }

        return $cli_params;
    }

    /**
     * Resolve command from kernel.
     *
     * @param string $name Command name
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\Console\Command\Command
     */
    protected function resolve($name): Command
    {
        $commands = $this->kernel->all();

        $command = $commands[$name] ?? null;

        if (! $command) {
            throw new NotFoundHttpException('Unknown command.');
        }

        return $command;
    }

    /**
     * Build command validation rules.
     *
     * @param \Symfony\Component\Console\Command\Command $command
     *
     * @return array
     */
    protected function rules(Command $command): array
    {
        $rules = [];

        foreach ($command->getDefinition()->getArguments() as $argument) {
            $rules[$argument->getName()] = array_filter([
                $argument->isRequired() ? 'required' : 'nullable',
                $argument->isArray() ? 'array': '',
            ]);
        }

        foreach ($command->getDefinition()->getOptions() as $option) {
            $name = $option->getName();

            $rules["--{$name}"] = array_filter([
                $option->isValueRequired() ? 'required' : 'nullable',
                $option->isArray() ? 'array': ($option->acceptValue() ? 'string' : 'bool'),
            ]);
        }

        return $rules;
    }
}