<?php
declare(strict_types=1);

namespace Course\Api\Wrapper;


use Monolog\Logger;

final class Wrapper
{

    /** @var array  */
    private $loggerData;

    public function __construct(private Logger $logger){

        $request = \Flight::request();
        $this->loggerData = [
            "ip" => $request->ip,
            "ip_proxy" => $request->proxy_ip,
            "method" => $request->method,
            "request_url" => $request->url,
            "data" => $request->data->getData()
        ];


    }


    public function wrap(\Closure $body)
    {

        $this->logger->info("-->", $this->loggerData);

        try {
            $result = $body();
            $httpCode = 200;
            $method = "info";
        } catch (\Exception $e) {
            $result = [
                "error" => $e->getMessage(),
                "error_code" => $e->getCode()
            ];
            $httpCode = 500;
            $method = "error";
        }

        $this->logger->$method("<-- $httpCode", $result);
        \Flight::json($result, $httpCode);

    }


}