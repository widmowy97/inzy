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

    public  $visitRepository;

    private $mailer;

    public function __construct(ShowVisitRepository $visitRepository, \Swift_Mailer $mailer)
    {
        parent::__construct();
        $this->visitRepository = $visitRepository;
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
            $visits = $this->visitRepository->findTomorrowsVisits();

            /** @var Visit $visit */
            foreach ($visits as $visit){
                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('admin@noreply.com')
                    ->setTo($visit->getPatient()->getEmail())
                    ->setBody('Zapraszamy jutro na wizytę '.$visit->getPatient())
                ;
                $this->mailer->send($message);

                $io->success('Reminder is going to be sent to: '.$visit->getPatient());
            }


            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->success('Failure: '.$e->getMessage());

            return Command::FAILURE;
        }

    }
}
