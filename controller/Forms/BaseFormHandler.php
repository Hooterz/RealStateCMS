<?php
declare(strict_types=1);
namespace controller\Forms;

abstract class BaseFormHandler implements IFormHandler
{
    public abstract function Handle_POST(array $POST);

    public abstract function Handle_GET(array $GET);
}