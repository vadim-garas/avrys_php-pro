<?php

namespace AvrysPhp\Core\CLI;

use AvrysPhp\Core\CLI\Helpers\CliParamAnalyzer;
use AvrysPhp\Core\CLI\Interfaces\ICliCommand;
use AvrysPhp\Core\Interfaces\ICommandHandler;



class CommandHandler implements ICommandHandler
{
    /**
     * @var ICliCommand[]
     */
    protected array $commands = [];

    /**
     * @var ICliCommand
     */
    protected ICliCommand $defaultCommand;

    /**
     * @param ICliCommand $defaultCommand
     * @throws Exceptions\CliCommandException
     */
    public function __construct(ICliCommand $defaultCommand)
    {
        $this->defaultCommand = $defaultCommand;
        $this->addCommand($defaultCommand);
    }

    /**
     * @param ICliCommand $command
     * @return $this
     */
    public function addCommand(ICliCommand $command): self
    {
        $this->commands[$command::getCommandName()] = $command;
        return $this;
    }

    /**
     * @param array $params
     * @param callable|null $callback
     * @return void
     */
    public function handle(array $params = [], ?callable $callback = null): void
    {
        $defaultCommandName = $this->defaultCommand::getCommandName();

        $commandName = CliParamAnalyzer::getCommand() ?? $defaultCommandName;


        try {
            $service = $this->commands[$commandName] ?? $this->commands[$defaultCommandName];
            $service->run(CliParamAnalyzer::getArguments());
        } catch (\Exception $e) {
            if ($callback) {
                $callback(CliParamAnalyzer::getArguments(), $e);
            }
        }
    }
}
