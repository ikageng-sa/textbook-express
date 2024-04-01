<?php

namespace App\Enums;

enum AccountStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case DELETED = 'deleted';
}