<?php
declare(strict_types=1);

namespace Course\Api\Wrapper;


final class Wrapper
{


    public function wrap(\Closure $body)
    {

        try {
            $result = $body();
            $httpCode = 200;
        } catch (\Exception $e) {
            $result = [
                "error" => $e->getMessage(),
                "error_code" => $e->getCode()
            ];
            $httpCode = 500;
        }

        \Flight::json($result, $httpCode);

    }


}