<?php
namespace Console\App\Commands\Message;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogCommand extends Command
{
    protected function configure()
    {
        $this->setName('message:log')
            ->setDescription('Log Hello-World!')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('username', InputArgument::REQUIRED, 'Pass the username.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // create a log channel
        $logger = new Logger('message');
        $logger->pushHandler(new StreamHandler(LOGPATH.'/dev.log', Logger::DEBUG));
        $output->writeln('Command message:log is about to run...');
        $output->writeln(sprintf('Hello World!, %s', $input->getArgument('username')));
        $output->writeln('<info>Username logged successfully!</info>');
        $logger->info('Logger command: '.$input->getArgument('username'));
        $logger->info('Logging like a boss at ' . __FILE__ . ':' . __LINE__);
        $logger->error('This is an Error', ['Username'=>'Gopal']);

        return Command::SUCCESS;
    }
}