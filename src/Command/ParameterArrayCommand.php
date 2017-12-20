<?php
namespace App\Command;

use App\Helper\ParameterHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParameterArrayCommand extends ContainerAwareCommand
{
    public $parameterHelper;

    protected function configure()
    {
        $this
            ->setName('jks:parametertest')
            ->setDescription('Tests to see if Symfony does something I want it to do with parameters')
        ;
    }

    public function __construct(ParameterHelper $parameterHelper)
    {
        $this->parameterHelper = $parameterHelper;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Activated new command, we are wired');

        // test to make sure we're wired correctly
        $param1 = $this->getContainer()->getParameter('app.siteOne');
        $output->writeln("First parameter fetched from service container: {$param1}");
        $output->writeln("Now attempting to get helper array of the stack...");
        dump($this->parameterHelper->getParameterBag());
        $output->writeln('I have a parameter, it is p3 j4 m2 4k and I need to know what service it is');

        // test to make sure our service is wired correctly
        // $helperService = $this->getContainer()->get('app.parameterHelper');
        // that did not work really as symfony is now more picky about dependency injection
        // attempting to inject it instead with autowire
    }
}