<?php

namespace App\Enum;

enum MethodEnum: string
{
    case POST = 'POST';
    case GET = 'GET';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
}
