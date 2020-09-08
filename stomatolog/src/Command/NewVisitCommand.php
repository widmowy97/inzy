<?php

namespace App\Command;

use App\Entity\Visit;
use App\Repository\ShowVisitRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class NewVisitCommand extends Command
{
    protected static $defaultName = 'app:visit-reminder';

    public $showVisitRepository;

    private $mailer;

    public function __construct(ShowVisitRepository $showVisitRepository, \Swift_Mailer $mailer)
    {
        parent::__construct();
        $this->showVisitRepository = $showVisitRepository;
        $this->mailer = $mailer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Send email reminding about a visit');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $visits = $this->showVisitRepository->findVisit(new \DateTime());

            /** @var Visit $visit */
            foreach ($visits as $visit) {
                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('stoomatologia09@gmail.com')
                    ->setTo($visit->getPatient()->getEmail())
                    ->setBody('Zapraszamy na wizytę');
                $this->mailer->send($message);

                $io->success(sprintf('Success send', count($visits)));
            }


            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->success('Failure: ' . $e->getMessage());

            return Command::FAILURE;
        }
    }
}
