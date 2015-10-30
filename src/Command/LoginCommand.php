<?php 

namespace Sebastianwestberg\Bts\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Sebastianwestberg\Bts\Command\GithubCommandBase;
use Sebastianwestberg\Bts\Repository\Repository;

class LoginCommand extends AuthCommand 
{
    protected function configure()
    {
        $this
            ->setName('github:login')
            ->setDescription('Login into github.')
            ->addArgument(
                'username',
                InputArgument::REQUIRED,
                'Username.'
            )
            ->addArgument(
                'password',
                InputArgument::REQUIRED,
                'Password.'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Login command invoked');

        $session = $this->auth($input->getArgument('username'), $input->getArgument('password'));
        $repository = new Repository($session);

        $output->writeln('<info>Success! Here\'s a list of your repositories:</info>');

        foreach($repository->getAll() as $repo) {
            $output->writeln($repo->getText());
        }
    }
}

