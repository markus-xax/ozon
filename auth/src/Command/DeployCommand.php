<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeployCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('deploy')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        shell_exec('composer install; bin/console doctrine:schema:update -f; bin/console cancel:data:processing; crontab -l | { cat; echo "*/5 1-23 * * * /var/www/auth/bin/console cron:regular > /dev/null &"; } | crontab -;  php bin/console wb:data:start > /dev/null &');
        return Command::SUCCESS;
    }
}