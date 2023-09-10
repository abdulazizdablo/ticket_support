<?php


namespace App\Enums;


enum Priorities: string
{
    case HIGH = 'High';
    case MEDIUM = 'Meduim';
    case LOW = 'Low';


    public  static function values()
    {

        return array_column(self::cases(), 'value');
    }
}
