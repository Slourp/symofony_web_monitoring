<?php

namespace App\Command;

use App\Domain\WebSiteChecker\Factory\WebCheckStrategyFactory;
use App\Domain\WebSiteChecker\Observer\WebCheckObserver;
use App\Domain\WebSiteChecker\WebSiteCheckerStrategy\WebCheck;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'website:check',
    description: 'Check a website for online availability, response time, and SSL validity.',
)]
class WebSiteCheckCommand extends Command
{
    public function __construct(
        private WebCheckStrategyFactory $factory,
        private $webCheckObserver = new WebCheckObserver()
    ) {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('url', InputArgument::REQUIRED, 'The URL of the website to check.')
            ->addArgument('strategies', InputArgument::REQUIRED, 'The check strategies to run (online, response_time, ssl_validity).')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = $input->getArgument('url');
        $strategies = $input->getArgument('strategies');
        $strategies = (explode(",", $strategies));

        $webCheck = new WebCheck();

        $webCheck->attachObserver($this->webCheckObserver);
        foreach ($strategies as $strategy) {
            $webCheck->setStrategy($this->factory->create($strategy));

            /**
             * @var WebCheckResult
             */
            $webCheck->check($url);
        }
        return Command::SUCCESS;
    }
}
