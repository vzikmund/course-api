<?php
declare(strict_types=1);

namespace Course\Api;


use Nette\Configurator;
use Nette\DI\Container;

final class Bootstrap
{


    /**
     * @return Container
     */
    public static function boot():Container{
        $path = dirname(__DIR__);
        $tempDir = $path . "/temp";

        $configurator = new Configurator();
        $configurator->setTempDirectory($tempDir);

        $configurator
            ->addConfig($path . "/config/common.neon")
            ->addParameters(
                [
                    "absPath" => $path,
                    "logDir" => $path . "/log"
                ]
            );

        return $configurator->createContainer();
    }


}