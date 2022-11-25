<?php

namespace Micro\Plugin\DTO\Console;

use Micro\Plugin\DTO\Business\FileLocator\FileLocatorFactory;
use Micro\Plugin\DTO\Facade\DTOFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateDTOCommand extends Command
{
    protected static $defaultName = 'micro:dto:generate';
    protected const HELP          = 'Generate DTO classes.';

    public function __construct(
        private readonly DTOFacadeInterface $DTOFacade
    )
    {
        parent::__construct(self::$defaultName);
    }

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
    //    $this->setHelp(self::HELP);
    //    $this->addArgument(
    //        self::ARG_CONSUMER,
    //        InputArgument::OPTIONAL,
    //        'Consumer name',
    //        AmqpPluginConfiguration::CONSUMER_DEFAULT);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info> Generate DTO classes... </info>');
        try {
            $this->DTOFacade->generate();
            $output->writeln('<info> Success!</info>');
        } catch (\Throwable $e) {
            $output->writeln(sprintf('<error> %s </error>', $e->getMessage()));

            throw $e;

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}