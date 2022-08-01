<?php

namespace App\Enum;

enum ServiceTypeEnum: string
{
    case SOAP = 'SOAP';
    case REST = 'REST';
}
