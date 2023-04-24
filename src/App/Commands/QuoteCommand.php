<?php declare(strict_types=1);

namespace App\Command;

use Console\App\Services\Quote;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Jump to symfony-cli dir and run php bin/console to get the available commands
 * 
 * PS D:\apps\php\symfony-cli> php bin/console
 */
final class QuoteCommand extends Command
{
    /**
     * @var Quote
     */
    private $qouteService;

    /**
     * @var string
     */
    protected static $defaultName = 'app:get-quote';

    public function __construct(Quote $quoteService)
    {
        $this->quoteService = $quoteService;
        parent::__construct(null);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setDescription('This command gets a random quote from quotable.io.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'A doze of inspiration to power your day',
            '========================================',
            '',
        ]);
        $quoteSection = $output->section();

        while (true) {
            $quote = $this->quoteService->getQuote();
            $quoteSection->overwrite($quote);
            sleep(5);
        }

    }
}