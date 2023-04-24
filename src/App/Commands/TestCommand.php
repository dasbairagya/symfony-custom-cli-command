<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Processor\WebProcessor;
 
class TestCommand extends Command
{
    protected function configure()
    {
        $this->setName('app:test-log')
            ->setDescription('Log the output to the browser console')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = new Logger('log');
        $logger->pushProcessor(new WebProcessor);
        $browserHandler = new BrowserConsoleHandler(Logger::INFO);
        $logger->pushHandler($browserHandler);
        $logger->info("message");
        $output->writeln('<info>Console logged successfully!</info>');
        return Command::SUCCESS;
    }
}