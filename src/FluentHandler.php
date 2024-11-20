<?php

namespace TheTrybe\Monolog\Handler;

use Fluent\Logger\FluentLogger;
use Fluent\Logger\PackerInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord;

class FluentHandler extends AbstractProcessingHandler
{
    private FluentLogger $logger;
    private string $tag;

    public function __construct(string $tag, $host = FluentLogger::DEFAULT_ADDRESS, $port = FluentLogger::DEFAULT_LISTEN_PORT, array $options = array(), PackerInterface $packer = null, int|string|Level $level = Level::Debug, bool $bubble = true)
    {
        $this->logger = new FluentLogger($host, $port, $options, $packer);
        $this->tag = $tag;

        parent::__construct($level, $bubble);
    }

    protected function write(LogRecord $record): void
    {
        $this->logger->post($this->tag, $record->formatted);
    }
}
