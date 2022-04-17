<?php
declare(strict_types=1);

namespace Course\Api\Logger;


use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nette\Utils\Strings;

final class LoggerFactory
{


    public function __construct(private string $dir)
    {
    }


    /**
     * Creating a new file logger
     * @param string $fileFile
     * @param string $name
     * @return Logger
     */
    public function create(string $fileFile, string $name = "api"): Logger
    {

        $dateFormat = "Y-m-d H:i:s";
        $output = "[%datetime%] %level_name%: %message% %context% \n";

        if (!Strings::endsWith($fileFile, ".log")) {
            $fileFile .= ".log";
        }

        $formatter = new LineFormatter($output, $dateFormat);
        $stream = new StreamHandler($this->dir . "/{$fileFile}");
        $stream->setFormatter($formatter);

        $logger = new Logger($name);
        return $logger->pushHandler($stream);

    }


}