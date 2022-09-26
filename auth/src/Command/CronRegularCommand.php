<?php

namespace App\Command;

use App\Entity\ApiToken;
use App\Helper\Status\ApiTokenStatus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\Date;

class CronRegularCommand extends Command
{
    public function __construct(
        protected \Doctrine\ORM\EntityManagerInterface $entityManager

    )
    {
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setName('cron:regular')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $cats = $this->entityManager->getRepository(\App\Entity\Category::class)->findAll();
        print_r($cats[0]->getLastChangeDate()->format("Y-m-d"));
        if(date("Y-m-d") != $cats[0]->getLastChangeDate()->format("Y-m-d") || date("Y-m-d") != $cats[1]->getLastChangeDate()->format("Y-m-d"))
        {
           shell_exec("/var/www/auth/bin/console category:load > /dev/null &");
        }
        
        return Command::SUCCESS;
    }
}