<?php

namespace App\Enum;

enum ExecutionStatusEnum: string
{
    case CREATED = 'CREATED';
    case EXECUTING = 'EXECUTING';
    case FINISHED = 'FINISHED';
}
