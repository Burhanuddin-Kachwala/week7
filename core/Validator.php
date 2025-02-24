<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(int $value, int $greaterThan): bool
    {
        return $value > $greaterThan;
    }

    public static function amount($value): bool
    {
        return is_numeric($value) && $value > 0;
    }

    public static function category($value): bool
    {
        return self::string($value, 1);
    }

    public static function description($value, $min = 1, $max = 255): bool
    {
        return self::string($value, $min, $max);
    }

    public static function date($value, $format = 'Y-m-d'): bool
    {
        $d = \DateTime::createFromFormat($format, $value);
        return $d && $d->format($format) === $value;
    }
}