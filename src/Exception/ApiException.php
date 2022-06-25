<?php
declare(strict_types=1);

namespace Course\Api\Exception;

use Throwable;

abstract class ApiException extends \Exception
{

    public function __construct(string $message, int $code, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get HTTP response code
     * @return int
     */
    abstract function getHttpCode():int;

}