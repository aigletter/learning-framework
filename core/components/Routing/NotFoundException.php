<?php


namespace core\components\Routing;


class NotFoundException extends HttpException
{
    protected $message = 'Not found';

    protected $code = 404;
}