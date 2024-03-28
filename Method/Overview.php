<?php
namespace GDO\ApiHub\Method;

use GDO\Core\GDT;
use GDO\Core\Method;

final class Overview extends Method
{

    public function isCLI(): bool
    {
        return true;
    }

    public function getCLITrigger(): string
    {
        return 'api';
    }

    public function execute(): GDT
    {

    }

}
