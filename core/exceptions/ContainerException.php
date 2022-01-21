<?php


namespace core\exceptions;


use Psr\Container\NotFoundExceptionInterface;

class ContainerException extends \Exception implements NotFoundExceptionInterface
{

}