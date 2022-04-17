<?php
declare(strict_types=1);

namespace Course\Api\Wrapper;


final class WrapperFactory
{

    /**
     * Creating Wrapper instance and calling body anonymous function
     * @param \Closure $body
     * @return void
     */
    public function wrap(\Closure $body):void{
        (new Wrapper())->wrap($body);
    }

}