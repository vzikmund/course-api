<?php
declare(strict_types=1);

namespace Course\Api\Exception;


use Throwable;

final class NotFoundException extends ApiException
{

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, 3, $previous);
    }

    public function getHttpCode(): int
    {
        return 404;
    }

}