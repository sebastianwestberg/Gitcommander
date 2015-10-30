<?php 

namespace Sebastianwestberg\Bts\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Sebastianwestberg\Bts\Command\AuthCommand;
use Sebastianwestberg\Bts\Repository\Repository;

class RepositoryAddCommand extends AuthCommand
{
    protected function configure()
    {
        $this
            ->setName('repository:add')
            ->setDescription('Interact with your Github repositories')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Repository name.'
            )
            ->addArgument(
                'description',
                InputArgument::OPTIONAL,
                'Optional description.'
            )
            ->addOption(
                'visibility',
                null,
                InputOption::VALUE_OPTIONAL,
                'Visibility of repository, either public or private.',
                array('public', 'private')
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Repository add command invoked');
        $repository = new Repository($this->auth());

        $repository->create($input->getArgument('name'), $input->getArgument('description'), $input->getOption('visibility'));

        foreach($repository->getAll() as $repo) {
            $output->writeln($repo->getText());
        }
    }
}

