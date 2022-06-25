<?php
declare(strict_types=1);

namespace Course\Api\Exception;


use Throwable;

final class UnauthorizedException extends ApiException
{

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, 4, $previous);
    }

    public function getHttpCode(): int
    {
        return 401;
    }

}