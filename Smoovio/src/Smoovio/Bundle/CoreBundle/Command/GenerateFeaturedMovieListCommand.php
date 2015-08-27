<?php

namespace Smoovio\Bundle\CoreBundle\Command;

use Doctrine\ORM\EntityManager;
use Smoovio\Bundle\CoreBundle\Entity\MovieList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateFeaturedMovieListCommand extends Command
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setName('smoovio:playlist:create_featured')
            ->setDescription('Generates a random list of featured movies')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $movieRepository = $this->entityManager->getRepository('SmoovioCoreBundle:Movie');

        $list = new MovieList('Featured Movies', 'portal');
        $max = 10;

        $progress = $this->getHelper('progress');
        $progress->start($output, $max);

        $movies = $movieRepository->getRandomMovies($max);
        foreach ($movies as $movie) {
            sleep(1);
            $list->addMovie($movie);
            $progress->advance();
        }

        $progress->finish();

        $this->entityManager->persist($list);
        $this->entityManager->flush();

        $output->writeln('The list now includes the following movies:');
        $output->writeln('');
        foreach ($list->getMovies() as $movie) {
            $output->writeln($movie->getTitle());
        }

        return 0;
    }
}
 
