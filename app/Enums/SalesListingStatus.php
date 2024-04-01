<?php

namespace App\Enums;

enum SalesListingStatus: string 
{
    case AVAILABLE = 'available';
    case SOLD = 'sold';
    case REMOVED = 'removed';
}