<?php


namespace PHPGuru\Headfirst\OOP;


abstract class Model
{
    protected static string $tableName = 'model';

    public static function getTableName(): string
    {
        return static::$tableName;
    }
}