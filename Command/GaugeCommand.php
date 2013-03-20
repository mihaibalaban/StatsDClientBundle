<?php

namespace Liuggio\StatsDClientBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to send a gauge metric to statsd
 *
 * @author Pablo Godel <pgodel@gmail.com>
 */
class GaugeCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('statsd:gauge')
            ->setDescription('Sends a gauge metric to StatsD')
            ->addArgument('key', null, InputArgument::REQUIRED, 'The key')
            ->addArgument('value', null, InputArgument::REQUIRED, 'The value')
            ->setHelp(<<<EOT
The <info>statsd:gauge</info> command sends a gauge metric to StatsD:

  <info>./app/console statsd:gauge</info>

EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this->getDataFactory()->gauge(
            $input->getArgument('key'),
            $input->getArgument('value')
        );
        $this->getClientService()->send($data);
    }
}