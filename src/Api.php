<?php
declare(strict_types=1);

namespace Course\Api;


use Course\Api\Wrapper\WrapperFactory;
use Nette\Utils\Strings;
use Nette\Utils\Validators;

final class Api
{

    public function __construct(private WrapperFactory $wrapper){}


    public function createOrder():void{

        $body = function():array{
            $data = \Flight::request()->data;

            $idRetailer = $data->retailer_id;
            $idProduct = $data->product_id;
            $idOrder = $data->order_id;

            $error = [];

            if(!$idRetailer || !Validators::isNumericInt($idRetailer)){
                $error[] = "parameter 'retailer_id' must be int";
            }

            if(!$idProduct || !Validators::isNumericInt($idProduct)){
                $error[] = "parameter 'product_id' must be int";
            }

            if(!$idOrder){
                $error[] = "parameter 'order_id' is required";
            } else {

                if(Strings::length($idOrder) > 20){
                    $error[] = "max length of parameter 'order_id' is 20 characters";
                }

                if(Strings::match($idOrder, "/[^a-zA-Z_0-9]/i")){
                    $error[] = "parameter 'order_id' contains forbidden characters";
                }

            }

            if(count($error) > 0){
                throw new \Exception( join(", ", $error));
            }else{
                return ["ready to move on"];
            }
        };
        $this->wrapper->wrap($body);

    }


    public function getOrderBySerialNumber($idRetailer, $serialNumber):void{
        echo "Hello from APi class, $idRetailer, $serialNumber";
    }


    public function getOrderByRetailerOrderId($idRetailer, $idRetailerOrderId):void{
        echo "Hello from APi class, $idRetailer, $idRetailerOrderId";
    }

}