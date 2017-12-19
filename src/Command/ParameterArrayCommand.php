<?php
namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParameterArrayCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jks:parametertest')
            ->setDescription('Tests to see if Symfony does something I want it to do with parameters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Activated new command');
        $param1 = $this->getContainer()->getParameter('app.siteOne');
        $output->writeln($param1);
    }
}