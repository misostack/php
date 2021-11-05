<?php

namespace PHPGuru\Headfirst\OOP;
require_once 'Model.php';

class User extends Model
{
    protected static string $tableName = 'users';
}