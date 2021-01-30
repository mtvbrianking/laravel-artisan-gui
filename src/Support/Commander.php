<?php

namespace Bmatovu\AristanGui\Support;

use Illuminate\Contracts\Console\Kernel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

/**
 * @see \Symfony\Component\Console\Descriptor\JsonDescriptor
 */
class Commander
{
    const GLOBAL_NAMESPACE = 'laravel';

    private $kernel;
    private $namespace;
    private $namespaces;
    private $commands;
    private $aliases;
    private $definition;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;

        $this->loadApplicationDefinition();

        $this->loadNamespacesAndCommands();
    }

    public function getKernel()
    {
        return $this->kernel;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getNamespaces()
    {
        return $this->namespaces;
    }

    public function getCommands()
    {
        return $this->commands;
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function getDefinition()
    {
        return $this->definition;
    }

    protected function extractNamespace(string $name, int $limit = null)
    {
        $parts = explode(':', $name, -1);

        return implode(':', null === $limit ? $parts : \array_slice($parts, 0, $limit));
    }

    protected function sortCommands(array $commands): array
    {
        $namespacedCommands = [];
        $globalCommands = [];
        $sortedCommands = [];
        foreach ($commands as $name => $command) {
            $key = $this->extractNamespace($name, 1);
            if (\in_array($key, ['', self::GLOBAL_NAMESPACE], true)) {
                $globalCommands[$name] = $command;
            } else {
                $namespacedCommands[$key][$name] = $command;
            }
        }

        if ($globalCommands) {
            ksort($globalCommands);
            $sortedCommands[self::GLOBAL_NAMESPACE] = $globalCommands;
        }

        if ($namespacedCommands) {
            ksort($namespacedCommands);
            foreach ($namespacedCommands as $key => $commandsSet) {
                ksort($commandsSet);
                $sortedCommands[$key] = $commandsSet;
            }
        }

        return $sortedCommands;
    }

    /**
     * @see \Symfony\Component\Console\Descriptor\ApplicationDescription::inspectApplication
     */
    public function loadNamespacesAndCommands()
    {
        $this->commands = [];
        $this->namespaces = [];

        $all = $this->kernel->all($this->namespace);

        foreach ($this->sortCommands($all) as $namespace => $commands) {
            $names = [];

            /** @var Command $command */
            foreach ($commands as $name => $command) {
                // if (!$command->getName() || (!$this->showHidden && $command->isHidden())) {
                if (! $command->getName()) {
                    continue;
                }

                if ($command->getName() === $name) {
                    $this->commands[$name] = $this->getCommandData($command);
                } else {
                    $this->aliases[$name] = $command;
                }

                $names[] = $name;
            }

            // $this->namespaces[$namespace] = ['id' => $namespace, 'commands' => $names];
            $this->namespaces[$namespace] = $names;
        }
    }

    protected function loadApplicationDefinition()
    {
        $this->definition = [];

        $commands = $this->kernel->all();

        $command = array_values($commands)[0];

        $application = $command->getApplication();

        $this->definition = $this->getInputDefinitionData($application->getDefinition());

        // $this->arguments = $this->getInputDefinitionArguments($application->getDefinition());

        // $this->options = $this->getInputDefinitionOptions($application->getDefinition());
    }

    protected function getInputArgumentData(InputArgument $argument): array
    {
        return [
            'name' => $argument->getName(),
            'is_required' => $argument->isRequired(),
            'is_array' => $argument->isArray(),
            'description' => preg_replace('/\s*[\r\n]\s*/', ' ', $argument->getDescription()),
            'value' => \INF === $argument->getDefault() ? 'INF' : $argument->getDefault(),
        ];
    }

    protected function getInputOptionData(InputOption $option): array
    {
        return [
            'name' => '--'.$option->getName(),
            'shortcut' => $option->getShortcut() ? '-'.str_replace('|', '|-', $option->getShortcut()) : '',
            'is_flag' => ! $option->acceptValue(),
            'is_required' => $option->isValueRequired(),
            'is_array' => $option->isArray(),
            'description' => preg_replace('/\s*[\r\n]\s*/', ' ', $option->getDescription()),
            'value' => \INF === $option->getDefault() ? 'INF' : $option->getDefault(),
        ];
    }

    protected function getInputDefinitionData(InputDefinition $definition): array
    {
        $inputArguments = [];
        foreach ($definition->getArguments() as $name => $argument) {
            $inputArguments[$name] = $this->getInputArgumentData($argument);
        }

        $inputOptions = [];
        foreach ($definition->getOptions() as $name => $option) {
            $inputOptions[$name] = $this->getInputOptionData($option);
        }

        return ['arguments' => $inputArguments, 'options' => $inputOptions];
    }

    protected function getInputDefinitionArguments(InputDefinition $definition): array
    {
        $inputArguments = [];
        foreach ($definition->getArguments() as $name => $argument) {
            $inputArguments[$name] = $this->getInputArgumentData($argument);
        }

        return $inputArguments;
    }

    protected function getInputDefinitionOptions(InputDefinition $definition): array
    {
        $inputOptions = [];
        foreach ($definition->getOptions() as $name => $option) {
            $inputOptions[$name] = $this->getInputOptionData($option);
        }

        return $inputOptions;
    }

    protected function getCommandData(Command $command): array
    {
        // $command->mergeApplicationDefinition(false);

        return [
            'name' => $command->getName(),
            'synopsis' => $command->getSynopsis(false),
            // 'usages' => $command->getUsages(),
            // 'aliases' => $command->getAliases(),
            'description' => $command->getDescription(),
            'help' => $command->getProcessedHelp(),
            // 'definition' => $this->getInputDefinitionData($command->getDefinition()),
            'arguments' => $this->getInputDefinitionArguments($command->getDefinition()),
            'options' => $this->getInputDefinitionOptions($command->getDefinition()),
            'hidden' => $command->isHidden(),
        ];
    }
}
