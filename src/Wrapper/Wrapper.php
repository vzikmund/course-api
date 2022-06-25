<?php
declare(strict_types=1);

namespace Course\Api\Wrapper;


use Course\Api\Exception\ApiException;
use Monolog\Logger;
use Nette\Database\UniqueConstraintViolationException;

final class Wrapper
{

    /** @var array */
    private $loggerData;

    public function __construct(private Logger $logger)
    {

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

        $method = "error";
        try {
            $result = $body();
            $httpCode = 200;
            $method = "info";
        } catch (ApiException $e) {
            $result = [
                "error" => $e->getMessage(),
                "error_code" => $e->getCode()
            ];
            $httpCode = $e->getHttpCode();
        } catch (UniqueConstraintViolationException $e){
            $result = [
                "error" => "Duplicate data encountered",
                "error_code" => 1
            ];
            $httpCode = 400;
        } catch (\Exception $e) {
            $result = [
                "error" => "Internal server error",
                "error_code" => 0
            ];
            $httpCode = 500;
            $this->logger->error("Internal server error",
                ["exception" => $e->getMessage(), "trace" => $e->getTrace()]
            );
        }

        $this->logger->$method("<-- $httpCode", $result);
        \Flight::json($result, $httpCode);

    }


}