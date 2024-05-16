<?php 

namespace App\Enums;


enum OrderStatus: string 
{
    case PENDING = "pending";
    case SHIPPED = "order has been shipped";
    case PICKUP = 'order is ready for pickup';
    case COURIER = 'order has recieved by the courier facility';
    case TOBEDELIVERED = 'on the way';
    case COMPLETED = 'completed';
}