<?php
namespace Console\App\Commands\Cache;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
// use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class ClearCommand extends Command
{
    protected function configure()
    {
        $this->setName('cache:clear')
            ->setDescription('Clears the application cache.')
            ->setHelp('Allows you to delete the application cache. Pass the --groups parameter to clear caches of specific groups.')
            ->addOption(
                    'groups',
                    'g',
                    InputOption::VALUE_OPTIONAL,
                    'Pass the comma separated group names if you don\'t want to clear all caches.',
                    ''
                );
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->info('Cache is about to cleared...');
        $answer = $io->ask('Do you want to continue?', 'yes');
        if($answer ==='yes'){
            if ($input->getOption('groups'))
            {
                $groups = explode(",", $input->getOption('groups'));

                // $progressBar = new ProgressBar($output, count($groups));
                // $progressBar->start();

                $io->progressStart(count($groups));

            
                if (is_array($groups) && count($groups))
                {
                    foreach ($groups as $group)
                    {
                        sleep(1);
                        // $progressBar->advance();
                        $io->progressAdvance();
                    }
                    $io->newLine();
                    $io->success(sprintf('%s groups are cleared!', count($groups)));
                }
                // $progressBar->finish();
                $io->progressFinish();
            }else
            {
                $io->success('All caches are cleared!');
            }
            $output->writeln('');
            return Command::SUCCESS;
        
        }else{
            $io->warning('Aboarted');
            return Command::FAILURE;
        }
    }
        
}