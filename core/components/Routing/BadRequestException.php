<?php


namespace core\components\Routing;


class BadRequestException extends HttpException
{
    protected $message = 'Bad request';

    protected $code = 400;
}