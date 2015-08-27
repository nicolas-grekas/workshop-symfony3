<?php

namespace Smoovio\Bundle\CoreBundle\Command;

use Smoovio\Bundle\CoreBundle\Repository\ActorRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowActorCommand extends Command
{
    private $repository;

    public function __construct(ActorRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    protected function configure()
    {
        $this
            ->setName('smoovio:actor:show')
            ->setDescription('Displays an actor details.')
            ->addArgument('name', InputArgument::REQUIRED, 'The actor full name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$actor = $this->repository->findByName($input->getArgument('name'))) {
            throw new \RuntimeException('Cannot find actor.');
        }

        $table = $this->getHelper('table');
        $table->setLayout('compact');
        $table->setHeaders([ 'Key', 'Value']);
        $table->addRows([
            [ 'Name', $actor->getName() ],
            [ 'Birthday', $this->getDate($actor->getBirthday()) ],
            [ 'Deathday', $this->getDate($actor->getDeathday()) ],
            
        ]);
        $table->render($output);
    }

    private function getDate(\DateTime $dt = null, $default = 'n/a')
    {
        if (!$dt) {
            return $default;
        }

        return $dt->format('Y-m-d');
    }
}
