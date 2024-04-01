<?php 

namespace App\Enums;


enum Conditions: string 
{
    case EXCEPTIONAL = 'exceptional';
    case AVERAGE = 'average';
    case ACCEPTABLE = 'acceptable';
}