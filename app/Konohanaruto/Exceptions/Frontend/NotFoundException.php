<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/8
 * Time: 17:30
 */

namespace App\Konohanaruto\Exceptions\Frontend;

class NotFoundException extends FrequentException
{
    /**
     * @var string
     */
    protected $status = '404';

    /**
     * @return void
     */
    public function __construct()
    {
        $message = $this->build(func_get_args());

        parent::__construct($message);
    }
}