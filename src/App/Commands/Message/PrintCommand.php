<?php
namespace Console\App\Commands\Message;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class PrintCommand extends Command
{
    protected function configure()
    {
        $this->setName('message:print')
            ->setDescription('Prints Hello-World!')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('username', InputArgument::REQUIRED, 'Pass the username.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Command message:print is about to run...');
        $output->writeln(sprintf('Hello World!, %s', $input->getArgument('username')));
        $output->writeln('<info>Username printed successfully!</info>');
        return Command::SUCCESS;
    }
}